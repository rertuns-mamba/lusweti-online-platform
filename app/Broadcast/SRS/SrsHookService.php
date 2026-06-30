<?php

namespace App\Broadcast\SRS;

use App\Models\Stream;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * 🔥 ENGINEER STANDARD: SRS Hook Service
 * 
 * Handles SRS webhook callbacks for stream lifecycle events.
 * Integrates with the Stream model to maintain broadcast state.
 * Uses JWT-based token validation for security.
 */
class SrsHookService
{
    public function __construct(
        protected TokenService $tokenService
    ) {}

    /**
     * Handle the on_publish hook from SRS.
     * Return true to allow the stream, false to reject.
     */
    public function authorizePublish(Request $request): bool
    {
        $streamKey = $request->input('stream');
        $token = $request->input('param');

        Log::info("SRS Publish Attempt", [
            'stream_key' => $streamKey,
            'client_id' => $request->input('client_id'),
            'ip' => $request->input('ip'),
        ]);

        // Validate stream exists
        $stream = Stream::where('uuid', $streamKey)->first();

        if (!$stream) {
            Log::warning("SRS Publish Rejected: Stream not found", ['stream_key' => $streamKey]);
            return false;
        }

        // Validate JWT token
        if (!$token) {
            Log::warning("SRS Publish Rejected: No token provided", ['stream_key' => $streamKey]);
            return false;
        }

        $payload = $this->tokenService->validateToken($token);

        if (!$payload) {
            Log::warning("SRS Publish Rejected: Invalid token", ['stream_key' => $streamKey]);
            return false;
        }

        // Verify token matches stream key
        if (($payload['stream_key'] ?? null) !== $streamKey) {
            Log::warning("SRS Publish Rejected: Token mismatch", [
                'stream_key' => $streamKey,
                'token_stream_key' => $payload['stream_key'] ?? null,
            ]);
            return false;
        }

        // Check if token is expired
        if ($this->tokenService->isTokenExpired($token)) {
            Log::warning("SRS Publish Rejected: Token expired", ['stream_key' => $streamKey]);
            return false;
        }

        Log::info("SRS Publish Authorized", ['stream_key' => $streamKey]);
        return true;
    }

    /**
     * Handle the on_unpublish hook to know when a TV broadcast goes offline.
     */
    public function handleUnpublish(Request $request): void
    {
        $streamKey = $request->input('stream');
        
        Log::info("SRS Stream Offline", [
            'stream_key' => $streamKey,
            'client_id' => $request->input('client_id'),
        ]);

        $stream = Stream::where('uuid', $streamKey)->first();
        
        if ($stream) {
            $stream->update(['is_live' => false]);
            Log::info("Stream marked offline in database", ['stream_uuid' => $stream->uuid]);
        }
    }

    /**
     * Handle the on_publish hook when stream goes live.
     */
    public function handlePublish(Request $request): void
    {
        $streamKey = $request->input('stream');
        
        Log::info("SRS Stream Online", [
            'stream_key' => $streamKey,
            'client_id' => $request->input('client_id'),
        ]);

        $stream = Stream::where('uuid', $streamKey)->first();
        
        if ($stream) {
            $stream->update(['is_live' => true]);
            Log::info("Stream marked live in database", ['stream_uuid' => $stream->uuid]);
        }
    }
}