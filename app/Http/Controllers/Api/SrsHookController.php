<?php

namespace App\Http\Controllers\Api;

use App\Broadcast\SRS\SrsHookService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * 🔥 ENGINEER STANDARD: SRS Webhook Controller
 * 
 * Handles SRS webhook callbacks for stream lifecycle events.
 * These webhooks are triggered by SRS when streams are published/unpublished.
 */
class SrsHookController
{
    public function __construct(
        protected SrsHookService $hookService
    ) {}

    /**
     * Handle on_publish hook from SRS.
     * Called when a stream is about to be published.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function publish(Request $request): JsonResponse
    {
        $authorized = $this->hookService->authorizePublish($request);
        
        // SRS expects: 0 = allow, 1 = reject
        return response()->json([
            'code' => $authorized ? 0 : 1,
        ]);
    }

    /**
     * Handle on_unpublish hook from SRS.
     * Called when a stream goes offline.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function unpublish(Request $request): JsonResponse
    {
        $this->hookService->handleUnpublish($request);
        
        return response()->json([
            'code' => 0,
        ]);
    }

    /**
     * Handle on_publish (stream started) hook from SRS.
     * Called after a stream is successfully published.
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function published(Request $request): JsonResponse
    {
        $this->hookService->handlePublish($request);
        
        return response()->json([
            'code' => 0,
        ]);
    }
}
