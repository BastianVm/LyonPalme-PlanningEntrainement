<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\LPPESeancesController;
use App\Models\LPPE_Seances;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    });
});

Route::get('/seances/periode', [LPPESeancesController::class, 'parPeriode'])->name('seances.parPeriode');
Route::get('/planning', [PlanningController::class, 'index'])->name('planning.index');
Route::resource('seances', LPPESeancesController::class);
Route::post('/seances/update/{id}', [LPPESeancesController::class, 'updateDirect'])->name('seances.updateDirect');

require __DIR__.'/auth.php';
