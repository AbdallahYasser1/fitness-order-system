<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('orders', OrderController::class);
Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus']);

Route::post('send-email', [EmailController::class, 'sendEmail']);
