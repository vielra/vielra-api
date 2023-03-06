<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Models\SocialAccount;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use \Laravel\Sanctum\PersonalAccessToken;

class AuthService
{

  /**
   * Register
   * 
   * @param App\Http\Request\RegisterRequest $request;
   * @return \Illuminate\Http\Response
   */
  public function register(RegisterRequest $request)
  {
    $newUser = $request->merge([
      'password'  => Hash::make($request->password)
    ])->only(['name', 'username', 'email', 'password']);

    if (!$request->username) {
      $newUser['username']  = Str::slug($request->name, '_') . time();
    }

    return User::create($newUser);
  }


  /**
   * Login
   * 
   * @param @param App\Http\Request\LoginRequest $request;
   * @return \Illuminate\Http\Response
   */
  public function login(LoginRequest $request)
  {
    $credentials = $request->only(['email', 'password']);
    if (Auth::attempt($credentials)) {
      return User::where('email', $request->email)->first();
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
    $resetLink        = env('APP_FRONT_END_URL', 'http://localhost:3000') . "/reset-password?app_id=$appId&token=$plainTextToken&email=$email";

    $passwordReset = PasswordReset::where('email', $email)->first();

    if ($passwordReset) {
      // Update existing password reset.
      $passwordReset->token = Hash::make($plainTextToken);
      $passwordReset->save();
    } else {
      $passwordReset = PasswordReset::create([
        'email'       => $email,
        'token'       => Hash::make($plainTextToken),
        'created_at'  => Carbon::now(),
        'app_id'      => $appId,
      ]);
    }

    // TODO
    // Send $resetLink to email
    Mail::to($email)->send(new \App\Mail\ResetPasswordInstruction([
      'link'  => $resetLink,
      'email' => $email,
    ]));

    return $passwordReset;
  }


  public function verifyTokenPasswordReset($data)
  {
    $user           = User::where('email', $data['email'])->first();
    $passwordReset  = PasswordReset::where('email', $data['email'])->first();
    if ($user && Hash::check($data['token'], $passwordReset->token)) {
      return $user;
    } else {
      return false;
    }
  }


  /**
   * Reset password
   */
  public function resetPassword(ResetPasswordRequest $request)
  {
    $passwordReset = PasswordReset::where('email', $request->email)->first();
    if ($passwordReset !== null && Hash::check($request->token, $passwordReset->token)) {
      $user = User::where('email', $request->email)->first();
      $user->password = Hash::make($request->password);
      $user->save();

      // Then delete reset password row.
      $passwordReset->delete();

      return $user;
    } else {
      return;
    }
  }

  /**
   * Login with social account.
   * 
   * @param array $data;
   * @param string "google" | "facebook";
   * @return \Illuminate\Http\Response
   */
  public function loginWithSocialAccount(array $data, string $provider)
  {
    if ($data && $provider) {
      $user = User::where('email', $data['social_email'])->first();

      // The first time user login with this account.
      if ($user === null) {
        /** Create new social account */
        $socialAccount = new SocialAccount;

        $socialAccount->social_provider     = $provider;
        $socialAccount->social_id           = $data['social_id'];
        $socialAccount->social_name         = $data['social_name'];
        $socialAccount->social_photo_url    = $data['social_photo_url'];

        $user = User::create([
          'name'      => $data['social_name'],
          'email'     => $data['social_email'],
          'username'  => $data['social_id'], // That's oke, user can change username anytime.
        ]);
        $socialAccount->fill(['user_id' => $user->id])->save();
      }
      return $user->fresh();
    } else {
      return  null;
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
      // $user = User::findOrFail($userId);
      // dd($user->currentAccessToken()->delete()); // Can't delete this token

      return PersonalAccessToken::findToken($currentAccessToken)->delete();
    } else {
      return  false;
    }
  }
}
