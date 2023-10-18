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
        Schema::create('stories_media', function (Blueprint $table) {
            $table->bigIncrements('media_id');
            // $table->integer('story_id');
            $table->string('source');
            $table->enum('is_photo',['0','1'])->default('1');
            $table->text('text');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stories_media');
    }
};
