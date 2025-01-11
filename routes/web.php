<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;

// Halaman Login sebagai default (ubah route home menjadi login jika diinginkan)
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');

// Halaman Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Halaman Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

// Halaman Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Halaman Profile, hanya untuk pengguna yang sudah login
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
