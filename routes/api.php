<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\EmailController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('orders', OrderController::class);
Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus']);

Route::post('emails', [EmailController::class, 'sendEmail']);
