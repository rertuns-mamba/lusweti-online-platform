<?php

namespace App\Concerns;

trait Searchable
{
    public function scopeSearch($query, $term)
    {
        return $query->where('title', 'LIKE', "%{$term}%")
                     ->orWhere('content', 'LIKE', "%{$term}%");
    }
}
