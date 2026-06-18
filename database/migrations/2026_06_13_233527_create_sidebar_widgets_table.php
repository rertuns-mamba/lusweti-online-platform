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
        Schema::create('sidebar_widgets', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('type'); // 'links', 'images', 'related_stories', 'video'
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('cascade');
            $table->json('content_data'); // Stores URLs, Embed Codes, or IDs
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sidebar_widgets');
    }
};
