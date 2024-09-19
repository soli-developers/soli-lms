<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pkg_competences\CategorieTechnologieController;

Route::middleware('auth')->group(function () {
    Route::prefix('/CategorieTechnologie')->group(function () {
        Route::get('/', [CategorieTechnologieController::class, 'index'])->name('CategorieTechnologie.index');
        Route::get('/CategorieTechnologie/form-ajouter', [CategorieTechnologieController::class, 'create'])->name('CategorieTechnologie.create');
        Route::post('/CategorieTechnologie/ajouter', [CategorieTechnologieController::class, 'store'])->name('CategorieTechnologie.store');
        Route::get('/CategorieTechnologie/export', [CategorieTechnologieController::class, 'export'])->name('CategorieTechnologie.export');
        Route::post('/CategorieTechnologie/import', [CategorieTechnologieController::class, 'import'])->name('CategorieTechnologie.import');
        Route::get('/CategorieTechnologie/show/{id}', [CategorieTechnologieController::class, 'show'])->name('CategorieTechnologie.show');
        Route::get('/CategorieTechnologie/{id}/edit', [CategorieTechnologieController::class, 'edit'])->name('CategorieTechnologie.edit');
        Route::put('/CategorieTechnologie/{CategorieTechnologie}/update', [CategorieTechnologieController::class, 'update'])->name('CategorieTechnologie.update');
        Route::delete('/CategorieTechnologie/{id}/delete', [CategorieTechnologieController::class, 'destroy'])->name('CategorieTechnologie.delete');

        Route::resource('/CategorieTechnologie', CategorieTechnologieController::class);
    });
});
