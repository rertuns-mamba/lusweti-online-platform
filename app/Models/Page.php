<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Concerns\Searchable;

class Page extends Model 
{

    use Searchable;

protected $guarded = ['id'];
    protected $fillable = [
        'title',
        'slug',
        'bg_color',
        'text_color',
        'is_visible_in_nav',
        'sort_order',
        'status',
    ];

    public function sections()
    {
        return $this->hasMany(PageSection::class)
            ->where('is_active', true)
            ->orderBy('sort_order');
    }


    
}
