<?php

use App\Http\Controllers\RecordingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

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
