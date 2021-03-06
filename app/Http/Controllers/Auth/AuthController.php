<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as ResourcesUser;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Requests\Auth\LoginCheckUsernameRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{

    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Register
     * 
     * @param  App\Http\Requests\Auth\RegisterRequest $request;
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->authService->register($request);
        if ($user instanceof User) {
            $token = $user->createToken($user->email)->plainTextToken;
            return response()->json([
                'token' => $token,
                'user'  => new ResourcesUser($user)
            ], JsonResponse::HTTP_CREATED);
        }
    }


    /**
     * Check username before login

     * @param  App\Http\Requests\Auth\LoginCheckUsernameRequest $request;
     * @return \Illuminate\Http\Response
     */
    public function checkUsername(LoginCheckUsernameRequest $request)
    {
        $this->user = User::where('username', $request->username)->first();
        return new ResourcesUser($this->user);
    }

    /**
     * Login
     * 
     * @param  App\Http\Requests\Auth\LoginRequest $request;
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $user = $this->authService->login($request);
        if ($user instanceof User) {
            return new ResourcesUser($user);
        } else {
            return response()->json([
                'message'     => 'The provided credentials are incorrect.',
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }


    /**
     * Send reset password link.
     */
    public function sendResetPasswordLink(Request $request)
    {
        $result = $this->authService->sendResetPasswordLink($request);
        if ($result) return response()->json([
            'message'   => 'A Reset password link has been send to your email'
        ], JsonResponse::HTTP_OK);
    }


    /**
     * Reset password
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $result = $this->authService->resetPassword($request);
        if ($result) {
            return response()->json([
                'message'   => 'Reset password success!'
            ]);
        } else {
            return response()->json([
                'message'   => 'Opss, we can not reset your password. Maybe you already did ? Otherwise please try reset password again.'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
