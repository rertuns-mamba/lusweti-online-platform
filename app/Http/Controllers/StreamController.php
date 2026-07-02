<?php

namespace App\Http\Controllers;

use App\Models\Stream;
use App\Services\LiveKitService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StreamController extends Controller
{
    public function index(LiveKitService $liveKitService)
    {
        $user = Auth::user();
        $isHost = $user && $user->hasRole('Super Admin');

        if ($isHost) {
            // Find or create the admin's stream
            $stream = Stream::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'uuid' => (string) Str::uuid(),
                    'title' => $user->name . "'s Live Stream",
                    'is_live' => false,
                ]
            );
        } else {
            // For passive users, look for whatever stream is currently live
            $stream = Stream::where('is_live', true)->first() ?? new Stream([
                'uuid' => 'placeholder',
                'title' => 'No Active Stream',
                'is_live' => false,
            ]);
        }

        // Generate LiveKit token
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

    public function end($uuid)
    {
        $stream = Stream::where('uuid', $uuid)->first();
        if ($stream) {
            $stream->update(['is_live' => false]);
        }
        return response()->json(['success' => true]);
    }

    public function start($uuid)
    {
        $stream = Stream::where('uuid', $uuid)->first();
        if ($stream) {
            $stream->update(['is_live' => true]);
        }
        return response()->json(['success' => true]);
    }
}

// namespace App\Http\Controllers;

// use App\Models\Stream;
// use App\Services\LiveKitService;
// use Illuminate\Support\Facades\Auth;

// class StreamController extends Controller
// {
//     public function index(LiveKitService $liveKitService)
//     {
//         // Get the first active stream or create a placeholder
//         $stream = Stream::where('is_live', true)->first() ?? new Stream([
//             'uuid' => 'placeholder',
//             'title' => 'No Active Stream',
//             'is_live' => false,
//         ]);

//         // Check if user is authenticated and should be host
//         $user = Auth::user();
//         $isHost = $user && $user->hasRole('Super Admin');

//         // Generate LiveKit token (pass null for guests)
//         $tokenData = $liveKitService->generateToken(
//             $user,
//             $stream->uuid,
//             $isHost
//         );

//         return view('pages.stream', [
//             'token' => $tokenData['token'],
//             'livekitUrl' => $tokenData['url'],
//             'isHost' => $isHost,
//             'stream' => $stream,
//         ]);
//     }
// }
