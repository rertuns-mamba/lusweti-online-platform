<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Concerns\Searchable;


class ExternalArticle extends Model implements HasMedia
{
    use InteractsWithMedia, Searchable;

    protected $fillable = ['category_id', 'title', 'slug', 'summary', 'external_url', 'is_visible', 'published_at'];

    protected $casts = [
        'published_at' => 'datetime',
        'is_visible' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // searchable as $searchable;
   

    // Accessors for Template Consistency
    public function getFeaturedImageUrlAttribute(): ?string
    {
        return $this->hasMedia('featured_image')
            ? $this->getFirstMediaUrl('featured_image', 'hero')
            : asset('images/placeholders/article-default.jpg');
    }

    public function getFeaturedImageThumbUrlAttribute(): ?string
    {
        return $this->hasMedia('featured_image')
            ? $this->getFirstMediaUrl('featured_image', 'thumb')
            : asset('images/placeholders/article-default.jpg');
    }
}
