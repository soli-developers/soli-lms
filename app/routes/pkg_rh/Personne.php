<?php

use App\Models\User;
use App\Models\pkg_rh\Personne;
use App\Models\pkg_rh\Formateur;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pkg_rh\PersonneController;

// Namespace all routes within this file
Route::get('/tests', function () { return Personne::all()->where('type', User::FORMATEUR);
});

Route::middleware('auth')->group(function () {
        Route::prefix('Apprenant')->group(function () {
            Route::get('/', [PersonneController::class, 'index'])->name('Apprenant.index');
            Route::get('/create', [PersonneController::class, 'create'])->name('Apprenant.create');
            Route::post('/store', [PersonneController::class, 'store'])->name('Apprenant.store');
            Route::get('/show/{id}', [PersonneController::class, 'show'])->name('Apprenant.show');
            Route::get('/{id}/edit', [PersonneController::class, 'edit'])->name('Apprenant.edit');
            Route::post('/{id}/update', [PersonneController::class, 'update'])->name('Apprenant.update');
            Route::delete('/{id}/delete', [PersonneController::class, 'destroy'])->name('Apprenant.delete');
            Route::delete('/{id}/delete', [PersonneController::class, 'destroy'])->name('Apprenant.delete');
            Route::get('/export', [PersonneController::class, 'export'])->name('Apprenant.export');
            Route::post('/import', [PersonneController::class, 'import'])->name('Apprenant.import');    
        });
        Route::prefix('Formateur')->group(function () {
            Route::get('/', [PersonneController::class, 'index'])->name('Formateur.index');
            Route::get('/create', [PersonneController::class, 'create'])->name('Formateur.create');
            Route::post('/store', [PersonneController::class, 'store'])->name('Formateur.store');
            Route::get('/show/{id}', [PersonneController::class, 'show'])->name('Formateur.show');
            Route::get('/{id}/edit', [PersonneController::class, 'edit'])->name('Formateur.edit');
            Route::post('/{id}/update', [PersonneController::class, 'update'])->name('Formateur.update');
            Route::delete('/{id}/delete', [PersonneController::class, 'destroy'])->name('Formateur.delete');
            Route::get('/export', [PersonneController::class, 'export'])->name('Formateur.export');
            Route::post('/import', [PersonneController::class, 'import'])->name('Formateur.import');    
        });
});
