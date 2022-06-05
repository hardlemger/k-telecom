<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\EquipmentController;
use App\Http\Controllers\Api\EquipmentTypesController;
use App\Http\Controllers\Api\AuthController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('equipment', EquipmentController::class);
    Route::apiResource('equipment-type', EquipmentTypesController::class);
});

Route::post('user/login', [AuthController::class, 'login']);
