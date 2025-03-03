<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeliveryScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post("/auth/register", [AuthController::class, "register"]);
Route::post("/auth/token", [AuthController::class,"token"]);

Route::middleware("auth:sanctum")->group(function (){
    Route::post("/auth/invalidateToken", [AuthController::class, "invalidateToken"]);

    Route::middleware("role:driver")->group(function (){
        Route::apiResource("delivery-schedule", DeliveryScheduleController::class, );
    });

    Route::middleware("role:client")->group(function(){
        Route::apiResource("address", AddressController::class);
    });
});
