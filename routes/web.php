<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KecamatanController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
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
    Route::get('/admin/daftardatakasus', [AdminController::class, 'index'])->name('data.index');
    Route::get('/admin/editdatakasus/{id}', [AdminController::class, 'edit'])->name('data.edit');
    Route::post('/admin/storedatakasus', [AdminController::class, 'store'])->name('data.store');
    Route::post('/admin/updatedatakasus', [AdminController::class, 'update'])->name('data.update');
    Route::post('/admin/destroydatakasus/{id}', [AdminController::class, 'destroy'])->name('data.destroy');
    Route::post('/getimportdata', [AdminController::class, 'importdata'])->name('data.import');
    Route::get('/getexportdata', [AdminController::class, 'exportdata'])->name('data.export');
});
