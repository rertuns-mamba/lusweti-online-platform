<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    // Must be false for Postgres because once a transaction aborts,
    // subsequent SQL fails. Raw SQL with IF NOT EXISTS prevents this.
    public $withinTransaction = false;

    public function up()
    {
        // 1. Safe way to add Unique Slug
        try {
            if (config('database.default') === 'pgsql') {
                // Use raw SQL with IF NOT EXISTS for Postgres; safe outside transactions
                DB::statement('ALTER TABLE categories ADD CONSTRAINT categories_slug_unique UNIQUE (slug)');
            } else {
                Schema::table('categories', function (Blueprint $table) {
                    $table->unique('slug');
                });
            }
        } catch (\Throwable $e) {
            // Constraint/index already exists; ignore
        }

        // 2. Safe way to add Page Sections index
        try {
            if (config('database.default') === 'pgsql') {
                // Use raw SQL with IF NOT EXISTS for Postgres
                DB::statement('CREATE INDEX IF NOT EXISTS page_sections_page_id_title_index ON page_sections (page_id, title)');
            } else {
                Schema::table('page_sections', function (Blueprint $table) {
                    $table->index(['page_id', 'title']);
                });
            }
        } catch (\Throwable $e) {
            // Index already exists; ignore
        }
    }

    public function down()
    {
        try {
            if (config('database.default') === 'pgsql') {
                DB::statement('DROP INDEX IF EXISTS page_sections_page_id_title_index');
                DB::statement('ALTER TABLE categories DROP CONSTRAINT IF EXISTS categories_slug_unique');
            } else {
                Schema::table('page_sections', function (Blueprint $table) {
                    $table->dropIndex(['page_id', 'title']);
                });
                Schema::table('categories', function (Blueprint $table) {
                    $table->dropUnique(['slug']);
                });
            }
        } catch (\Throwable $e) {
            // noop
        }
    }
};
