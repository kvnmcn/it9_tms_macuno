<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;



Route::resource('tasks', TaskController::class);
Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggleStatus'])->name('tasks.toggle');

Route::get('/', function () {
    return view('tasks.index');
});
