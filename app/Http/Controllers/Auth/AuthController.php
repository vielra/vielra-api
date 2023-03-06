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
use App\Http\Requests\Auth\LoginWithSocialAccountRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->middleware(['auth:sanctum'])->only(['revokeToken']);
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
        $user = User::where('username', $request->username)->first();
        return new ResourcesUser($user);
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
            $token = $user->createToken($user->email)->plainTextToken;
            return response()->json([
                'token' => $token,
                'user'  => new ResourcesUser($user)
            ], JsonResponse::HTTP_OK);
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
        $request->validate([
            'email'     => ['required', 'email', 'exists:users,email'],
            'app_id'    => ['nullable', 'string']
        ]);
        $result = $this->authService->sendResetPasswordLink($request->only(['email', 'app_id']));
        if ($result) return response()->json([
            'message'   => 'A Reset password link has been send to your email'
        ], JsonResponse::HTTP_OK);
    }


    public function verifyTokenPasswordReset(Request $request)
    {
        $request->validate([
            'token'     => ['required', 'string'],
            'email'     => ['required', 'email', 'exists:users,email']
        ]);
        $result = $this->authService->verifyTokenPasswordReset($request->only(['email', 'token']));
        if ($result) {
            return new ResourcesUser($result);
        } else {
            return response()->json([
                'message'   => 'Invalid token or token doesn\'t exists',
                'status'    => true,
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }


    /**
     * Reset password
     */
    public function resetPassword(ResetPasswordRequest $request)
    {
        $user = $this->authService->resetPassword($request);
        if ($user) {
            $token = $user->createToken($user->email)->plainTextToken;
            return response()->json([
                'token' => $token,
                'user'  => new ResourcesUser($user)
            ], JsonResponse::HTTP_OK);
        } else {
            return response()->json([
                'message'   => 'Opss, we can not reset your password. Maybe you already did ? Otherwise please try reset password again.'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }


    /**
     * Login for Mobile App
     * Login external with social account.
     */
    public function socialAccount(LoginWithSocialAccountRequest $request, string $provider)
    {

        $request->validate([
            'provider'  => ['required', 'string', 'in:facebook,google,github']
        ]);

        $data = $request->only(['social_id', 'social_name', 'social_email', 'social_photo_url']);
        $user = $this->authService->loginWithSocialAccount($data, $provider);
        if ($user instanceof User) {
            $token = $user->createToken($user->email)->plainTextToken;
            return response()->json([
                'token' => $token,
                'user'  => new ResourcesUser($user)
            ], JsonResponse::HTTP_OK);
        } else {
            return response()->json([
                'message'     => 'Something went wrong!',
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Revoke token from the database
     */
    public function revokeToken(Request $request)
    {
        $request->validate(['currentAccessToken' => ['required', 'string']]);
        $result = $this->authService->deleteCurrentAccessToken($request->currentAccessToken);
        if ($result) {
            return response()->json([
                'message'   => 'Token has been delete!'
            ], JsonResponse::HTTP_OK);
        } else {
            return response()->json([
                'message'   => 'Failed to remove access token'
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
