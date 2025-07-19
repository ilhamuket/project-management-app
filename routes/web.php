<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root route - redirect based on auth status
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

// Protected routes (require authentication)
Route::middleware('auth')->group(function () {
    
    // Dashboard Routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // AJAX Routes for Dashboard
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/chart-data', [DashboardController::class, 'getChartData'])->name('chart-data');
        Route::get('/running-projects', [DashboardController::class, 'getRunningProjects'])->name('running-projects');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

 

    Route::resource('projects', ProjectController::class);
    Route::get('projects-data', [ProjectController::class, 'getData'])->name('projects.data');

});

// Auth routes akan ditambahkan otomatis oleh Breeze
require __DIR__.'/auth.php';