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
    Route::get('/users/{user}/profile', [UserController::class, 'show'])->name('user.profile.show');
    Route::put('/users/{user}/update', [UserController::class, 'update'])->name('user.profile.update');


    Route::get('/projects', [App\Http\Controllers\ProjectController::class, 'index'])->name('project.index');
    Route::get('/project/create', [App\Http\Controllers\ProjectController::class, 'create'])->name('project.create');
    // Route::post('/posts', [App\Http\Controllers\PostController::class, 'store'])->name('post.store');
    Route::get('/project/{project}', [App\Http\Controllers\ProjectController::class, 'show'])->name('project.show');

    // Route::get('/posts/{post}/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::delete('/projects/{project}/destroy', [App\Http\Controllers\ProjectController::class, 'destroy'])->name('project.destroy');
    // Route::patch('/posts/{post}/update', [App\Http\Controllers\PostController::class, 'update'])->name('post.update');
});
