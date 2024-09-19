<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pkg_competences\TechnologieController;

// routes for project management
Route::middleware('auth')->group(function () {
    Route::prefix('/technologies')->group(function () {
        Route::get('/', [TechnologieController::class, 'index'])->name('technologies.index');
            Route::get('/technologies/form-ajouter', [TechnologieController::class, 'create'])->name('technologies.create');
            Route::post('/technologies/ajouter', [TechnologieController::class, 'store'])->name('technologies.store');
            Route::get('technologies/export', [TechnologieController::class, 'export'])->name('technologies.export');
            Route::post('technologies/import', [TechnologieController::class, 'import'])->name('technologies.import');
            Route::get('/technologies/show/{id}', [TechnologieController::class, 'show'])->name('technologies.show');
            Route::get('/technologies/{id}/edit', [TechnologieController::class, 'edit'])->name('technologies.edit');
            Route::put('/technologies/{id}/update', [TechnologieController::class, 'update'])->name('technologies.update');
            Route::delete('/technologies/{id}/delete', [TechnologieController::class, 'destroy'])->name('technologies.delete');
        Route::resource('technologies', TechnologieController::class);
    });
});
