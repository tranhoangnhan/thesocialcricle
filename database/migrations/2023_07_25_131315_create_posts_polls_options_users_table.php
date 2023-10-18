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
        Schema::create('posts_polls_options_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            // $table->integer('user_id');
            // $table->integer('option_id');
            // $table->integer('poll_id');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_photos_polls_options_users');
    }
};
