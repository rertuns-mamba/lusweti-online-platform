<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Enums\Fit;
use App\Concerns\Searchable;

class Gallery extends Model implements HasMedia
{
    use InteractsWithMedia, Searchable;

    protected $fillable = ['category_id', 'title', 'slug', 'is_visible', 'published_at'];

    protected function casts(): array {
        return ['is_visible' => 'boolean', 'published_at' => 'datetime'];
    }

    protected static function booted(): void
    {
        static::saving(function (Gallery $gallery) {
            if (empty($gallery->slug) && !empty($gallery->title)) {
                $gallery->slug = Str::slug($gallery->title);
                $originalSlug = $gallery->slug;
                $counter = 1;

                while (Gallery::where('slug', $gallery->slug)->where('id', '!=', $gallery->id)->exists()) {
                    $gallery->slug = $originalSlug . '-' . $counter++;
                }
            }
        });
    }


    
    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('gallery_cover')
             ->singleFile()
             ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

   


    public function registerMediaConversions(Media $media = null): void
    {
        // 2. Use Fit::Crop instead of 'crop'
        $this->addMediaConversion('grid-thumb')
             ->fit(Fit::Crop, 800, 500)
             ->sharpen(5);
    }
}