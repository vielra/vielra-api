<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Send otp reset password
     */
    public function sendOtpResetPassword(Request $request): \Illuminate\Http\Response | JsonResponse | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->errors()], 422);
        }
        try {
            $result = $this->authService->sendOtpResetPassword($request->email);
            return response()->json(['status' => true, 'message' => $result], JsonResponse::HTTP_OK);
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Verify token/code
     */
    public function verifyCode(Request $request): \Illuminate\Http\Response | JsonResponse | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:255'],
            'code'  => ['required'],
        ]);

        if ($validator->fails()) {
            return new JsonResponse(['errors' => $validator->errors()], 422);
        }
        try {
            $result = $this->authService->verifyCode($request->email, $request->code);
            return response()->json([
                'status'    => true,
                'message'   => $result['message'],
                'token'     => $result['token'],
            ], JsonResponse::HTTP_OK);
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Reset Password
     */
    public function resetPassword(ResetPasswordRequest $request): \Illuminate\Http\Response | JsonResponse | \Illuminate\Contracts\Foundation\Application | \Illuminate\Contracts\Routing\ResponseFactory
    {
        try {
            $result = $this->authService->resetPassword($request);
            return response()->json([
                'status'      => true,
                'user'        => $result['user'],
                'token'       => $result['token']
            ], JsonResponse::HTTP_OK);
        } catch (Exception $exception) {
            return response(['status' => false, 'message' => $exception->getMessage()], JsonResponse::HTTP_BAD_REQUEST);
        }
    }
}
