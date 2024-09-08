<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;

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

// Route::get('/', 'LoginController@login')->name('login');
Route::get('/', [LoginController::class, 'login'])->name('login');


Route::post('login', [LoginController::class, 'loginaksi'])->name('loginaksi');
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('register', [RegisterController::class, 'registeraksi'])->name('registeraksi');

Route::get('home', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('logoutaksi', [LoginController::class, 'logoutaksi'])->name('logoutaksi')->middleware('auth');

// User Access
Route::middleware('admin')->group(function () {
    Route::get('welcome', [LoginController::class, 'beranda']);
});