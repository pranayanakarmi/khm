<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Public;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [Public\HomeController::class, 'index'])->name('home');
Route::get('/about', [Public\AboutController::class, 'index'])->name('about');
Route::get('/programs', [Public\ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{program:slug}', [Public\ProgramController::class, 'show'])->name('programs.show');
Route::get('/notices', [Public\NoticeController::class, 'index'])->name('notices.index');
Route::get('/notices/{notice:slug}', [Public\NoticeController::class, 'show'])->name('notices.show');
Route::get('/events', [Public\EventController::class, 'index'])->name('events.index');
Route::get('/events/{event:slug}', [Public\EventController::class, 'show'])->name('events.show');
Route::get('/downloads', [Public\DownloadController::class, 'index'])->name('downloads.index');
Route::get('/downloads/{download}/get', [Public\DownloadController::class, 'download'])->name('downloads.get');
Route::get('/faqs', [Public\FaqController::class, 'index'])->name('faqs.index');
Route::get('/contact', [Public\ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [Public\ContactController::class, 'store'])->name('contact.store');

// Auth routes
Route::get('/admin/login', [Admin\AuthController::class, 'showLogin'])->name('admin.login')->middleware('guest');
Route::post('/admin/login', [Admin\AuthController::class, 'login'])->name('admin.login.post')->middleware('guest');
Route::post('/admin/logout', [Admin\AuthController::class, 'logout'])->name('admin.logout')->middleware('auth');

// Admin routes - protected
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('banners', Admin\BannerController::class);
    Route::resource('programs', Admin\ProgramController::class);
    Route::resource('notices', Admin\NoticeController::class);
    Route::resource('events', Admin\EventController::class);
    Route::resource('downloads', Admin\DownloadController::class);
    Route::resource('faqs', Admin\FaqController::class);
    Route::resource('pages', Admin\PageController::class);
    Route::resource('users', Admin\UserController::class);
    Route::get('contacts', [Admin\ContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [Admin\ContactController::class, 'show'])->name('contacts.show');
    Route::delete('contacts/{contact}', [Admin\ContactController::class, 'destroy'])->name('contacts.destroy');
});
