<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TasksController;
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

// 未ログイン時のルート
Route::view('/', function () {
    return view('dashboard');
});

Route::middleware('guest')->group(function () {
    // ログインルート
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);

    // サインアップルート
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

    Route::middleware('auth')->group(function () {
    // ダッシュボード
    Route::get('/dashboard', [TasksController::class, 'index'])->name('index');

    // タスク関連ルート
    Route::get('/tasks/create', [TasksController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TasksController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}', [TasksController::class, 'show'])->name('tasks.show');
    Route::get('/tasks', [TasksController::class, 'index'])->name('tasks.index');
    Route::delete('/tasks/{task}', [TasksController::class, 'destroy'])->name('tasks.destroy');
    Route::get('/tasks/{task}/edit', [TasksController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TasksController::class, 'update'])->name('tasks.update');

    // ログアウトルート
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

require __DIR__.'/auth.php';