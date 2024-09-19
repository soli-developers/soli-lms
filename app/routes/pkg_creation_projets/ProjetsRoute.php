<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pkg_creation_projets\ProjetController;

// routes for project management
Route::middleware('auth')->group(function () {
    Route::prefix('/')->group(function () {
        Route::get('projets', [ProjetController::class, 'index'])->name('projets.index');
        Route::get('projets/create', [ProjetController::class, 'create'])->name('projets.create');
        Route::post('projets', [ProjetController::class, 'store'])->name('projets.store');
        Route::get('projets/{projet}', [ProjetController::class, 'show'])->name('projets.show');
        Route::get('projets/{projet}/edit', [ProjetController::class, 'edit'])->name('projets.edit');
        Route::put('projets/{projet}', [ProjetController::class, 'update'])->name('projets.update');
        Route::delete('projets/{projet}', [ProjetController::class, 'destroy'])->name('projets.destroy');

        Route::get('/export', [ProjetController::class, 'export'])->name('projets.export');
        Route::post('/import', [ProjetController::class, 'import'])->name('projets.import');
    });
});
