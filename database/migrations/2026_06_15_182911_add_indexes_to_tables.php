<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // 1. Safe way to add Unique Slug
        if (!Schema::hasColumn('categories', 'slug')) {
            // This is just a fallback, usually you already have the column
        } else {
            // Check if constraint exists to avoid the crash
            $exists = DB::select("SELECT 1 FROM pg_constraint WHERE conname = 'categories_slug_unique'");
            
            if (empty($exists)) {
                Schema::table('categories', function (Blueprint $table) {
                    $table->unique('slug');
                });
            }
        }

        // 2. Safe way to add Page Sections index
        Schema::table('page_sections', function (Blueprint $table) {
            // 'index()' automatically handles existence checks in most drivers, 
            // but if it fails, you can wrap it in a try-catch
            try {
                $table->index(['page_id', 'title']);
            } catch (\Exception $e) {
                // Index already exists, continue silently
            }
        });
    }

    public function down()
    {
        // Define how to roll back
    }
};