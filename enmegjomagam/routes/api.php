<?php

use App\Http\Controllers\Api\AbilityController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\CreatureAbilityController;
use App\Http\Controllers\Api\CreatureController;
use App\Http\Controllers\Api\CreatureGalleryController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('/login', [AuthController::class, 'login']);
Route::post('/contact', [ContactController::class, 'store']);

// Categories - public read access
Route::get('/categories', [CategoryController::class, 'index']);

// Abilities - public read access
Route::get('/abilities', [AbilityController::class, 'index']);

// Creatures - public read access
Route::get('/creatures', [CreatureController::class, 'index']);
Route::get('/creatures/{id}', [CreatureController::class, 'show']);
Route::get('/creatures/{id}/gallery', [CreatureGalleryController::class, 'index']);

// Creatures - public write access (for testing/demo)
Route::post('/creatures', [CreatureController::class, 'store']);
Route::put('/creatures/{id}', [CreatureController::class, 'update']);
Route::patch('/creatures/{id}', [CreatureController::class, 'update']);
Route::post('/creatures/{id}/abilities', [CreatureAbilityController::class, 'attach']);
Route::delete('/creatures/{id}/abilities/{abilityId}', [CreatureAbilityController::class, 'detach']);

// Protected routes (require authentication)
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Creatures - protected write access
    Route::delete('/creatures/{id}', [CreatureController::class, 'destroy']);
    
    // Creature gallery
    Route::post('/creatures/{id}/gallery', [CreatureGalleryController::class, 'store']);
});
