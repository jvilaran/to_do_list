<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', [TaskController::class, 'index']);

// to-do list routes
Route::get('/tasks/create', [TaskController::class, 'create']);   // Show create form
Route::post('/tasks/store', [TaskController::class, 'store']);    // Process form
Route::get('/tasks/{id}', [TaskController::class, 'show']);       // Show specific task
Route::get('/tasks/{id}/edit', [TaskController::class, 'edit']);  // Show edit form
Route::put('/tasks/{id}', [TaskController::class, 'update']);     // Update task
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']); // Delete task