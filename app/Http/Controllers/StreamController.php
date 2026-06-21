<?php

namespace App\Http\Controllers;

use App\Models\Stream;
use App\Services\LiveKitService;
use Illuminate\Support\Facades\Auth;

class StreamController extends Controller
{
    public function index(LiveKitService $liveKitService)
    {
        // Get the first active stream or create a placeholder
        $stream = Stream::where('is_live', true)->first() ?? new Stream([
            'uuid' => 'placeholder',
            'title' => 'No Active Stream',
            'is_live' => false,
        ]);

        // Generate LiveKit token
        $tokenData = $liveKitService->generateToken(
            Auth::user(),
            $stream->uuid,
            true // isHost
        );

        return view('pages.stream', [
            'token' => $tokenData['token'],
            'livekitUrl' => $tokenData['url'],
            'isHost' => true, // Set to true for testing control buttons
            'stream' => $stream,
        ]);
    }
}
