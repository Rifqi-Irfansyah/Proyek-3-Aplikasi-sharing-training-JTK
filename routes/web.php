<?php

use App\Http\Controllers\CreateTrainingController;
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
Route::post('login', [LoginController::class, 'loginaksi'])->name('loginaksi');
Route::get('logoutaksi', [LoginController::class, 'logoutaksi'])->middleware('auth')->name('logout');

Route::get('/pra-register', function () {
    return view('auth.pra_register');
})->name('register.choice');

Route::get('/register-peserta', [RegistController::class, 'showPesertaForm'])->name('register.peserta');
Route::get('/register-trainer', [RegistController::class, 'showTrainerForm'])->name('register.trainer');

Route::post('/register-peserta', [RegistController::class, 'registerPeserta'])->name('register.peserta.submit');
Route::post('/register-trainer', [RegistController::class, 'registerTrainer'])->name('register.trainer.submit');

Route::get('/training/create', [CreateTrainingController::class, 'create'])->name('training.create');
Route::post('/training/store', [CreateTrainingController::class, 'store'])->name('training.store');
Route::get('/training/meetings/{jumlah_pertemuan}/{id_training}', [CreateTrainingController::class, 'createMeetings'])->name('create.meetings');
Route::post('/training/meetings/store', [CreateTrainingController::class, 'storeMeetings'])->name('meeting.store');

Route::post('/tambahMeet', [DetailTraining::class, 'tambahMeet'])->name('tambahmeet');
Route::post('/tambahModul', [DetailTraining::class, 'tambahModul']);
Route::get('/detailTraining/{id}', [DetailTraining::class, 'detailTraining']);
Route::get('/detailMeet/MT{id}', [DetailTraining::class, 'detailMeet']);
Route::get('/modul/{id}', [DetailTraining::class, 'modul']);



// Route::get('home', return)->middleware('pemateri');


// User Access
Route::middleware(['admin'])->group(function () {
    Route::get('admin', [LoginController::class, 'beranda'])->name('welcome');
});

Route::middleware(['pemateri'])->group(function () {
    Route::get('pemateri', [LoginController::class, 'beranda'])->name('welcome');
});

Route::middleware(['peserta'])->group(function () {
    Route::get('peserta', [LoginController::class, 'beranda'])->name('welcome');
});
