<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\HasMedia;

class ScrapeExternalArticleCover implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $modelClass;

    public int $recordId;

    public int $tries = 2;

    public int $timeout = 30;

    public function __construct(string $modelClass, int $recordId)
    {
        $this->modelClass = $modelClass;
        $this->recordId = $recordId;
    }

    public function handle(): void
    {
        if (! class_exists($this->modelClass)) {
            Log::warning('ScrapeExternalArticleCover model class does not exist: '.$this->modelClass);

            return;
        }

        $model = $this->modelClass::find($this->recordId);

        if (! $model instanceof HasMedia || ! filled($model->external_url)) {
            return;
        }

        try {
            $imageUrl = $this->extractOgImage($model->external_url);

            if (! $imageUrl) {
                Log::info('No OG image found for external URL: '.$model->external_url);

                return;
            }

            $resolvedUrl = $this->resolveImageUrl($imageUrl, $model->external_url);

            if (! filter_var($resolvedUrl, FILTER_VALIDATE_URL)) {
                Log::warning('Resolved OG image URL is invalid: '.$resolvedUrl);

                return;
            }

            $response = Http::timeout(30)->get($resolvedUrl);

            if (! $response->successful()) {
                Log::warning('Failed to download OG image for external URL: '.$resolvedUrl.' (status: '.$response->status().')');

                return;
            }

            if ($model->hasMedia('featured_image')) {
                $model->clearMediaCollection('featured_image');
            }

            $model->addMediaFromUrl($resolvedUrl)
                ->preservingOriginal()
                ->toMediaCollection('featured_image');

            Log::info('Attached scraped OG image for external URL: '.$model->external_url);
        } catch (\Exception $e) {
            Log::error('ScrapeExternalArticleCover failed for record '.$this->recordId.' ('.$this->modelClass.'): '.$e->getMessage());
        }
    }

    private function extractOgImage(string $url): ?string
    {
        try {
            $response = Http::timeout(15)->get($url);

            if (! $response->successful()) {
                return null;
            }

            return $this->extractOgImageFromHtml($response->body());
        } catch (\Exception $e) {
            Log::warning('Failed to extract OG image from '.$url.': '.$e->getMessage());

            return null;
        }
    }

    private function extractOgImageFromHtml(string $html): ?string
    {
        $patterns = [
            '/<meta[^>]+(?:property|name)\s*=\s*["\'](?:og:image|og:image:url|og:image:secure_url|twitter:image|twitter:image:src)["\'][^>]+content\s*=\s*["\']([^"\']+)["\'][^>]*>/i',
            '/<meta[^>]+content\s*=\s*["\']([^"\']+)["\'][^>]+(?:property|name)\s*=\s*["\'](?:og:image|og:image:url|og:image:secure_url|twitter:image|twitter:image:src)["\'][^>]*>/i',
            '/<link[^>]+rel\s*=\s*["\']image_src["\'][^>]+href\s*=\s*["\']([^"\']+)["\'][^>]*>/i',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $html, $matches)) {
                return trim($matches[1]);
            }
        }

        return null;
    }

    private function resolveImageUrl(string $imageUrl, string $baseUrl): string
    {
        $imageUrl = trim($imageUrl);

        if (str_starts_with($imageUrl, '//')) {
            $scheme = parse_url($baseUrl, PHP_URL_SCHEME) ?: 'https';

            return $scheme.':'.$imageUrl;
        }

        if (parse_url($imageUrl, PHP_URL_SCHEME) !== null) {
            return $imageUrl;
        }

        $parsedBase = parse_url($baseUrl);
        $scheme = $parsedBase['scheme'] ?? 'https';
        $host = $parsedBase['host'] ?? '';
        $port = isset($parsedBase['port']) ? ':'.$parsedBase['port'] : '';
        $basePath = $parsedBase['path'] ?? '/';

        if (str_starts_with($imageUrl, '/')) {
            return $scheme.'://'.$host.$port.$imageUrl;
        }

        $directory = rtrim(str_replace('\\', '/', dirname($basePath)), '/');

        if ($directory === '.' || $directory === '') {
            $directory = '';
        }

        return $scheme.'://'.$host.$port.$directory.'/'.ltrim($imageUrl, '/');
    }
}
