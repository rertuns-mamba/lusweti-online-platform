<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('breaking_news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('original_title')->nullable();
            $table->string('ai_title')->nullable();
            $table->string('url');
            
            // Status flags
            $table->boolean('is_active')->default(false)->index();
            $table->boolean('is_live')->default(false);
            $table->boolean('is_urgent')->default(false);
            
            // Metrics & Sorting
            $table->integer('priority')->default(0)->index();
            $table->unsignedInteger('views')->default(0);
            $table->unsignedInteger('clicks')->default(0);
            $table->decimal('ai_score', 8, 2)->default(0);
            
            $table->timestamp('expires_at')->nullable()->index();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('breaking_news');
    }
};