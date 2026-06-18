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
        Schema::create('global_page_footers', function (Blueprint $table) {
            $table->id();
            $table->string('brand_name');
            $table->text('brand_description');
            $table->string('sections_title')->default('Explore');
            $table->string('information_title')->default('Information');
            $table->string('copyright_text');
            $table->json('meta_links')->nullable(); // Array of {title, url, open_in_new_tab}
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('global_page_footers');
    }
};
