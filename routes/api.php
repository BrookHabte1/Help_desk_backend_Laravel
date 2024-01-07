<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\EmailController;

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

//emails
Route::get('emails', [EmailController::class, 'index']);
Route::post('emails', [EmailController::class, 'store']);
Route::get('emails/{id}', [EmailController::class, 'show']);
Route::get('emails/{id}/edit', [EmailController::class, 'edit']);
Route::put('emails/{id}/edit', [EmailController::class, 'update']);
Route::delete('emails/{id}/delete', [EmailController::class, 'destroy']);

//FAQs
Route::get('faqs', [FaqController::class, 'index']);
Route::post('faqs', [FaqController::class, 'store']);
Route::get('faqs/{id}', [FaqController::class, 'show']);
Route::get('faqs/{id}/edit', [FaqController::class, 'edit']);
Route::put('faqs/{id}/edit', [FaqController::class, 'update']);
Route::delete('faqs/{id}/delete', [FaqController::class, 'destroy']);