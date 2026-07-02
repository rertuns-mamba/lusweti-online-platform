<?php

namespace App\Http\Controllers;

use App\Broadcast\BroadcastService;
use App\Broadcast\SRS\SrsService;
use App\Models\Stream;
use App\Services\LiveKitService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;


class StreamController extends Controller
{
    public function index(LiveKitService $liveKitService, SrsService $srsService)
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

        $srsPlaybackUrl = null;
        if ($stream->uuid && $stream->uuid !== 'placeholder') {
            $srsPlaybackUrl = $srsService->hls->getPlaybackUrl($stream->uuid);
        }

        return view('pages.stream', [
            'token' => $tokenData['token'],
            'livekitUrl' => $tokenData['url'],
            'isHost' => $isHost,
            'stream' => $stream,
            'srsPlaybackUrl' => $srsPlaybackUrl,
        ]);
    }

    public function end($uuid, BroadcastService $broadcastService)
    {
        $stream = Stream::where('uuid', $uuid)->first();
        if ($stream) {
            $stream->forceFill(['is_live' => false])->save();
            $broadcastService->stopBroadcast($stream, true);
            Log::info('Stream ended - UUID: ' . $uuid . ', is_live: false');
        }

        return response()->json(['success' => true]);
    }

    public function start($uuid, BroadcastService $broadcastService)
    {
        $stream = Stream::where('uuid', $uuid)->first();
        if ($stream) {
            $stream->forceFill(['is_live' => true])->save();
            $broadcastService->startBroadcast($stream, Auth::user(), true);
            Log::info('Stream started - UUID: ' . $uuid . ', is_live: true');
        }

        return response()->json(['success' => true]);
    }
}

