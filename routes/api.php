<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MpesaResponsesController;


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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
