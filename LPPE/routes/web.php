<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\LPPESeancesController;
use App\Http\Controllers\LPPEEntrainementController;
use App\Http\Controllers\LPPEIndisponibilitesController;
use App\Models\LPPE_Seances;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/indisponibilites', [LPPEIndisponibilitesController::class, 'adminIndex'])->name('admin.indisponibilites.index');
    Route::put('/admin/indisponibilites/{id}', [LPPEIndisponibilitesController::class, 'adminUpdate'])->name('admin.indisponibilites.update');
});

Route::get('/indisponibilites/create', [LPPEIndisponibilitesController::class, 'create'])->name('indisponibilites.create');
Route::post('/indisponibilites', [LPPEIndisponibilitesController::class, 'store'])->name('indisponibilites.store');
// Affichage de la liste : accessible à tous (ou tous les connectés)
Route::get('/entrainements', [LPPEEntrainementController::class, 'index'])->name('entrainements.index');

// Création : accessible seulement aux admins
Route::middleware(['auth'])->group(function () {
    Route::get('/entrainements/create', [LPPEEntrainementController::class, 'create'])->name('entrainements.create');
    Route::post('/entrainements', [LPPEEntrainementController::class, 'store'])->name('entrainements.store');
});

Route::get('/seances/periode', [LPPESeancesController::class, 'parPeriode'])->name('seances.parPeriode');
Route::get('/planning', [PlanningController::class, 'index'])->name('planning.index');
Route::resource('seances', LPPESeancesController::class);
Route::post('/seances/update/{id}', [LPPESeancesController::class, 'updateDirect'])->name('seances.updateDirect');

require __DIR__.'/auth.php';
