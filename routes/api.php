<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/tasks', [App\Http\Controllers\TaskController::class, 'index'])->name('task.index');
Route::put('/tasks/{task}/set_completed_at', [App\Http\Controllers\TaskController::class, 'set_completed_at'])->name('task.set_completed_at');
Route::put('/tasks/{task}', [App\Http\Controllers\TaskController::class, 'update'])->name('task.update');
Route::post('/tasks', [App\Http\Controllers\TaskController::class, 'store'])->name('task.store');
