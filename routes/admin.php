<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Paket Tour
    Route::resource('tours', Admin\TourController::class);

    // Destinasi
    Route::resource('destinations', Admin\DestinationController::class);

    // Testimoni
    Route::resource('testimonials', Admin\TestimonialController::class);
    Route::patch('testimonials/{testimonial}/approve', [Admin\TestimonialController::class, 'approve'])->name('testimonials.approve');

    // Booking
    Route::resource('bookings', Admin\BookingController::class);
    Route::patch('bookings/{booking}/confirm', [Admin\BookingController::class, 'confirm'])->name('bookings.confirm');
    Route::patch('bookings/{booking}/complete', [Admin\BookingController::class, 'complete'])->name('bookings.complete');
    Route::patch('bookings/{booking}/cancel', [Admin\BookingController::class, 'cancel'])->name('bookings.cancel');

    // Galeri Foto
    Route::resource('photos', Admin\PhotoController::class);

    // Laporan
    Route::get('reports', [Admin\ReportController::class, 'index'])->name('reports.index');

    // Pengaturan
    Route::get('settings', [Admin\SettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings', [Admin\SettingController::class, 'update'])->name('settings.update');
});