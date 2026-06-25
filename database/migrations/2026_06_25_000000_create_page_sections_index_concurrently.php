<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    // Must run outside transactions for Postgres CONCURRENTLY
    public $withinTransaction = false;

    public function up()
    {
        try {
            if (config('database.default') === 'pgsql') {
                DB::statement('CREATE INDEX CONCURRENTLY IF NOT EXISTS page_sections_page_id_title_index ON page_sections (page_id, title)');
            }
        } catch (\Throwable $e) {
            // ignore
        }
    }

    public function down()
    {
        try {
            if (config('database.default') === 'pgsql') {
                DB::statement('DROP INDEX IF EXISTS page_sections_page_id_title_index');
            }
        } catch (\Throwable $e) {
            // ignore
        }
    }
};
