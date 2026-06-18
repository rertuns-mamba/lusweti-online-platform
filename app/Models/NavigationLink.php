<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class NavigationLink extends Model implements Sortable
{
    use SortableTrait;

    protected $fillable = ['label', 'url', 'order', 'is_active', 'is_external'];

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];
}
