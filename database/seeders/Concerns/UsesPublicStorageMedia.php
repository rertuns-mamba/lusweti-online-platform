<?php

namespace Database\Seeders\Concerns;

use App\Models\Article;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use SplFileInfo;
use Throwable;

trait UsesPublicStorageMedia
{
    /**
     * @return Collection<int, string>
     */
    protected function publicStorageImages(): Collection
    {
        return $this->publicStorageFiles('images', ['jpg', 'jpeg', 'png', 'webp']);
    }

    /**
     * @return Collection<int, string>
     */
    protected function publicStorageVideos(): Collection
    {
        return $this->publicStorageFiles('videos', ['mp4', 'webm', 'mov']);
    }

    /**
     * @param  array<int, string>  $extensions
     * @return Collection<int, string>
     */
    protected function publicStorageFiles(string $directory, array $extensions): Collection
    {
        $path = public_path("storage/{$directory}");

        if (! File::isDirectory($path)) {
            return collect();
        }

        return collect(File::files($path))
            ->filter(fn (SplFileInfo $file): bool => in_array(Str::lower($file->getExtension()), $extensions, true))
            ->map(fn (SplFileInfo $file): string => $file->getPathname())
            ->values();
    }

    protected function attachFeaturedImage(Article $article, ?string $path): void
    {
        if (! $path || ! File::exists($path)) {
            return;
        }

        try {
            if (! $article->hasMedia('featured_image')) {
                $article
                    ->addMedia($path)
                    ->preservingOriginal()
                    ->toMediaCollection('featured_image');
            }
        } catch (Throwable) {
            // Fall back to the public URL if the media library cannot attach the file.
        }

        $imageUrl = $article->getFirstMediaUrl('featured_image', 'thumb')
            ?: $article->getFirstMediaUrl('featured_image')
            ?: $this->publicStorageUrl($path);

        $article->forceFill([
            'featured_image_thumb_url' => $imageUrl,
            'image_path' => $imageUrl,
        ])->save();
    }

    protected function attachLocalVideo(Article $article, ?string $path, ?string $posterPath = null): void
    {
        if (! $path || ! File::exists($path)) {
            return;
        }

        try {
            if (! $article->hasMedia('videos')) {
                $article
                    ->addMedia($path)
                    ->preservingOriginal()
                    ->toMediaCollection('videos');
            }
        } catch (Throwable) {
            // Fall back to the public URL if the media library cannot attach the file.
        }

        $videoUrl = $article->getFirstMediaUrl('videos') ?: $this->publicStorageUrl($path);

        $article->forceFill([
            'is_youtube' => false,
            'video_url' => $videoUrl,
        ])->save();

        $this->attachFeaturedImage($article, $posterPath);
    }

    protected function publicStorageUrl(string $path): string
    {
        $relativePath = Str::of($path)
            ->replace('\\', '/')
            ->after(Str::of(public_path())->replace('\\', '/').'/')
            ->toString();

        return asset($relativePath);
    }

    /**
     * @return array<int, array{url: string, image: string, title: string}>
     */
    protected function externalStories(): array
    {
        return [
            [
                'title' => 'Kenya athletes headline a global weekend of sport',
                'url' => 'https://www.bbc.com/sport',
                'image' => 'https://ichef.bbci.co.uk/images/ic/1024x576/p0j2k6g8.jpg',
            ],
            [
                'title' => 'Transfer market notebook from the touchline',
                'url' => 'https://www.espn.com/soccer/',
                'image' => 'https://a.espncdn.com/photo/2024/0614/r1345997_1296x729_16-9.jpg',
            ],
            [
                'title' => 'Business leaders watch the next wave of sports media',
                'url' => 'https://www.reuters.com/business/media-telecom/',
                'image' => 'https://www.reuters.com/resizer/v2/RLYYLP4Z4BIWBFZXGH4PV6SV2I.jpg',
            ],
        ];
    }

    /**
     * @return array<int, array{id: string, title: string}>
     */
    protected function youtubeStories(): array
    {
        return [
            ['id' => 'jNQXAC9IVRw', 'title' => 'Classic YouTube field report'],
            ['id' => 'dQw4w9WgXcQ', 'title' => 'Stadium crowd singalong highlight'],
            ['id' => 'kJQP7kiw5Fk', 'title' => 'Global football culture moment'],
        ];
    }

    protected function youtubeWatchUrl(string $youtubeId): string
    {
        return "https://www.youtube.com/watch?v={$youtubeId}";
    }

    protected function youtubeThumbnailUrl(string $youtubeId): string
    {
        return "https://i.ytimg.com/vi/{$youtubeId}/maxresdefault.jpg";
    }
}
