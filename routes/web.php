<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProjetController;
use App\Http\Controllers\DomaineController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\SiteConfigController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/domaines', [DomaineController::class, 'index'])->name('domaines.index');
Route::get('/domaines/{slug}', [DomaineController::class, 'show'])->name('domaines.show');

Route::get('/realisations', [ProjetController::class, 'index'])->name('projets.index');
Route::get('/realisations/{slug}', [ProjetController::class, 'show'])->name('projets.show');

Route::get('/actualites', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/actualites/{slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/agenda', [EventController::class, 'index'])->name('events.index');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');

Route::view('/confidentialite', 'pages.confidentialite')->name('legal.privacy');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:5,1')->name('contact.store');

Route::get('/don', [HomeController::class, 'don'])->name('don');
Route::post('/don', [DonController::class, 'store'])->middleware('throttle:5,1')->name('don.store');
Route::post('/csp-report', function (Request $request) {
    $payload = $request->all();
    if (empty($payload)) {
        $payload = json_decode($request->getContent(), true) ?? ['raw' => $request->getContent()];
    }
    Log::warning('CSP violation report', ['report' => $payload]);
    return response()->noContent();
})->name('csp.report');

// Auth Routes (Member Space)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes (Protected by role)
Route::middleware(['auth', 'role:admin,superadmin,editeur'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // Resource controllers
    Route::resource('articles', \App\Http\Controllers\Admin\ArticleController::class);
    Route::resource('projets', \App\Http\Controllers\Admin\ProjetController::class);
    Route::resource('events', \App\Http\Controllers\Admin\EventController::class);
    Route::resource('dons', \App\Http\Controllers\Admin\DonController::class);
    Route::resource('contacts', \App\Http\Controllers\Admin\ContactController::class);
    Route::get('settings', [SiteConfigController::class, 'edit'])->name('settings.edit');
    Route::patch('settings', [SiteConfigController::class, 'update'])->name('settings.update');
});

require __DIR__.'/auth.php';
