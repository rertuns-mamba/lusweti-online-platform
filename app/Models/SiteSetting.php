<?php

namespace App\Models;

use App\Concerns\Searchable;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    use Searchable;

    protected $fillable = ['tagline', 'display_date'];

    protected $casts = [
        'display_date' => 'date',
    ];

    // Singleton helper: fetches settings, caches them, or creates if missing
    public static function current(): self
    {
        return self::firstOrCreate(['id' => 1]);
    }
}
