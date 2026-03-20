<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\MessageController;

// ─── Frontend ────────────────────────────────────────────────────────────────
Route::get('/',        [HomeController::class, 'index'])->name('home');
Route::get('/about',   [HomeController::class, 'about'])->name('about');
Route::get('/services',[HomeController::class, 'services'])->name('services');
Route::get('/services/{slug}', [HomeController::class, 'serviceDetail'])->name('services.show');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact',[HomeController::class, 'contactSubmit'])->name('contact.submit');

// Track & Trace
Route::get('/track-shipment',  [TrackingController::class, 'index'])->name('track');
Route::post('/track-shipment', [TrackingController::class, 'track'])->name('track.search');
Route::get('/track', fn () => redirect()->route('track'))->name('track.legacy');

// ─── Admin Auth ───────────────────────────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('admin.login');
    })->name('index');

    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

    // ─── Protected Admin ─────────────────────────────────────────────────────
    Route::middleware('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Profile
        Route::get('/profile',  [AuthController::class, 'profile'])->name('profile');
        Route::put('/profile',  [AuthController::class, 'updateProfile'])->name('profile.update');

        // Shipments
        Route::resource('shipments', ShipmentController::class);
        Route::post('/shipments/{shipment}/events',          [ShipmentController::class, 'storeEvent'])->name('shipments.events.store');
        Route::delete('/shipments/{shipment}/events/{event}',[ShipmentController::class, 'destroyEvent'])->name('shipments.events.destroy');

        // Services
        Route::resource('services', ServiceController::class)->except(['show']);

        // Testimonials
        Route::resource('testimonials', TestimonialController::class)->except(['show']);

        // Team
        Route::resource('team', TeamMemberController::class)->except(['show']);

        // Messages
        Route::get('/messages',        [MessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}',   [MessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{message}',[MessageController::class, 'destroy'])->name('messages.destroy');

        // Settings
        Route::get('/settings',  [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    });
});
