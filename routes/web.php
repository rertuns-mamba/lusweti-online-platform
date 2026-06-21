<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StreamController;
use App\Http\Controllers\VideoController;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\StreamRoom;
use App\Models\Page;
use Illuminate\Support\Facades\Route;

// Guest Authentication Pipeline
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');

    // Google API Transport Tunnel
    Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
    Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
});

/*
|--------------------------------------------------------------------------
| 2. PREVIEW SUB-SYSTEM
|--------------------------------------------------------------------------
*/
Route::prefix('preview')->group(function () {
    // Livewire Powered Preview Component
    // Route::get('/v2/{token}', PreviewPage::class)
    //     ->name('pages.preview.livewire');

    // Traditional View Token Lookup Fallback
    Route::get('/{token}', function (string $token) {
        $page = Page::where('preview_token', $token)->firstOrFail();

        return view('preview.page', compact('page'));
    })->name('pages.preview.static');
});
// Route::get('/streaming', HomePage::class)->name('home-page');
// Authenticated Verified Internal Stack
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/stream/{stream:uuid}', StreamRoom::class)->name('stream.show');
});

Route::get('/stream', [StreamController::class, 'index'])->name('stream');

// 1. Core Root Route for the Homepage
Route::get('/', function () {
    $page = Page::with(['sections' => function ($query) {
        $query->where('is_active', true)->orderBy('sort_order');
    }])->where('slug', 'home')->first();

    if (! $page) {
        return view('welcome');
    }

    return view('pages.home', compact('page'));
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::get('/search', [SearchController::class, 'index'])->name('search');

// Videos routes
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('/videos/{slug}', [VideoController::class, 'show'])->name('videos.show');

// Galleries routes
Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');
Route::get('/galleries/{slug}', [GalleryController::class, 'show'])->name('galleries.show');

// Article show route - BBC style article display
Route::get('/{pageSlug}/{articleSlug}', [ArticleController::class, 'show'])->name('article.show');

/*
|--------------------------------------------------------------------------
| 4. PROTECTED READER SYSTEM (Authenticated Users Only)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/account', function () {
        return view('account.dashboard');
    })->name('account.dashboard');

    // Future expansion example:
    // Route::get('/saved-articles', [ArticleController::class, 'saved'])->name('articles.saved');
});

// 2. Dynamic Route for all other pages (Must be placed AFTER the root route)
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show');

/*
|--------------------------------------------------------------------------
| 5. EXPLICIT SUBSCRIPTION & UTILITY ENDPOINTS
|--------------------------------------------------------------------------
*/
// Route::get('/subscribe/premium', PremiumSubscribePage::class)
//     ->name('subscriptions.index');

require __DIR__.'/settings.php';
