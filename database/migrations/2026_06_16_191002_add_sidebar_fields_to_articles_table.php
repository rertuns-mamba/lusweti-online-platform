<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            // Add these if they don't already exist
            if (!Schema::hasColumn('articles', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('is_visible');
            }
            if (!Schema::hasColumn('articles', 'external_url')) {
                $table->string('external_url')->nullable()->after('slug');
            }
            if (!Schema::hasColumn('articles', 'featured_image_thumb_url')) {
                $table->string('featured_image_thumb_url')->nullable()->after('external_url');
            }
        });
    }

    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'external_url', 'featured_image_thumb_url']);
        });
    }
};