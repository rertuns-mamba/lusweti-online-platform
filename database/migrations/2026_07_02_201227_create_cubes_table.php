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
        Schema::create('cubes', function (Blueprint $table) {
            $table->id();
            $table->string('front')->default('Front');
            $table->string('back')->default('Back');
            $table->string('right')->default('Right');
            $table->string('left')->default('Left');
            $table->string('top')->default('Top');
            $table->string('bottom')->default('Bottom');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cubes');
    }
};
