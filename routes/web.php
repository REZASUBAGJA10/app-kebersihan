<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;




    Route::get('/', [PublicController::class, 'index'])->name('public.index');
    Route::middleware(['auth', 'verified', 'prevent-back'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');
    Route::resource('kelas', KelasController::class);
    Route::resource('kriteria', KriteriaController::class);
    Route::get('/laporan', [PenilaianController::class, 'index'])
        ->name('laporan.index');

    Route::get('/laporan/list', [PenilaianController::class, 'index'])
        ->name('penilaian.index');

    Route::get('/laporan/pdf', [PenilaianController::class, 'exportPdf'])
        ->name('laporan.pdf');

    Route::get('/laporan/excel', [PenilaianController::class, 'exportExcel'])
        ->name('laporan.excel');

    Route::get('/penilaian/create', [PenilaianController::class, 'create'])
        ->name('penilaian.create');

    Route::post('/penilaian/store', [PenilaianController::class, 'store'])
        ->name('penilaian.store');

    Route::get('/laporan/detail/{id}', [PenilaianController::class, 'show'])
        ->name('penilaian.show');

    Route::get('/laporan/edit/{id}', [PenilaianController::class, 'edit'])
        ->name('penilaian.edit');
    Route::put('/kelas/{id}', [KelasController::class, 'update'])->name('kelas.update');

    Route::put('/laporan/update/{id}', [PenilaianController::class, 'update'])
        ->name('penilaian.update');

    Route::delete('/laporan/delete/{id}', [PenilaianController::class, 'destroy'])
        ->name('penilaian.destroy');

  
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';
