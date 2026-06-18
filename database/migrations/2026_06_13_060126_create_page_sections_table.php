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
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();

            // 1. RELATIONSHIP (Crucial for Page Builder)
            $table->foreignId('page_id')->constrained()->cascadeOnDelete();

            // 2. IDENTITY
            $table->string('title')->nullable(); // Optional section title for admin reference
            $table->string('component')->nullable(); // E.g., 'sections.three-column'

            // 3. DYNAMIC CONFIGURATION (Shared Taxonomy & Logic)
            $table->foreignId('category_id')->nullable()->constrained(); // Link to Taxonomy
            $table->string('model_type')->nullable(); // Stores: 'App\Models\Article', 'App\Models\Video', etc.
            $table->integer('limit')->default(3);

            // 4. HOUSEKEEPING
            $table->integer('sort_order')->default(0);
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->boolean('is_visible')->default(true);
            $table->json('settings')->nullable(); // For edge-case overrides

            $table->timestamps();

            // Index for performance
            $table->index(['page_id', 'sort_order']);
        });


        // 3. Page Sections (The Structural Bridge)
        // Schema::create('page_sections', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('page_id')->constrained()->cascadeOnDelete();
            
        //     $table->string('component'); // e.g., 'spoti-kenya', 'bbc-grid', 'hero-slider'
        //     $table->integer('order')->default(0);
        //     $table->boolean('is_visible')->default(true);
            
        //     // Dynamic parameters (stores category_id, article limits, layout styles)
        //     $table->json('settings')->nullable(); 
            
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
