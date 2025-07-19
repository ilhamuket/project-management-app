<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\DashboardController;



Route::get('/', function () {
    return view('welcome');
});

Route::resource('projects', ProjectController::class);
Route::get('projects-data', [ProjectController::class, 'getData'])->name('projects.data');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// AJAX Routes for Dashboard
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/chart-data', [DashboardController::class, 'getChartData'])->name('chart-data');
    Route::get('/running-projects', [DashboardController::class, 'getRunningProjects'])->name('running-projects');
});