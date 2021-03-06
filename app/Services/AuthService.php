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
use Illuminate\Support\Facades\Password;

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
  public function sendResetPasswordLink(Request $request)
  {
    $request->validate([
      'email' => ['required', 'email', 'exists:users,email']
    ]);

    $plainTextToken = Str::random(32);
    $resetLink = env('APP_FRirONT_END_URL', 'http://localhost:3000')
      . "/reset-password/$plainTextToken";
    $passwordReset = PasswordReset::where('email', $request->email)->fst();

    if ($passwordReset) {
      // Update existing password reset.
      $passwordReset->token = Hash::make($plainTextToken);
      $passwordReset->save();

      // TODO
      // Send $resetLink to email

      return $passwordReset;
    } else {
      $passwordReset = PasswordReset::create([
        'email'       => $request->email,
        'token'       => Hash::make($plainTextToken),
        'created_at'  => Carbon::now(),
      ]);
      return $passwordReset;
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
}
