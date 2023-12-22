<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/contact', function() {
    return view('contact');
});

Route::middleware(RedirectIfAuthenticated::class)->group(function() {
    Route::get('/register', [UserController::class, 'register']);
    Route::put('/register', [UserController::class, 'store']);

    Route::get('/login', [UserController::class, 'login']);
    Route::post('/login', [UserController::class, 'authenticate']);
});

Route::middleware(Authenticate::class)->group(function() {
    Route::get('/logout', [UserController::class, 'logout']);
    Route::post('/logout', [UserController::class, 'logout']);

    Route::get('/dashboard', [TaskController::class, 'dashboard']);

    Route::get('/tasks/create', [TaskController::class, 'create']);
    Route::put('/tasks/create', [TaskController::class, 'store']);

    Route::get('/tasks/edit/{task}', [TaskController::class, 'edit']);
    Route::put('/tasks/edit/{task}', [TaskController::class, 'update']);
    Route::get('/tasks/delete/{task}', [TaskController::class, 'destroy']);
    Route::delete('/tasks/delete/{task}', [TaskController::class, 'destroy']);
});