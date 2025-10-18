<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::get('/', function () {
    return view('welcome');
});

// to-do list routes
Route::get('/tasks', [TaskController::class, 'index']);           // List tasks
Route::get('/tasks/create', [TaskController::class, 'create']);   // Show create form
Route::post('/tasks', [TaskController::class, 'store']);          // Process form
Route::get('/tasks/{id}', [TaskController::class, 'show']);       // Show specific task