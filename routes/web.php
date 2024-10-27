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
use App\Http\Controllers\BerandaPesertaController;
use App\Http\Controllers\DetailTrainingPeserta;
use App\Http\Controllers\UsulanController;

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

Route::get('/detailTrainingPeserta/{id}', [DetailTrainingPeserta::class, 'detailTrainingPeserta']);
Route::get('/detailMeetPeserta/{id}', [DetailTrainingPeserta::class, 'detailMeetPeserta']);
Route::get('/modulPeserta/{id}', [DetailTrainingPeserta::class, 'modulPeserta']);

//listtrainer
Route::get('listtrainer', [ListTrainerController::class, 'index'])->name('listtrainer');
//verif
Route::get('verif-trainer', [VerifTrainerController::class, 'verifTrainer'])->name('verifTrainer');
Route::post('/verif-trainer/update-status', [VerifTrainerController::class, 'updateStatus'])->name('verif-trainer');
Route::post('/verif-trainer/update2-status', [VerifTrainerController::class, 'update2Status'])->name('verif-trainer-delete');
//Approve
Route::get('approve-trainer', [ApproveTrainerController::class, 'approvetrainer'])->name('approvetrainer');

Route::get('/BerandaAdmin',[BerandaAdminController::class, 'beranda_admin'])->name('beranda.admin');
Route::get('/Beranda', [BerandaPesertaController::class, 'CardTraining'])->name('beranda_peserta');
Route::post('/usulan', [BerandaPesertaController::class, 'store'])->name('usulan.store');
Route::put('/usulan/{id_usulan}', [UsulanController::class, 'update'])->name('usulan.update');

Route::get('/admin/usulan', [UsulanController::class, 'view_usulan'])->name('admin.usulan');
Route::delete('/training/{id}', [BerandaAdminController::class, 'delete'])->name('training.delete');

//Route::get('/delete/{id}',[BerandaAdminController::class, 'delete'])->name('delete');

// User Access
Route::middleware(['checkRole:admin'])->group(function () {
    Route::get('admin', [LoginController::class, 'beranda'])->name('welcome');
});

Route::middleware(['checkRole:pemateri'])->group(function () {
    Route::get('pemateri', [LoginController::class, 'beranda'])->name('welcome');
});

Route::middleware(['checkRole:admin,pemateri'])->group(function () {
    // Detail Training PAGE
    Route::get('/detailTraining/{id}', [DetailTraining::class, 'detailTraining'])->name('detailTraining');
    Route::patch('/detailTraining/{id}', [EditTraining::class, 'editTraining'])->name('editTraining');

    Route::get('/detailTraining/modul/{id}', [DetailTraining::class, 'modul'])->name('showModulTraining');
    Route::post('/detailTraining/modul/{id}', [DetailTraining::class, 'addModulFromList'])->name('addModulFromList');
    Route::post('/detailTraining/modul/list/{id}', [DetailTraining::class, 'tambahModul'])->name('addModulTraining');
    Route::delete('/detailTraining/modul/{id}', [DetailTraining::class, 'deleteModulTraining'])->name('deleteModulTraining');

    Route::get('/detailTraining/meet/MT{id}', [DetailTraining::class, 'detailMeet'])->name('detailMeet');
    Route::post('/detailTraining/meet', [DetailTraining::class, 'tambahMeet'])->name('addMeet');
    Route::patch('/detailTraining/meet/{id}', [DetailTraining::class, 'editMeet'])->name('editMeet');
    Route::delete('/detailTraining/meet/{id}', [DetailTraining::class, 'deleteMeet'])->name('deleteMeet');
    Route::post('/detailTraining/meet/attendance/{id}', [Attendance::class, 'attendanceTrainer'])->name('absen');




    // Modul Global PAGE
    Route::get('/listModul', [ModulController::class, 'showModul'])->name('listModul');
    Route::post('/listModul', [ModulController::class, 'tambahModul'])->name('tambahModul');
    Route::post('/listModul/edit', [ModulController::class, 'editModul'])->name('editModul');
    Route::delete('/listModul', [ModulController::class, 'deleteModul'])->name('deleteModul');
    Route::get('/listModul/search', [ModulController::class, 'searchModul'])->name('searchModul');

});

Route::middleware(['checkRole:peserta'])->group(function () {
    Route::get('peserta', [LoginController::class, 'beranda'])->name('welcome');
});


Route::get('/preview-training',[PreviewTrainingController::class, 'previewTraining'])->name('preview-training');