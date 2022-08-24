<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PhraseAudioController;
use App\Http\Controllers\PhraseCategoryController;
use App\Http\Controllers\PhraseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * -----------
 * Auth routes
 * -----------
 */
Route::prefix("/auth")->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login-check-username', [AuthController::class, 'checkUsername']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/send-reset-password-link', [AuthController::class, 'sendResetPasswordLink']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
    Route::post('/login/{provider}', [AuthController::class, 'socialAccount']);
    Route::post('/revoke-token', [AuthController::class, 'revokeToken']);
});


/**
 * -----------
 * Phrasebook routes
 * -----------
 */
Route::prefix('/phrasebook')->group(function () {
    Route::apiResource('/category', PhraseCategoryController::class);
    Route::post('/phrase/delete', [PhraseController::class, 'destroy']);
    Route::apiResource('/phrase', PhraseController::class)->except(['destroy']);
    Route::apiResource('/audio', PhraseAudioController::class);
});


Route::get('/get-uuid', function () {
    return \Illuminate\Support\Str::orderedUuid()->toString();
});
