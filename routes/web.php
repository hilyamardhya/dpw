<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return view('welcome');
});
Route::redirect('/', '/login');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login/akun', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register/akun', [AuthController::class, 'register'])->name('register.post');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/home/profile', [HomeController::class, 'getUserProfile'])->name('user.profile');
Route::get('/home/movies/latest', [HomeController::class, 'getLatestMovies'])->name('movies.latest');


Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('auth');
Route::get('/admin/data', [AdminController::class, 'getAdminData'])->name('admin.data');
Route::post('/admin/movies', [AdminController::class, 'storeMovie'])->name('admin.movies.store');
Route::get('/admin/movies', [AdminController::class, 'getMovies'])->name('admin.movies.index');
Route::get('/admin/movies/{id}', [AdminController::class, 'getMovieById'])->name('admin.movies.get');
Route::post('/admin/movies/{id}/edit', [AdminController::class, 'editMovie'])->name('admin.movies.edit');
Route::delete('/admin/movies/{id}/delete', [AdminController::class, 'deleteMovie'])->name('admin.movies.delete');

Route::post('/movies/{id}/favorite', [HomeController::class, 'addToFavorites'])->name('movies.add_to_favorites');
Route::delete('/movies/{id}/favorite', [HomeController::class, 'removeFromFavorites'])->name('movies.remove_from_favorites');


Route::get('/clear-sessions', function () {
    DB::table('sessions')->delete();
    return 'Sessions cleared!';
});