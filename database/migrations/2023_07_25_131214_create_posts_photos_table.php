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
        Schema::create('posts_photos', function (Blueprint $table) {
            $table->bigIncrements('photo_id');
            $table->string('source');
            $table->unsignedInteger('reaction_like_count')->default('0');
            $table->unsignedInteger('reaction_love_count')->default('0');
            $table->unsignedInteger('reaction_haha_count')->default('0');
            $table->unsignedInteger('reaction_yay_count')->default('0');
            $table->unsignedInteger('reaction_wow_count')->default('0');
            $table->unsignedInteger('reaction_sad_count')->default('0');
            $table->unsignedInteger('reaction_angry_count')->default('0');
            $table->unsignedInteger('comments')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_photos');
    }
};
