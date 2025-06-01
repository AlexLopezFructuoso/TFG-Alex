<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureUserHasRole;

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

Route::middleware(['auth', EnsureUserHasRole::class . ':admin'])->group(function () {
    Route::get('/admin', function () {
        return 'Zona de administrador';
    });
});

Route::middleware(['auth', EnsureUserHasRole::class . ':invitado'])->group(function () {
    Route::get('/invitado', function () {
        return 'Zona de invitado';
    });
});

require __DIR__.'/auth.php';
