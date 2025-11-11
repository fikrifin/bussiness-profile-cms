<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\HeroSectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\CompanyProfileController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\LandingPageController;
Route::get('/', LandingPageController::class)->name('landing');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/refresh', function () {
        \Illuminate\Support\Facades\Cache::forget('dashboard.stats');
        \Illuminate\Support\Facades\Cache::forget('dashboard.activity');
        return redirect()->route('admin.dashboard');
    })->name('dashboard.refresh');
    Route::resource('hero-sections', HeroSectionController::class)->only(['index','store','update']);
    Route::resource('services', ServiceController::class)->only(['index','store','update','destroy']);
    Route::resource('testimonials', TestimonialController::class)->only(['index','store','update','destroy']);
    Route::resource('company-profile', CompanyProfileController::class)->only(['index','store']);
    Route::resource('contact-info', ContactInfoController::class)->only(['index','store']);
    Route::resource('settings', SettingController::class)->only(['index','store']);
});
