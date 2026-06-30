<?php

namespace App\Broadcast\SRS;

class SrsService
{
    public function __construct(
        public ApiService $api,
        public RtmpService $rtmp,
        public HlsService $hls,
        public SrsHookService $hooks
    ) {}

    /**
     * Quick helper to get full connection details for a specific channel
     */
    public function getChannelConnectionDetails(string $streamKey, string $token): array
    {
        return [
            'ingest_url' => $this->rtmp->getEgressPushUrl($streamKey, $token),
            'playback_url' => $this->hls->getPlaybackUrl($streamKey),
        ];
    }
}