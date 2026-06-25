<?php

namespace App\Models;

use App\Concerns\Searchable;
use App\Jobs\ScrapeExternalArticleCover;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ExternalArticle extends Model implements HasMedia
{
    use InteractsWithMedia, Searchable;

    protected $fillable = ['category_id', 'title', 'slug', 'summary', 'external_url', 'is_visible', 'published_at'];

    protected $casts = [
        'published_at' => 'datetime',
        'is_visible' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saved(function (ExternalArticle $article) {
            if ($article->external_url && $article->wasChanged('external_url')) {
                ScrapeExternalArticleCover::dispatchSync(self::class, $article->id);
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // searchable as $searchable;

    // Accessors for Template Consistency
    public function getFeaturedImageUrlAttribute(): ?string
    {
        if ($this->hasMedia('featured_image')) {
            $url = $this->getFirstMediaUrl('featured_image', 'hero');

            return ! empty($url) ? $url : $this->getFirstMediaUrl('featured_image');
        }

        return asset('images/placeholders/article-default.jpg');
    }

    public function getFeaturedImageThumbUrlAttribute(): ?string
    {
        if ($this->hasMedia('featured_image')) {
            $url = $this->getFirstMediaUrl('featured_image', 'thumb');

            return ! empty($url) ? $url : $this->getFirstMediaUrl('featured_image');
        }

        return asset('images/placeholders/article-default.jpg');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->useFallbackUrl(asset('images/placeholders/article-default.jpg'));
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
            ->withResponsiveImages()
            ->nonQueued();
    }
}
