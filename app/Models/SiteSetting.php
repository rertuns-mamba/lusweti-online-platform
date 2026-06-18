<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use App\Concerns\Searchable;

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
        return Cache::rememberForever('site_settings', function () {
            return self::firstOrCreate(['id' => 1]);
        });
    }


 

    // Clear cache when saved
    protected static function booted()
    {
        static::saved(fn() => Cache::forget('site_settings'));
    }
}