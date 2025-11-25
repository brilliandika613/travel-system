<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin;


// Halaman utama
Route::get('/', [HomeController::class, 'index'])->name('home');
// Auth
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Tour
use App\Http\Controllers\TourController;
Route::get('/paket-tour', [TourController::class, 'index'])->name('tours.index');
Route::get('/paket-tour/{tour:slug}', [TourController::class, 'show'])->name('tours.show');
Route::get('/paket-tour/{type}', [TourController::class, 'showByType'])->name('tours.byType');

// Booking (hanya untuk user login)
Route::middleware('auth')->group(function () {
    Route::get('/booking/create/{tour:slug}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{booking}/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');
    Route::post('/booking/{booking}/upload-proof', [BookingController::class, 'uploadProof'])->name('booking.upload-proof');
    Route::get('/booking/{booking}/status', [BookingController::class, 'status'])->name('booking.status');
    Route::get('/riwayat', [BookingController::class, 'history'])->name('booking.history');});

// Testimoni publik (bisa diakses tanpa login)
Route::get('/testimoni/create/{tour:slug}', [TestimonialController::class, 'create'])->name('testimonials.create');
Route::get('/testimoni', [TestimonialController::class, 'publicIndex'])->name('testimonials.index');

// Destinasi (publik)
Route::get('/destinasi', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinasi/{destination:slug}', [DestinationController::class, 'show'])->name('destinations.show');

// Kontak
Route::get('/kontak', [ContactController::class, 'show'])->name('contact.show');
Route::post('/kontak', [ContactController::class, 'send'])->name('contact.send');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Paket Tour
    Route::controller(Admin\TourController::class)->group(function () {
        Route::get('/tours','index')->name('admin.tours.index');
        Route::get('/tours-create','create')->name('admin.tours.create');
        Route::get('/tours-store','store')->name('admin.tours.store');
    });

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