<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            
            // Video Source Data
            $table->boolean('is_youtube')->default(true);
            $table->string('youtube_id')->nullable(); // e.g., 'dQw4w9WgXcQ'
            $table->string('video_url')->nullable();  // For direct MP4 links
            
            $table->boolean('is_active')->default(false);            
            $table->boolean('is_visible')->default(true);            
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            
            $table->index(['category_id', 'is_visible', 'published_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
