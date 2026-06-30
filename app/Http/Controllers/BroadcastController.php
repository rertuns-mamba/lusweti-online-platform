<?php

namespace App\Http\Controllers;

use App\Broadcast\BroadcastService;
use App\Models\Stream;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * 🔥 ENGINEER STANDARD: Broadcast Controller
 * 
 * Manages broadcast operations using the unified BroadcastService.
 * Demonstrates the dual-streaming architecture (LiveKit + SRS).
 */
class BroadcastController extends Controller
{
    public function __construct(
        protected BroadcastService $broadcastService
    ) {}

    /**
     * Start a broadcast for a stream.
     * 
     * @param Stream $stream
     * @return JsonResponse
     */
    public function start(Stream $stream): JsonResponse
    {
        $this->authorize('update', $stream);

        if ($stream->is_live) {
            return response()->json([
                'message' => 'Stream is already live',
                'stream' => $stream,
            ], 400);
        }

        try {
            $credentials = $this->broadcastService->startBroadcast($stream, auth()->user());

            return response()->json([
                'message' => 'Broadcast started successfully',
                'credentials' => $credentials,
                'stream' => $stream->fresh(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to start broadcast',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Stop a broadcast.
     * 
     * @param Stream $stream
     * @return JsonResponse
     */
    public function stop(Stream $stream): JsonResponse
    {
        $this->authorize('update', $stream);

        if (!$stream->is_live) {
            return response()->json([
                'message' => 'Stream is not currently live',
            ], 400);
        }

        try {
            $success = $this->broadcastService->stopBroadcast($stream);

            return response()->json([
                'message' => $success ? 'Broadcast stopped successfully' : 'Broadcast stopped with warnings',
                'stream' => $stream->fresh(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to stop broadcast',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get viewer credentials for passive HLS playback.
     * 
     * @param Stream $stream
     * @return JsonResponse
     */
    public function viewerCredentials(Stream $stream): JsonResponse
    {
        $credentials = $this->broadcastService->getViewerCredentials($stream);

        return response()->json([
            'credentials' => $credentials,
        ]);
    }

    /**
     * Get participant credentials for interactive LiveKit session.
     * 
     * @param Stream $stream
     * @param Request $request
     * @return JsonResponse
     */
    public function participantCredentials(Stream $stream, Request $request): JsonResponse
    {
        $canPublish = $request->boolean('can_publish', false);

        $credentials = $this->broadcastService->getParticipantCredentials(
            $stream,
            auth()->user(),
            $canPublish
        );

        return response()->json([
            'credentials' => $credentials,
        ]);
    }

    /**
     * Get broadcast status for a stream.
     * 
     * @param Stream $stream
     * @return JsonResponse
     */
    public function status(Stream $stream): JsonResponse
    {
        $status = $this->broadcastService->getBroadcastStatus($stream);

        return response()->json([
            'status' => $status,
        ]);
    }
}
