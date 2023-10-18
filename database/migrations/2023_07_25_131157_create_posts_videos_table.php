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
        Schema::create('posts_videos', function (Blueprint $table) {
            $table->bigIncrements('video_id');
            // $table->integer('post_id');
            $table->string('source');
            $table->string('thumnail');
            $table->integer('views')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_videos');
    }
};
