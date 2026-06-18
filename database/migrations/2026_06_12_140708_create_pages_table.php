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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->unique();

            $table->string('bg_color')->nullable();
            $table->string('text_color')->nullable();
            $table->boolean('is_active')->default(true);
            $table->boolean('show_in_nav')->default(false);

            $table->boolean('is_visible_in_nav')->default(true);
            $table->boolean('is_visible')->default(true);

            $table->integer('sort_order')->default(0);
            $table->integer('nav_order')->default(0);

            $table->enum('status', ['draft', 'published'])
                ->default('published');

            $table->timestamps();
        });


       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
