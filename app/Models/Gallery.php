<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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