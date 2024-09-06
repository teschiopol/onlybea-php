<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CompanyController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect('/dashboard');
    /*
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
    */
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('applications', ApplicationController::class)
    ->only(['index', 'store', 'update'])
    ->middleware(['auth', 'verified']);

Route::resource('companies', CompanyController::class)
    ->only(['index', 'store', 'update'])
    ->middleware(['auth', 'verified']);

Route::get('/jobs', function () {
    return Inertia::render('Jobs');
})->middleware(['auth', 'verified'])->name('jobs');

require __DIR__.'/auth.php';
