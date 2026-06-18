<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();

            // 1. Structural Relationships (Foreign Keys)
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('page_id')->nullable()->constrained()->nullOnDelete();

            // 2. Core Content & Routing
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('topic_label')->nullable(); // e.g., "LIVE", "BREAKING"
            $table->text('summary')->nullable();
            $table->text('content')->nullable(); // PostgreSQL optimizes text fields natively

            // 3. Media & External Routing Asset Bridges
            $table->string('image_path')->nullable(); // Fallback/static asset path
            $table->string('external_url')->nullable(); // For off-site syndication links
            $table->string('content_type')->default('article'); // article, video, gallery
            $table->string('layout_type')->default('hero'); // article, video

            // 4. Encapsulated Layout & Design Control
            // Instead of 4 separate string columns bloating the table, we use a single 
            // json column for frontend card overrides (e.g., dark mode, text alignment)
            $table->json('layout_options')->nullable();

            // 5. Query Flags & Content States
            $table->boolean('is_prime')->default(false);
            $table->boolean('is_featured_in_row')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->boolean('is_active')->default(true);

            // 6. Timestamps & Engine Optimizations
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // 7. Performance Indexes for Heavy Read Traffic
            // Speeds up front-page dynamic queries combining visibility and date sorting
            $table->index(['is_visible', 'published_at']);
            $table->index('content_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
