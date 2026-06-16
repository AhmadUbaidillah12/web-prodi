<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\Admin\ProfileSettingsController;
use App\Http\Controllers\Admin\AcademicController;
use App\Http\Controllers\Admin\DocumentController;

// Public Routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/profil', [PublicController::class, 'profil'])->name('profil');
Route::get('/akademik', [PublicController::class, 'akademik'])->name('akademik');
Route::get('/blog', [PublicController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [PublicController::class, 'blogShow'])->name('blog.show');
Route::get('/kontak', [PublicController::class, 'kontak'])->name('kontak');

Route::redirect('/login', '/admin')->name('login');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('posts', PostController::class);
        Route::resource('categories', CategoryController::class)->except(['create', 'show', 'edit']);
        Route::resource('staff', StaffController::class);
        Route::resource('announcements', AnnouncementController::class);

        // CMS Expansion Routes
        Route::get('/statistics', [StatisticsController::class, 'index'])->name('statistics.index');
        Route::post('/statistics', [StatisticsController::class, 'update'])->name('statistics.update');

        Route::get('/profile-settings', [ProfileSettingsController::class, 'index'])->name('profile.settings');
        Route::post('/profile-settings', [ProfileSettingsController::class, 'update'])->name('profile.settings.update');

        Route::get('/academic', [AcademicController::class, 'index'])->name('academic.index');
        Route::post('/academic/kurikulum', [AcademicController::class, 'storeKurikulum'])->name('academic.kurikulum.store');
        Route::put('/academic/kurikulum/{id}', [AcademicController::class, 'updateKurikulum'])->name('academic.kurikulum.update');
        Route::delete('/academic/kurikulum/{id}', [AcademicController::class, 'destroyKurikulum'])->name('academic.kurikulum.destroy');
        
        Route::post('/academic/jadwal', [AcademicController::class, 'storeJadwal'])->name('academic.jadwal.store');
        Route::put('/academic/jadwal/{id}', [AcademicController::class, 'updateJadwal'])->name('academic.jadwal.update');
        Route::delete('/academic/jadwal/{id}', [AcademicController::class, 'destroyJadwal'])->name('academic.jadwal.destroy');

        Route::resource('documents', DocumentController::class);
    });
});

