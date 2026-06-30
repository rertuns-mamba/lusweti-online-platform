<?php

namespace App\Broadcast\SRS;

class HlsService
{
    protected string $hlsHost;

    public function __construct()
    {
        $this->hlsHost = config('srs.hls_url', 'http://localhost:8080');
    }

    /**
     * Generate the HLS playlist URL for the TV player.
     */
    public function getPlaybackUrl(string $streamKey): string
    {
        $app = 'live'; 
        return sprintf('%s/%s/%s.m3u8', $this->hlsHost, $app, $streamKey);
    }
}