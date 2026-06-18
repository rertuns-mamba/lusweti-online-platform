<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Concerns\Searchable;

class Hadithi extends Model implements HasMedia
{
    use InteractsWithMedia, Searchable;

    protected $fillable = ['category_id', 'title', 'slug', 'summary', 'content', 'is_prime', 'is_visible', 'published_at'];

    protected $casts = [
        'published_at' => 'datetime',
        'is_prime' => 'boolean',
        'is_visible' => 'boolean',
    ];

    

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        // For Column 1 (Hero)
        $this->addMediaConversion('hero')
            ->width(800)
            ->height(450)
            // ->fit(Fit::crop, 800, 450)
            ->fit(Fit::Crop, 800, 450)
            ->sharpen(10);

        // For Column 2 (Thumbnails)
        $this->addMediaConversion('thumb')
            ->width(320)
            ->height(180)
            // ->fit(Fit::crop, 320, 180)
            ->fit(Fit::Crop, 320, 180);
    }
}
