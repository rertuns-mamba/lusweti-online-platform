<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StreamController;
use App\Http\Controllers\VideoController;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\ProfileEdit;
use App\Livewire\StreamRoom;
use App\Livewire\Subscription;
use App\Models\Page;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
// 1. IMPORT ALL YOUR CLASSES HERE
// use App\Livewire\Auth\Settings\ProfileSettings; 
// use App\Livewire\Auth\Settings\TwoFactorRecoveryCodes;
// use App\Livewire\Auth\Settings\Appearance;
// use App\Livewire\Auth\Settings\DeleteUserModal;
// use App\Http\Controllers\SecurityController;
// use App\Http\Controllers\Settings\SecurityController;
/*
|--------------------------------------------------------------------------
| AUTHENTICATION ROUTES (Guest Only)
|--------------------------------------------------------------------------
| Users who are not authenticated can access these routes
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');

// Google OAuth
    Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle']);
    Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
});




/*
|--------------------------------------------------------------------------
| PUBLIC CONTENT (Guest Access)
|--------------------------------------------------------------------------
| Passive viewers can access all content without authentication
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', function () {
    return redirect()->route('page.show', 'general-sports');
})->name('home');

// Subscription page
Route::get('/subscribe', Subscription::class)->name('subscribe');

// Explicit routes to prevent conflicts with dynamic routes
Route::get('/stream', [StreamController::class, 'index'])->name('stream');
Route::post('/stream/{uuid}/end', [StreamController::class, 'end'])->name('stream.end');
Route::post('/stream/{uuid}/start', [StreamController::class, 'start'])->name('stream.start');

// Public content - accessible to guests
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/videos', [VideoController::class, 'index'])->name('videos.index');
Route::get('/videos/{slug}', [VideoController::class, 'show'])->name('videos.show');
Route::get('/galleries', [GalleryController::class, 'index'])->name('galleries.index');
Route::get('/galleries/{slug}', [GalleryController::class, 'show'])->name('galleries.show');

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (Authenticated Users)
|--------------------------------------------------------------------------
| Admin and authenticated users can access these features
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // User account
    Route::get('/account', function () {
        return view('account.dashboard');
    })->name('account.dashboard');
    
    // Profile edit
    Route::get('/account/profile', [ProfileController::class, 'edit'])->name('account.profile');
    
    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});

// Profile redirect (outside auth middleware to work)
Route::redirect('/profile', '/account/profile');

// Dynamic routes must come after explicit routes
Route::get('/{pageSlug}/{articleSlug}', [ArticleController::class, 'show'])->name('article.show');
Route::get('/{slug}', [PageController::class, 'show'])->name('page.show');

/*
|--------------------------------------------------------------------------
| VERIFIED ROUTES (Email Verified Users)
|--------------------------------------------------------------------------
| Additional protection for sensitive operations
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/stream/{stream:uuid}', StreamRoom::class)->name('stream.show');
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

/*
|--------------------------------------------------------------------------
| PREVIEW SUB-SYSTEM
|--------------------------------------------------------------------------
*/
Route::prefix('preview')->group(function () {
    Route::get('/{token}', function (string $token) {
        $page = Page::where('preview_token', $token)->firstOrFail();
        return view('preview.page', compact('page'));
    })->name('pages.preview.static');
});

require __DIR__.'/settings.php';
