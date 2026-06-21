<?php

namespace App\Models;

use App\Concerns\Searchable;
use App\Events\ArticlePublished;
use App\Jobs\ScrapeExternalArticleCover;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Article extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Searchable;

    protected $fillable = [
        'category_id',
        'page_id',
        'user_id',
        // 'tentacle_id',
        'topic_label',
        'title',
        'slug',
        'summary',
        'external_url',
        'content',
        'image_path',
        'layout_type',
        'layout_style',
        'is_featured_in_row',
        'is_prime',
        'display_style',
        'display_layout',
        'published_at',
        'is_visible',
        'is_youtube',
        'video_url',
        'is_active', // Added
        'external_url', // Added
        'featured_image_thumb_url', // Added
        'content_type', // <-- Added this to bridge the architectures perfectly
    ];

    // Always cast your booleans and dates!
    protected function casts(): array
    {
        return [
            'is_featured_in_row' => 'boolean',
            'is_prime' => 'boolean',
            'is_visible' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    // --- Events ---

    protected static function booted(): void
    {
        static::saved(function (Article $article) {
            try {
                if (! app()->runningInConsole()) {
                    broadcast(new ArticlePublished($article))->toOthers();
                }
                if ($article->external_url && $article->wasChanged('external_url') && ! app()->runningInConsole()) {
                    ScrapeExternalArticleCover::dispatchAfterResponse($article->id);
                }
            } catch (\Exception $e) {
                logger()->error('Failed to broadcast article update', [
                    'article_id' => $article->id,
                    'error' => $e->getMessage(),
                ]);
            }
        });

        static::deleted(function (Article $article) {
            try {
                if (! app()->runningInConsole()) {
                    broadcast(new ArticlePublished($article))->toOthers();
                }
            } catch (\Exception $e) {
                logger()->error('Failed to broadcast article deletion', [
                    'article_id' => $article->id,
                    'error' => $e->getMessage(),
                ]);
            }
        });
    }

    // --- Relations ---

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    // --- Scopes (Optimized to prevent N+1) ---

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('published_at', '<=', now())
            ->where('is_visible', true)
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }

    public function scopePublishedStream(Builder $query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId)
            ->published()
            ->with(['category', 'media']); // PREVENTS N+1 for Author/Category/Images
    }

    // app/Models/Article.php

    public function scopePublishedFeed(Builder $query, ?int $categoryId = null): Builder
    {
        // If a categoryId is provided, filter by it.
        // If null, we proceed without filtering (or return nothing if you prefer)
        return $query->when($categoryId, function ($q) use ($categoryId) {
            $q->where('category_id', $categoryId);
        })
            ->published()
            ->with(['category', 'media']);
    }

    // --- Media Accessors ---

    // This dynamically provides a thumbnail URL for the Blade view,
    // seamlessly mixing external RSS images with local Spatie uploads.
    protected function featuredImageThumbUrl(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (! empty($value)) {
                    return $value; // Return external URL from NewsAPI
                }

                // Fallback to local Spatie Media Library
                return $this->getFirstMediaUrl('featured_image') ?: null;
            }
        );
    }

    public function getFeaturedImageUrlAttribute(): ?string
    {
        if ($this->hasMedia('featured_image')) {
            // Try to get the hero conversion. If empty, fallback to the original image.
            $url = $this->getFirstMediaUrl('featured_image', 'hero');

            return ! empty($url) ? $url : $this->getFirstMediaUrl('featured_image');
        }

        return $this->image_path;
    }

    public function getFeaturedImageThumbUrlAttribute(): ?string
    {
        if ($this->hasMedia('featured_image')) {
            // Try to get the thumb conversion. If empty, fallback to the original image.
            $url = $this->getFirstMediaUrl('featured_image', 'thumb');

            return ! empty($url) ? $url : $this->getFirstMediaUrl('featured_image');
        }

        return $this->image_path;
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('featured_image')
            ->singleFile()
            ->useFallbackUrl(asset('images/placeholders/article-default.jpg'));

        $this->addMediaCollection('images')
            ->useFallbackUrl(asset('images/placeholders/article-default.jpg'));

        $this->addMediaCollection('videos')
            ->singleFile();
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
