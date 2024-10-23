<?php

use App\Http\Controllers\CreateTrainingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DetailTraining;
use App\Http\Controllers\RegistController;
use App\Http\Controllers\ListTrainerController;
use App\Http\Controllers\VerifTrainerController;
use App\Http\Controllers\ApproveTrainerController;
use App\Http\Controllers\EditTraining;
use App\Http\Controllers\Attendance;
use App\Http\Controllers\BerandaAdminController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\PreviewTrainingController;

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
Route::post('/tambahModulTraining', [DetailTraining::class, 'tambahModul'])->name('tambahModulTraining');
Route::post('/attendance', [Attendance::class, 'attendanceTrainer'])->name('absen');
// Route::post('/editTraining/{id}', [DetailTraining::class, 'tambahMeet'])->name('tambahmeet');

Route::post('/editTraining', [EditTraining::class, 'editTraining'])->name('editTraining');
Route::get('/detailTraining/{id}', [DetailTraining::class, 'detailTraining']);
Route::get('/detailMeet/MT{id}', [DetailTraining::class, 'detailMeet']);
Route::get('/modul/{id}', [DetailTraining::class, 'modul']);

//listtrainer
Route::get('listtrainer', [ListTrainerController::class, 'index']);
//verif
Route::get('verif-trainer', [VerifTrainerController::class, 'verifAdmin']);
//Approve
Route::get('approve-trainer', [ApproveTrainerController::class, 'approvetrainer']);

Route::get('/listModul', [ModulController::class, 'showModul'])->name('listModul');
Route::post('/tambahModul', [ModulController::class, 'tambahModul'])->name('tambahModul');
Route::post('/editModul', [ModulController::class, 'editModul'])->name('editModul');
Route::delete('/deleteModul', [ModulController::class, 'deleteModul'])->name('deleteModul');
Route::get('/search', [ModulController::class, 'searchModul'])->name('searchModul');

Route::get('/BerandaAdmin',[BerandaAdminController::class, 'beranda_admin'])->name('beranda.admin');

// Route::get('home', return)->middleware('pemateri');

// User Access
Route::middleware(['admin'])->group(function () {
    Route::get('admin', [LoginController::class, 'beranda'])->name('welcome');
});

//Lina
Route::get('listtraining', function () {
    return view('admin.ListTraining');
});

Route::get('approvetrainer', function () {
    return view('admin.ApproveTrainer');
})->name('approvetrainer');

Route::middleware(['pemateri'])->group(function () {
    Route::get('pemateri', [LoginController::class, 'beranda'])->name('welcome');
});

Route::middleware(['peserta'])->group(function () {
    Route::get('peserta', [LoginController::class, 'beranda'])->name('welcome');
});


Route::get('/preview-training',[PreviewTrainingController::class, 'previewTraining'])->name('preview-training');
