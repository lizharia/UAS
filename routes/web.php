<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AccountController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/admin/accounts', [AccountController::class, 'store'])->name('admin.store');
Route::get('/admin/home', [AccountController::class, 'index'])->name('admin.home');
Route::put('/admin/accounts/{id}', [AccountController::class, 'update'])->name('admin.update');
Route::delete('/admin/accounts/{id}', [AccountController::class, 'destroy'])->name('admin.destroy');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/home', [AccountController::class, 'index'])->name('admin.home');
});

Route::get('/about', function () {
    return view('about');
});
