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

Route::get('/', [LoginController::class, 'login'])->name('login');


Route::post('login', [LoginController::class, 'loginaksi'])->name('loginaksi');

// Route::get('home', return)->middleware('pemateri');

Route::get('logoutaksi', [LoginController::class, 'logoutaksi'])->middleware('auth')->name('logout');

// User Access
Route::middleware(['admin'])->group(function () {
    Route::get('beranda', [LoginController::class, 'beranda'])->name('welcome');
});

//Lina
Route::get('listtraining', function () {
    return view('admin.ListTraining');
});
