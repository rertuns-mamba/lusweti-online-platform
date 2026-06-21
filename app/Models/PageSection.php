<?php

namespace App\Models;

use App\Concerns\Searchable;
use App\Events\PageSectionUpdated;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PageSection extends Model
{
    use Searchable;

    protected $guarded = ['id'];

    protected $fillable = [
        'page_id',
        'title',
        'component',
        'layout_type',
        'model_type',   // <-- Added for Dynamic Engine
        'category_id',  // <-- Added for Shared Taxonomy
        'limit',        // <-- Added for Data Control
        'settings',
        'sort_order',
        'is_active',
        'is_visible',
    ];

    protected $casts = [
        'settings' => 'array',
        'is_active' => 'boolean',
        'limit' => 'integer',
        'sort_order' => 'integer',
        'is_visible' => 'boolean',
    ];

    // ==========================================
    // 1. RELATIONSHIPS
    // ==========================================

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // ==========================================
    // 2. THE DYNAMIC QUERY ENGINE
    // ==========================================

    /**
     * Bootstraps a query builder instance based on the section's configuration.
     * This keeps your Livewire components completely agnostic of the data source.
     */
    public function getQuery(): Builder
    {
        $modelClass = $this->model_type && class_exists($this->model_type)
            ? $this->model_type
            : Article::class;

        $query = $modelClass::query();

        // If the model is an Article, let's use the scope you already built!
        if ($modelClass === Article::class) {
            // This applies your ->published() constraints and eagerness!
            $query->publishedStream($this->category_id ?? 0);
        } else {
            // Fallback logic for Videos or future models
            if ($this->category_id) {
                $query->where('category_id', $this->category_id);
            }
            $query->latest('published_at');
        }

        return $query;
    }

    public function componentExists(): bool
    {
        if (blank($this->component)) {
            return false;
        }

        $className = collect(explode('.', $this->component))
            ->map(fn ($segment) => Str::studly($segment))
            ->join('\\');

        return class_exists("App\\Livewire\\{$className}");
    }

    protected static function booted(): void
    {
        static::saved(function (PageSection $section) {
            try {
                if (! app()->runningInConsole()) {
                    broadcast(new PageSectionUpdated($section))->toOthers();
                }
            } catch (\Exception $e) {
                Log::error('Failed to broadcast page section update', [
                    'section_id' => $section->id,
                    'error' => $e->getMessage(),
                ]);
            }
        });

        static::deleted(function (PageSection $section) {
            try {
                if (! app()->runningInConsole()) {
                    broadcast(new PageSectionUpdated($section))->toOthers();
                }
            } catch (\Exception $e) {
                Log::error('Failed to broadcast page section deletion', [
                    'section_id' => $section->id,
                    'error' => $e->getMessage(),
                ]);
            }
        });
    }
}
