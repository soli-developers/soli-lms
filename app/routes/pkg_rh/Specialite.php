<?php

use App\Models\User;
use App\Models\pkg_rh\Specialite;
use App\Models\pkg_rh\Formateur;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pkg_rh\SpecialiteController;


Route::middleware('auth')->group(function () {
        Route::prefix('Specialite')->group(function () {
            Route::get('/', [SpecialiteController::class, 'index'])->name('Specialite.index');
            Route::get('/create', [SpecialiteController::class, 'create'])->name('Specialite.create');
            Route::post('/store', [SpecialiteController::class, 'store'])->name('Specialite.store');
            Route::get('/show/{id}', [SpecialiteController::class, 'show'])->name('Specialite.show');
            Route::get('/{id}/edit', [SpecialiteController::class, 'edit'])->name('Specialite.edit');
            Route::post('/{id}/update', [SpecialiteController::class, 'update'])->name('Specialite.update');
            Route::delete('/{id}/delete', [SpecialiteController::class, 'destroy'])->name('Specialite.delete');
            Route::get('/export', [SpecialiteController::class, 'export'])->name('Specialite.export');
            Route::post('/import', [SpecialiteController::class, 'import'])->name('Specialite.import');    
        });
});
