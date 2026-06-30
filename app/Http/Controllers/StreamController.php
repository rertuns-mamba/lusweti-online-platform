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

        // Check if user is authenticated and should be host
        $user = Auth::user();
        $isHost = $user && $user->is_admin ?? false;

        // Generate LiveKit token (pass null for guests)
        $tokenData = $liveKitService->generateToken(
            $user,
            $stream->uuid,
            $isHost
        );

        return view('pages.stream', [
            'token' => $tokenData['token'],
            'livekitUrl' => $tokenData['url'],
            'isHost' => $isHost,
            'stream' => $stream,
        ]);
    }
}
