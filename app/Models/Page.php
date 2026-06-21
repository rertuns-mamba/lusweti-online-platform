<?php

namespace App\Models;

use App\Concerns\Searchable;
use App\Events\PageUpdated;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

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

    protected function casts(): array
    {
        return [
            'is_visible_in_nav' => 'boolean',
            'sort_order' => 'integer',
        ];
    }

    public function sections()
    {
        return $this->hasMany(PageSection::class)
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    protected static function booted(): void
    {
        static::saved(function (Page $page) {
            try {
                if (! app()->runningInConsole()) {
                    broadcast(new PageUpdated($page))->toOthers();
                }
            } catch (\Exception $e) {
                Log::error('Failed to broadcast page update', [
                    'page_id' => $page->id,
                    'error' => $e->getMessage(),
                ]);
            }
        });

        static::deleted(function (Page $page) {
            try {
                if (! app()->runningInConsole()) {
                    broadcast(new PageUpdated($page))->toOthers();
                }
            } catch (\Exception $e) {
                Log::error('Failed to broadcast page deletion', [
                    'page_id' => $page->id,
                    'error' => $e->getMessage(),
                ]);
            }
        });
    }
}
