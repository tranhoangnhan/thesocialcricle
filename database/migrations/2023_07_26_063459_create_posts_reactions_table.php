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
        Schema::create('posts_reactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->integer('post_id')->nullable();
            // $table->integer('comment_id')->nullable();
            // $table->integer('user_id');
            $table->string('reaction',32)->nullable()->default('like');
            $table->timestamp('reaction_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_reactions');
    }
};
