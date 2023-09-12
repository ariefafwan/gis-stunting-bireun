<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ClusterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KecamatanController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/', [LoginController::class, 'login']);

Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm']);

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //kecamatan
    Route::get('/admin/daftarkecamatan', [KecamatanController::class, 'index'])->name('kecamatan.index');
    Route::get('/admin/editkecamatan/{id}', [KecamatanController::class, 'edit'])->name('kecamatan.edit');
    Route::post('/admin/storekecamatan', [KecamatanController::class, 'store'])->name('kecamatan.store');
    Route::post('/admin/updatekecamatan', [KecamatanController::class, 'update'])->name('kecamatan.update');
    Route::post('/admin/destroykecamatan/{id}', [KecamatanController::class, 'destroy'])->name('kecamatan.destroy');
    Route::post('/getimportkecamatan', [KecamatanController::class, 'importdata'])->name('kecamatan.import');

    // periode tahun
    Route::get('/admin/periodedatakasus', [AdminController::class, 'tahunindex'])->name('tahun.index');
    Route::post('/admin/storeperiodetahun', [AdminController::class, 'tahunstore'])->name('tahun.store');
    Route::post('/admin/destroyperiodetahun/{id}', [AdminController::class, 'tahundestroy'])->name('tahun.destroy');

    //data
    Route::get('/admin/getdata', [HomeController::class, 'data'])->name('getdata');
    Route::get('/admin/daftardatakasus', [AdminController::class, 'index'])->name('data.index');
    Route::get('/admin/editdatakasus/{id}', [AdminController::class, 'edit'])->name('data.edit');
    Route::post('/admin/storedatakasus', [AdminController::class, 'store'])->name('data.store');
    Route::post('/admin/updatedatakasus', [AdminController::class, 'update'])->name('data.update');
    Route::post('/admin/destroydatakasus/{id}', [AdminController::class, 'destroy'])->name('data.destroy');
    Route::post('/getimportdata', [AdminController::class, 'importdata'])->name('data.import');
    Route::get('/getexportdata', [AdminController::class, 'exportdata'])->name('data.export');

    //cluster 
    Route::get('/admin/datacluster', [ClusterController::class, 'index'])->name('cluster.index');
    Route::get('/admin/iddatacluster/{id}', [ClusterController::class, 'edit'])->name('cluster.edit');
    Route::post('/admin/storedatacluster', [ClusterController::class, 'store'])->name('cluster.store');
    Route::post('/admin/updatedatacluster', [ClusterController::class, 'update'])->name('cluster.update');
    Route::post('/admin/destroydatacluster/{id}', [ClusterController::class, 'destroy'])->name('cluster.destroy');
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout');
