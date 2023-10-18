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
        Schema::create('posts_comments', function (Blueprint $table) {
            $table->bigIncrements('comment_id');
            // $table->integer('node_id');
            $table->enum('node_type',['post','photo','comment']);
            // $table->integer('user_id');
            $table->enum('user_type',['user','page']);
            $table->longtext('text');
            $table->string('image')->nullable();
            $table->unsignedInteger('reaction_like_count')->default('0');
            $table->unsignedInteger('reaction_love_count')->default('0');
            $table->unsignedInteger('reaction_haha_count')->default('0');
            $table->unsignedInteger('reaction_yay_count')->default('0');
            $table->unsignedInteger('reaction_wow_count')->default('0');
            $table->unsignedInteger('reaction_sad_count')->default('0');
            $table->unsignedInteger('reaction_angry_count')->default('0');
            $table->unsignedInteger('replies')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_comments');
    }
};
