<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MpesaResponsesController;
use App\Http\Controllers\MpesaController;

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
Route::post('/mobile-money/confirmation', [MpesaResponsesController::class, 'confirmation']);
Route::post('/mobile-money/validation', [MpesaResponsesController::class, 'validation']);
Route::post('/mobile-money/stk', [MpesaResponsesController::class, 'stkLog']);
Route::post('/get-token', [MpesaController::class, 'getAccessToken']);
Route::post('/register-url', [MpesaController::class, 'registerURLS']);
Route::post('/mobile-money/simulate', [MpesaController::class, 'simulateTransaction']);
Route::get('/mobile-money/password', [MpesaController::class, 'lipaNaMpesaPassword']);
Route::post('/mobile-money/stk/push', [MpesaController::class, 'stkPush']);
Route::post('/mobile-money/stk/callbackurl', [MpesaController::class, 'reponseUrl']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
