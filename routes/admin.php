<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ConfigController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\PlaceController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('admin.pages.login');
});

Route::get('/register', function () {
    redirect('/login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.pages.dashboard');
        })->name('home');

        // Categories
        Route::get('/categories', [CategoryController::class, 'index'])->name('admin.categories');
        Route::get('/categories/create', [CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::post('/categories/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');

        // Places
        Route::get('/places', [PlaceController::class, 'index'])->name('admin.places');
        Route::get('/places/create', [PlaceController::class, 'create'])->name('admin.places.create');
        Route::post('/places', [PlaceController::class, 'store'])->name('admin.places.store');
        Route::get('/places/{place}/edit', [PlaceController::class, 'edit'])->name('admin.places.edit');
        Route::put('/places/{place}', [PlaceController::class, 'update'])->name('admin.places.update');
        Route::delete('/places/{place}', [PlaceController::class, 'destroy'])->name('admin.places.destroy');

        // Services
        Route::get('/services', [ServiceController::class, 'index'])->name('admin.services');
        Route::get('/services/create', [ServiceController::class, 'create'])->name('admin.services.create');
        Route::post('/services', [ServiceController::class, 'store'])->name('admin.services.store');
        Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
        Route::put('/services/{service}', [ServiceController::class, 'update'])->name('admin.services.update');
        Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');

        // Configs
        Route::get('/configs', [ConfigController::class, 'index'])->name('admin.configs');
        Route::get('/configs/create', [ConfigController::class, 'create'])->name('admin.configs.create');
        Route::post('/configs', [ConfigController::class, 'store'])->name('admin.configs.store');
        Route::get('/configs/{config}/edit', [ConfigController::class, 'edit'])->name('admin.configs.edit');
        Route::post('/configs/{config}', [ConfigController::class, 'update'])->name('admin.configs.update');
        Route::delete('/configs/{config}', [ConfigController::class, 'destroy'])->name('admin.configs.destroy');

        // Inquiries
        Route::get('/inquiries', [InquiryController::class, 'index'])->name('admin.inquiries');
        Route::get('/inquiries/create', [InquiryController::class, 'create'])->name('admin.inquiries.create');
        Route::post('/inquiries', [InquiryController::class, 'store'])->name('admin.inquiries.store');
        Route::get('/inquiries/{inquiry}/edit', [InquiryController::class, 'edit'])->name('admin.inquiries.edit');
        Route::post('/inquiries/{inquiry}', [InquiryController::class, 'update'])->name('admin.inquiries.update');
        Route::delete('/inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('admin.inquiries.destroy');

        // Testimonials
        Route::get('/testimonials', [TestimonialController::class, 'index'])->name('admin.testimonials');
        Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('admin.testimonials.create');
        Route::post('/testimonials', [TestimonialController::class, 'store'])->name('admin.testimonials.store');
        Route::get('/testimonials/{testimonial}/edit', [TestimonialController::class, 'edit'])->name('admin.testimonials.edit');
        Route::post('/testimonials/{testimonial}', [TestimonialController::class, 'update'])->name('admin.testimonials.update');
        Route::delete('/testimonials/{testimonial}', [TestimonialController::class, 'destroy'])->name('admin.testimonials.destroy');
    });
});
