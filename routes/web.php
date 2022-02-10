<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function() {
    // user
    Route::get('/users/{user}/profile', [UserController::class, 'show'])->name('user.profile.show');
    Route::put('/users/{user}/update', [UserController::class, 'update'])->name('user.profile.update');

    // project
    Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('project.create');
    Route::post('/projects', [App\Http\Controllers\ProjectController::class, 'store'])->name('project.store');
    Route::get('/project/{project}', [App\Http\Controllers\ProjectController::class, 'show'])->name('project.show');

    Route::get('/project/{project}/edit', [App\Http\Controllers\ProjectController::class, 'edit'])->name('project.edit');
    Route::delete('/projects/{project}/destroy', [App\Http\Controllers\ProjectController::class, 'destroy'])->name('project.destroy');
    Route::patch('/projects/{project}/update', [App\Http\Controllers\ProjectController::class, 'update'])->name('project.update');

    // board 
    Route::post('/project/{project}/boards', [App\Http\Controllers\BoardController::class, 'store'])->name('board.store');
    Route::get('/board/{board}/edit', [App\Http\Controllers\BoardController::class, 'edit'])->name('board.edit');
    Route::patch('/board/{board}/update', [App\Http\Controllers\BoardController::class, 'update'])->name('board.update');
    Route::delete('/board/{board}/destroy', [App\Http\Controllers\BoardController::class, 'destroy'])->name('board.destroy');

    // task
    Route::get('board/{board}/task/create', [App\Http\Controllers\TaskController::class, 'create'])->name('task.create');
    Route::post('board/{board}/tasks', [App\Http\Controllers\TaskController::class, 'store'])->name('task.store');
    Route::get('/task/{task}/edit', [App\Http\Controllers\TaskController::class, 'edit'])->name('task.edit');
    Route::get('/task/{task}', [App\Http\Controllers\TaskController::class, 'index'])->name('task.index');
    Route::delete('/task/{task}/destroy', [App\Http\Controllers\TaskController::class, 'destroy'])->name('task.destroy');
});
