<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('admin.pages.login');
});

Route::get('/register', function () {
    redirect('/login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.pages.dashboard');
    })->name('home');
});
