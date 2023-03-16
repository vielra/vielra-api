<?php

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\PhraseAudioController;
use App\Http\Controllers\PhraseCategoryController;
use App\Http\Controllers\PhraseController;
use App\Http\Controllers\PhraseReportController;
use App\Http\Controllers\SpeechNameController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the 'api' middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/', function () {
    return Response::json([
        'message'   => 'Xin Chào 👋',
    ], JsonResponse::HTTP_OK);
});

/**
 * -----------
 * Auth routes
 * -----------
 */
Route::prefix('/auth')->group(function () {
    Route::post('/register', [AuthController::class, 'registerWithEmailAndPassword']);
    Route::post('/login-check-username', [AuthController::class, 'checkUsername']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/send-reset-password-link', [AuthController::class, 'sendResetPasswordLink']);
    Route::post('/password-reset/verify', [AuthController::class, 'verifyTokenPasswordReset']);
    Route::post('/password-reset', [AuthController::class, 'resetPassword']);
    Route::post('/login/{provider}', [AuthController::class, 'socialAccount']);
    Route::post('/revoke-token', [AuthController::class, 'revokeToken']);
    Route::get('/{provider}/url', [SocialAuthController::class, 'getUrl']);
    Route::get('/{provider}/callback', [SocialAuthController::class, 'callback']);
});

/**
 * -----------
 * Phrasebook routes
 * -----------
 */
Route::prefix('/phrasebook')->group(function () {
    Route::apiResource('/category', PhraseCategoryController::class);
    Route::post('/phrase/delete', [PhraseController::class, 'destroy']);
    Route::post('/phrase/confirm', [PhraseController::class, 'confirm']);
    Route::apiResource('/phrase/report', PhraseReportController::class)->only(['index', 'store']);
    Route::apiResource('/phrase', PhraseController::class)->except(['destroy']);
    Route::apiResource('/audio', PhraseAudioController::class);
});

/**
 * -----------
 * Speech name routes
 * -----------
 */
Route::apiResource('/speech-name', SpeechNameController::class)->only(['index']);

/** This route only for development */
Route::get('/get-uuid', function () {
    return \Illuminate\Support\Str::orderedUuid()->toString();
});
