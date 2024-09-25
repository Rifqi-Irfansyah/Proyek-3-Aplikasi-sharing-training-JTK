<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DetailTraining;
use App\Http\Controllers\RegistController;

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

Route::get('/register-peserta', [RegistController::class, 'showPesertaForm'])->name('register.peserta');
Route::get('/register-trainer', [RegistController::class, 'showTrainerForm'])->name('register.trainer');

Route::post('/register-peserta', [RegistController::class, 'registerPeserta'])->name('register.peserta.submit');
Route::post('/register-trainer', [RegistController::class, 'registerTrainer'])->name('register.trainer.submit');

Route::get('/detailTraining/{id}', [DetailTraining::class, 'detailTraining']);


Route::post('login', [LoginController::class, 'loginaksi'])->name('loginaksi');

// Route::get('home', return)->middleware('pemateri');

Route::get('logoutaksi', [LoginController::class, 'logoutaksi'])->middleware('auth')->name('logout');

// User Access
Route::middleware(['admin'])->group(function () {
    Route::get('beranda', [LoginController::class, 'beranda'])->name('welcome');
});

Route::middleware(['pemateri'])->group(function () {
    Route::get('pemateri', [LoginController::class, 'beranda'])->name('welcome');
});
