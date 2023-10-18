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
        Schema::create('posts_colored_patterns', function (Blueprint $table) {
            $table->bigIncrements('pattern_id');

            $table->enum('type',['color','image'])->default('color');
            $table->string('background_image')->nullable();
            $table->string('background_color_1', 32)->nullable();
            $table->string('background_color_2', 32)->nullable();
            $table->string('text_color', 32)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_colored_patterns');
    }
};
