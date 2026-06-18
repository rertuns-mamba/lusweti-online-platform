<?php

use Illuminate\Support\Facades\Route;
use App\Models\Page;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\GoogleController;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ForgotPassword;
use App\Http\Controllers\SearchController;


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

// Authenticated Verified Internal Stack
Route::middleware(['auth', 'verified'])->group(function () {
    // Route::get('/home', function () {
    //     return view('pages.home'); // Main portal home dashboard layout
    // })->name('home');
});


// 1. Core Root Route for the Homepage
Route::get('/', function () {
    $page = Page::with(['sections' => function($query) {
        $query->where('is_active', true)->orderBy('sort_order');
    }])->where('slug', 'home')->firstOrFail();

    return view('pages.home', compact('page')); 
})->name('home'); // <- CRITICAL: Name this route 'home'



Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::get('/search', [SearchController::class, 'index'])->name('search');


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




require __DIR__ . '/settings.php';
