<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecordingController;
use App\Http\Controllers\Api\SrsHookController;
use App\Http\Controllers\BroadcastController;
use App\Models\Stream;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// SRS Webhook endpoints (no auth required, validated by SRS)
Route::prefix('srs/hooks')->group(function () {
    Route::post('/publish', [SrsHookController::class, 'publish']);
    Route::post('/unpublish', [SrsHookController::class, 'unpublish']);
    Route::post('/published', [SrsHookController::class, 'published']);
});

// Broadcast endpoints (protected by Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/broadcast/{stream}/start', [BroadcastController::class, 'start']);
    Route::post('/broadcast/{stream}/stop', [BroadcastController::class, 'stop']);
    Route::get('/broadcast/{stream}/status', [BroadcastController::class, 'status']);
    Route::get('/broadcast/{stream}/viewer-credentials', [BroadcastController::class, 'viewerCredentials']);
    Route::get('/broadcast/{stream}/participant-credentials', [BroadcastController::class, 'participantCredentials']);
});

// Unprotected by Sanctum, protected by Signature
Route::post('/upload-chunk/{sessionId}/{participantId}', [RecordingController::class, 'uploadChunk'])
    ->name('chunk.upload')
    ->middleware('signed');

// Protect the rest with Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/finalize-recording', [RecordingController::class, 'finalize']);
    Route::post('/merge-session/{sessionId}', [RecordingController::class, 'mergeSession']);
    Route::post('/remove-silence/{sessionId}', [RecordingController::class, 'removeSilence']);
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');





// use App\Http\Controllers\RecordingController;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;

// /*
// |--------------------------------------------------------------------------
// | API Routes
// |--------------------------------------------------------------------------
// */

// // Unprotected by Sanctum, protected by Signature
// Route::post('/upload-chunk/{sessionId}/{participantId}', [RecordingController::class, 'uploadChunk'])
//     ->name('chunk.upload')
//     ->middleware('signed');

// // Protect the rest with Sanctum
// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/finalize-recording', [RecordingController::class, 'finalize']);
//     Route::post('/merge-session/{sessionId}', [RecordingController::class, 'mergeSession']);
//     Route::post('/remove-silence/{sessionId}', [RecordingController::class, 'removeSilence']);
// });

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
