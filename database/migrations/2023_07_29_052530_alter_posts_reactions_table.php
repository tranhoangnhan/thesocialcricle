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
        Schema::table('posts_reactions', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id')->nullable()->index();
            // $table->foreign('post_id')->references('post_id')->on('posts');

            $table->unsignedBigInteger('comment_id')->index();
            // $table->foreign('comment_id')->references('comment_id')->on('posts_comments')->nullable();

            $table->unsignedBigInteger('user_id')->index();
            // $table->foreign('user_id')->references('user_id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
