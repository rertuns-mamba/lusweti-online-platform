<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Concerns\Searchable;

class GlobalPageFooter extends Model 
{
    use Searchable;
    protected $fillable = [
        'brand_name', 'brand_description', 'sections_title', 
        'information_title', 'copyright_text', 'meta_links'
    ];

    protected function casts(): array
    {
        return [
            'meta_links' => 'array',
        ];
    }

    
}