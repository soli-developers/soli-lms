<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pkg_competences\AppreciationController;
use App\Models\pkg_competences\Appreciation;

// routes for Appreciation management
Route::middleware('auth')->group(function () {
    $namespace = 'App\Http\Controllers\pkg_competences';
    Route::namespace($namespace)->group(function () {
        Route::prefix('Appreciation')->group(function () {
            Route::get('/', [AppreciationController::class, 'index'])->name('Appreciation.index');
            Route::get('/Appreciation/form-ajouter', [AppreciationController::class, 'create'])->name('Appreciation.create');
            Route::post('/Appreciation/ajouter', [AppreciationController::class, 'store'])->name('Appreciation.store');
            Route::get('/Appreciation/export', [AppreciationController::class, 'export'])->name('Appreciation.export');
            Route::post('/Appreciation/import', [AppreciationController::class, 'import'])->name('Appreciation.import');
            Route::get('/Appreciation/show/{id}', [AppreciationController::class, 'show'])->name('Appreciation.show');
            Route::get('/Appreciation/{id}/edit', [AppreciationController::class, 'edit'])->name('Appreciation.edit');
            Route::put('/Appreciation/{id}/update', [AppreciationController::class, 'update'])->name('Appreciation.update');
            Route::delete('/Appreciation/{id}/delete', [AppreciationController::class, 'destroy'])->name('Appreciation.delete');

        });
    });
});
