<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\CreatureAbilityController;
use App\Http\Controllers\Api\CreatureController;
use App\Http\Controllers\Api\CreatureGalleryController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/contact', [ContactController::class, 'store']);

// Creatures - public read access
Route::get('/creatures', [CreatureController::class, 'index']);
Route::get('/creatures/{id}', [CreatureController::class, 'show']);
Route::get('/creatures/{id}/gallery', [CreatureGalleryController::class, 'index']);

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Creatures - protected write access
    Route::post('/creatures', [CreatureController::class, 'store']);
    Route::put('/creatures/{id}', [CreatureController::class, 'update']);
    Route::delete('/creatures/{id}', [CreatureController::class, 'destroy']);
    
    // Creature abilities
    Route::post('/creatures/{id}/abilities', [CreatureAbilityController::class, 'attach']);
    Route::delete('/creatures/{id}/abilities/{abilityId}', [CreatureAbilityController::class, 'detach']);
    
    // Creature gallery
    Route::post('/creatures/{id}/gallery', [CreatureGalleryController::class, 'store']);
});
