<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Concerns\Searchable;


class Category extends Model 
{
    use Searchable;
    // Pro tip: Guarding ID is cleaner than filling arrays
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ];
    }


   

    /**
     * Relationship: One category has many page sections pulling from it.
     */
    public function pageSections(): HasMany
    {
        return $this->hasMany(PageSection::class);
    }


    /**
     * Get the articles associated with the category.
     */
    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Optional: If you want to use /news/categories/sports instead of IDs in routes
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
