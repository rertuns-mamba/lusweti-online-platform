<?php

namespace App\Models;

use App\Events\BreakingNewsUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Concerns\Searchable;

 

class BreakingNews extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Searchable;

    protected $fillable = [
        'title',
        'original_title',
        'ai_title',
        'url',
        'is_active',
        'is_live',
        'is_urgent',
        'expires_at',
        'priority',
        'views',
        'clicks',
        'ai_score',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_live' => 'boolean',
        'is_urgent' => 'boolean',
        'expires_at' => 'datetime',
        'ai_score' => 'float',
        'views' => 'integer',
        'clicks' => 'integer',
        'priority' => 'integer',
    ];




    

    /**
     * Scope a query to only include active and unexpired news.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('expires_at')
                  ->orWhere('expires_at', '>', now());
            });
    }

    /**
     * Get the display title, preferring the AI generated one if available.
     */
    public function getDisplayTitleAttribute(): string
    {
        return $this->ai_title ?: $this->title;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->useFallbackUrl(asset('images/placeholders/breaking-news-default.jpg'));
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(400)
            ->height(225)
            ->sharpen(10)
            ->nonQueued();

        $this->addMediaConversion('hero')
            ->width(1200)
            ->height(675)
            ->withResponsiveImages();
    }

    public function updateScore(): void
    {
        $this->ai_score = 
            ($this->views * 0.3) + 
            ($this->clicks * 0.6) + 
            ($this->is_urgent ? 100 : 0) + 
            (now()->diffInMinutes($this->created_at) < 10 ? 50 : 0);

        $this->saveQuietly();
    }

    protected static function booted(): void
    {
        // Broadcast updates via Pusher/WebSockets when changed
        $broadcastUpdate = function () {
            try {
                event(new BreakingNewsUpdated());
            } catch (\Exception $e) {
                report($e);
            }
        };

        static::created($broadcastUpdate);
        static::updated($broadcastUpdate);
        static::deleted($broadcastUpdate);

        static::created(function (BreakingNews $item) {
            dispatch(function () use ($item) {
                try {
                    $item->updateQuietly([
                        'original_title' => $item->title,
                        // 'ai_title' => app(HeadlineAiService::class)->rewrite($item->title),
                    ]);
                } catch (\Exception $e) {
                    report($e);
                }
            })->delay(now()->addSeconds(1));
        });
    }
}