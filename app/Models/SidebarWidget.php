<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Concerns\Searchable;

class SidebarWidget extends Model implements HasMedia
{
    use InteractsWithMedia, Searchable; // Enables the relationship
    
    protected $fillable = ['title', 'type', 'category_id', 'content_data', 'order', 'is_active'];

    protected $casts = [
        'content_data' => 'array',
        'is_active' => 'boolean',
    ];

    // Clean Query: Standardizing lookup by Category
    public function scopeForCategory($query, $categoryId)
    {
        return $query->where('is_active', true)
                     ->where(function($q) use ($categoryId) {
                         $q->where('category_id', $categoryId)
                           ->orWhereNull('category_id'); // Global widgets
                     })
                     ->orderBy('order');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    
}