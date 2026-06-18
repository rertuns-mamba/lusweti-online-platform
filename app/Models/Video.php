<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Builder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Concerns\Searchable;


class Video extends Model implements HasMedia
{
    use InteractsWithMedia, Searchable;

    protected $fillable = [
        'category_id', // MUST be category_id to share with Articles
        'title',
        'slug',
        'is_youtube',
        'youtube_id',
        'video_url',
        'is_visible',
        'published_at',
    ];

    // Merge your casts into one method
    protected function casts(): array
    {
        return [
            'is_youtube' => 'boolean',
            'is_visible' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    // ARCHITECTURE FIX: Use the global Category model
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class); 
    }

    

    // ARCHITECTURE FIX: Update scope to use generic category_id
    public function scopePublishedFeed(Builder $query, int $categoryId): Builder
    {
        return $query->where('category_id', $categoryId) // Corrected from video_category_id
            ->where('is_visible', true)
            ->where('published_at', '<=', now())
            ->with(['category', 'media']) 
            ->orderByDesc('published_at')
            ->orderByDesc('id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('local_video')
             ->singleFile()
             ->acceptsMimeTypes(['video/mp4', 'video/webm']);

        $this->addMediaCollection('custom_thumbnail')
             ->singleFile()
             ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }


    // 2. Your method signature MUST look exactly like this
    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
             ->width(800)
             ->height(450)
             ->extractVideoFrameAtSecond(2)
             ->performOnCollections('local_video');
    }
}