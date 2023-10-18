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
        Schema::table('posts_photos', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id')->index();
            // $table->foreign('post_id')->references('post_id')->on('posts');

            $table->unsignedBigInteger('album_id')->index();
            // $table->foreign('album_id')->references('id')->on('albums');
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
