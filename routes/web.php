<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataFasyankesController;
use App\Http\Controllers\DataLimbahMasukController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\DataHasilInsinerasiController;
use App\Http\Controllers\RekapitulasiController;

    /* LOGIN */
Route::get('/', [AuthController::class, 'login']);
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginProcess']);
Route::get('/logout', [AuthController::class, 'logout']);
Route::middleware('auth')->group(function () {

    /* ADMIN */
Route::get('/dashboard-admin', [DashboardController::class, 'admin']);
Route::get('/kelolauser', [UserController::class, 'index']);
Route::get('/add-user', [UserController::class, 'create']);
Route::post('/store-user', [UserController::class, 'store']);
Route::get('/edit-user/{id}', [UserController::class, 'edit']);
Route::put('/update-user/{id}', [UserController::class, 'update']);
Route::delete('/delete-user/{id}', [UserController::class, 'destroy']);

    /* STAF */
Route::get('/dashboard-staf', [DashboardController::class, 'staf']);
Route::get('/fasyankes', [DataFasyankesController::class, 'index']);
Route::get('/add-fasyankes', [DataFasyankesController::class, 'create']);
Route::post('/store-fasyankes', [DataFasyankesController::class, 'store']);
Route::get('/edit-fasyankes/{id}', [DataFasyankesController::class, 'edit']);
Route::put('/update-fasyankes/{id}', [DataFasyankesController::class, 'update']);
Route::delete('/delete-fasyankes/{id}', [DataFasyankesController::class, 'destroy']);
Route::get('/limbah-masuk', [DataLimbahMasukController::class, 'index']);
Route::get('/add-limbah-masuk', [DataLimbahMasukController::class, 'create']);
Route::post('/store-limbah-masuk', [DataLimbahMasukController::class, 'store']);
Route::get('/edit-limbah-masuk/{id}', [DataLimbahMasukController::class, 'edit']);
Route::put('/update-limbah-masuk/{id}', [DataLimbahMasukController::class, 'update']);
Route::delete('/delete-limbah-masuk/{id}', [DataLimbahMasukController::class, 'destroy']);
Route::get('/hasil-insinerasi', [DataHasilInsinerasiController::class, 'indexStaf']);
Route::get('/laporan-staf', [LaporanController::class, 'laporanStaf']);
Route::get('/download-laporan-staf', [LaporanController::class, 'downloadLaporanStaf']);

    /* PETUGAS */
Route::get('/dashboard-petugas', [DashboardController::class, 'petugas']);
Route::get('/petugas-limbah-masuk', [DataLimbahMasukController::class, 'petugasIndex']);
Route::put('/update-status-limbah/{id}', [DataLimbahMasukController::class, 'updateStatus']);
Route::get('/petugas-hasil-insinerasi', [DataHasilInsinerasiController::class, 'index']);

    /* MANAGER */
Route::get('/dashboard-manager', [DashboardController::class, 'manager']);
Route::get('/rekapitulasi-manager', [RekapitulasiController::class, 'index']);
Route::get('/laporan-manager', [LaporanController::class, 'laporanManager']);
Route::get('/download-laporan-manager', [LaporanController::class, 'downloadLaporanManager']);
});