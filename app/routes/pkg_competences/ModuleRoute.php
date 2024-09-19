<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\pkg_competences\ModuleController;
use App\Models\pkg_competences\Module;

// routes for Module management
Route::middleware('auth')->group(function () {
    $namespace = 'App\Http\Controllers\pkg_competences';
    Route::namespace($namespace)->group(function () {
        Route::prefix('Module')->group(function () {
            Route::get('/', [ModuleController::class, 'index'])->name('Module.index');
            Route::get('/Module/form-ajouter', [ModuleController::class, 'create'])->name('Module.create');
            Route::post('/Module/ajouter', [ModuleController::class, 'store'])->name('Module.store');
            Route::get('/Module/export', [ModuleController::class, 'export'])->name('Module.export');
        Route::post('/Module/import', [ModuleController::class, 'import'])->name('Module.import');
            Route::get('/Module/show/{id}', [ModuleController::class, 'show'])->name('Module.show');
            Route::get('/Module/{id}/edit', [ModuleController::class, 'edit'])->name('Module.edit');
            Route::put('/Module/{id}/update', [ModuleController::class, 'update'])->name('Module.update');
            Route::delete('/Module/{id}/delete', [ModuleController::class, 'destroy'])->name('Module.delete');

        });
    });
});
