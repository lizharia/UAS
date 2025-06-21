<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/home', function () {
        return view('admin.home');
    });
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/katalog', function () {
    return view('katalog');
});

Route::get('/kontak', function () {
    return view('kontak');
});

Route::get('/portofolio', function () {
    return view('portofolio');
});