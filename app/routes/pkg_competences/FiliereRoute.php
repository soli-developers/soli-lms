<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pkg_competences\FiliereController;
use App\Models\pkg_competences\Filiere;

// routes for Appreciation management
Route::middleware('auth')->group(function () {
    $namespace = 'App\Http\Controllers\pkg_competences';
    Route::namespace($namespace)->group(function () {
        Route::prefix('Filiere')->group(function () {
            Route::get('/', [FiliereController::class, 'index'])->name('Filiere.index');
            Route::get('/Filiere/form-ajouter', [FiliereController::class, 'create'])->name('Filiere.create');
            Route::post('/Filiere/ajouter', [FiliereController::class, 'store'])->name('Filiere.store');
            Route::get('/Filiere/export', [FiliereController::class, 'export'])->name('Filiere.export');
            Route::post('/Filiere/import', [FiliereController::class, 'import'])->name('Filiere.import');
            Route::get('/Filiere/show/{id}', [FiliereController::class, 'show'])->name('Filiere.show');
            Route::get('/Filiere/{id}/edit', [FiliereController::class, 'edit'])->name('Filiere.edit');
            Route::put('/Filiere/{id}/update', [FiliereController::class, 'update'])->name('Filiere.update');
            Route::delete('/Filiere/{id}/delete', [FiliereController::class, 'destroy'])->name('Filiere.delete');

        });
    });
});
