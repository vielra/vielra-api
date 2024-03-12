<?php

namespace App\Services;

use Exception;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\User as UserModel;
use App\Models\ResetPasswordToken;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Events\Auth\RequestedResetPassword;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Support\Facades\Log;
use \Laravel\Sanctum\PersonalAccessToken;
use Smartisan\Settings\Facades\Settings;

class AuthService
{

  /**
   * Register with email and password
   */
  public function registerWithEmailAndPassword($data)
  {
    $newUser = $data;
    $newUser['password'] = Hash::make($data['password']);

    if (isset($data['username']) && $data['username']) {
      $newUser['username']  = $data['username'];
    } else {
      $newUser['username']  = Str::slug($data['name'], '_') . time();
    }

    return UserModel::create($newUser);
  }


  /**
   * Check availability username when register in mobile app
   */
  public function checkAvailabilityUsername($username)
  {
    $user = UserModel::where('username', $username)->first();
    if ($user) {
      return [
        'availability'     => false
      ];
    } else {
      return [
        'availability'     => true
      ];
    }
  }


  /**
   * Login
   * 
   * @param @param App\Http\Request\LoginRequest $request;
   * @return \Illuminate\Http\Response
   */
  public function login($data)
  {
    if (Auth::attempt($data)) {
      return UserModel::where('email', $data['email'])->first();
    }
    return;
  }


  /**
   * Send reset password link.
   */
  public function sendResetPasswordLink(array $data)
  {
    $plainTextToken   = Str::random(36);
    $appId            = isset($data['app_id']) ? $data['app_id'] : 'community-app-v1.0';
    $email            = $data['email'];
    $resetLink        = config('app.app_frontend_url') . "/reset-password?app_id=$appId&token=$plainTextToken&email=$email";

    $passwordReset = ResetPasswordToken::where('email', $email)->first();

    if ($passwordReset) {
      // Update existing password reset.
      $passwordReset->token = Hash::make($plainTextToken);
      $passwordReset->save();
    } else {
      $passwordReset = ResetPasswordToken::create([
        'email'       => $email,
        'token'       => Hash::make($plainTextToken),
        'created_at'  => Carbon::now(),
        'app_id'      => $appId,
      ]);
    }

    // Send $resetLink to email
    Mail::to($email)->send(new \App\Mail\ResetPasswordInstruction([
      'link'  => $resetLink,
      'email' => $email,
    ]));

    return $passwordReset;
  }


  public function verifyTokenPasswordReset($data)
  {
    $user           = UserModel::where('email', $data['email'])->first();
    $passwordReset  = ResetPasswordToken::where('email', $data['email'])->first();
    if ($user && Hash::check($data['token'], $passwordReset->token)) {
      return $user;
    } else {
      return false;
    }
  }


  /**
   * Delete user current access token.
   * 
   * @return boolean
   */
  public function deleteCurrentAccessToken($currentAccessToken)
  {
    if ($currentAccessToken) {
      // $user = UserModel::findOrFail($userId);
      // dd($user->currentAccessToken()->delete()); // Can't delete this token

      return PersonalAccessToken::findToken($currentAccessToken)->delete();
    } else {
      return  false;
    }
  }

  /**
   * @throws Exception
   */
  public function sendOtpResetPassword(string $email)
  {
    try {
      $pin            = null;
      $userIsExists   = UserModel::where('email', $email)->exists();

      if ($userIsExists) {
        $passwordReset = DB::table('password_reset_tokens')->where([
          ['email', $email],
          ['isActive', 1],
        ]);

        if ($passwordReset->exists()) {
          $passwordReset->delete();
        }

        $code = rand(
          pow(10, (int)Settings::group('otp')->get('otp_digit_limit') - 1),
          pow(10, (int)Settings::group('otp')->get('otp_digit_limit')) - 1
        );

        $passwordReset = DB::table('password_reset_tokens')->insert([
          'email'       => $email,
          'token'       => $code,
          'isActive'    => 1,
          'created_at'  => Carbon::now()
        ]);
        if ($passwordReset) {
          RequestedResetPassword::dispatch(['email' => $email, 'code' => $code]);
          return trans('auth.check_your_email_for_code');
        } else {
          throw new Exception(trans('auth.token_created_fail'));
        }
      } else {
        throw new Exception(trans('auth.email_does_not_exist'));
      }
    } catch (Exception $exception) {
      Log::info($exception->getMessage());
      throw new Exception($exception->getMessage(), 422);
    }
  }


  /**
   * @throws Exception
   */
  public function verifyCode(string $email, string $code)
  {
    try {
      $token  = Str::random(16);
      $check = DB::table('password_reset_tokens')->where([
        ['email', $email],
        ['token', $code],
        ['isActive', 1]
      ]);
      if ($check->exists()) {
        $difference = Carbon::now()->diffInSeconds($check->first()->created_at);
        if ($difference > (int)Settings::group('otp')->get('otp_expire_time') * 60) {
          throw new Exception(trans('auth.code_is_expired'));
        }
        $check->update(['isActive' => 0]);
        DB::table('password_reset_tokens')->insert([
          'email'       => $email,
          'token'       => Hash::make($token),
          'isActive'    => 1,
          'created_at'  => Carbon::now()
        ]);
        return [
          'token'     => $token,
          'message'   => trans('auth.you_can_reset_your_password'),
        ];
      } else {
        throw new Exception(trans('auth.code_is_invalid'));
      }
    } catch (Exception $exception) {
      Log::info($exception->getMessage());
      throw new Exception($exception->getMessage(), 422);
    }
  }

  /**
   * @throws Exception
   */
  public function resetPassword(ResetPasswordRequest $request)
  {
    try {
      $requestToken = $request->post('token');
      $requestEmail = $request->post('email');
      $tokenPasswordReset = DB::table('password_reset_tokens')->where([
        ['email', $requestEmail],
        ['isActive', 1]
      ])->first();
      if ($tokenPasswordReset && Hash::check($requestToken, $tokenPasswordReset->token)) {
        $user = UserModel::where('email', $requestEmail)->first();
        if ($user) {

          // update user password
          $user->update(['password' => Hash::make($request->post('password'))]);

          // create token
          $token  = $user->createToken($requestEmail)->plainTextToken;

          // update password reset token
          DB::table('password_reset_tokens')->where([
            ['email', $requestEmail],
            ['isActive', 1]
          ])->update(['isActive' => 0]);
          return [
            'user'    => $user,
            'token'   => $token,
          ];
        } else {
          throw new Exception(trans('common.something_went_wrong'));
        }
      } else {
        throw new Exception(trans('auth.reset_password_failed'));
      }
    } catch (Exception $exception) {
      Log::info($exception->getMessage());
      throw new Exception($exception->getMessage(), 422);
    }
  }
}
