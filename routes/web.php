<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\Web\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('web.home');
Route::get('/about-us', [PageController::class, 'about'])->name('web.about');
Route::get('/packages', [PageController::class, 'packages'])->name('web.packages');
Route::get('/tour-&-reviews', [PageController::class, 'tour'])->name('web.tour');
Route::get('/contact-us', [PageController::class, 'contact'])->name('web.contact');

Route::post('/inquiry', [PageController::class, 'contactStore'])->name('web.contact.store');

// Project routes
Route::prefix('project')->name('projects.')->group(function () {
    // Main project routes
    Route::get('/', [ProjectController::class, 'index'])->name('index');
    Route::get('/{project}', [ProjectController::class, 'show'])->name('show');
    Route::put('/{project}', [ProjectController::class, 'update'])->name('update');

    // Task management
    Route::put('/{project}/tasks/{task}', [ProjectController::class, 'updateTask'])->name('tasks.update');
    Route::patch('/tasks/{task}/status', [ProjectController::class, 'updateTaskStatus'])->name('tasks.status');

    // Data export routes
    Route::get('/{project}/export/json', [ProjectController::class, 'exportJson'])->name('export.json');
    Route::get('/{project}/export/csv', [ProjectController::class, 'exportCsv'])->name('export.csv');

    // Dashboard and analytics
    Route::get('/{project}/dashboard', [ProjectController::class, 'dashboard'])->name('dashboard');
    Route::get('/{project}/overdue', [ProjectController::class, 'getOverdueTasks'])->name('overdue');
});

// API routes for AJAX calls
Route::prefix('api/projects')->name('api.projects.')->group(function () {
    Route::patch('/tasks/{task}/status', [ProjectController::class, 'updateTaskStatus'])->name('tasks.status');
    Route::get('/{project}/dashboard', [ProjectController::class, 'dashboard'])->name('dashboard');
    Route::get('/{project}/overdue', [ProjectController::class, 'getOverdueTasks'])->name('overdue');
});
