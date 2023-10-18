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
        Schema::table('posts_polls_options_users', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->index();
            // $table->foreign('user_id')->references('user_id')->on('users');

            $table->unsignedBigInteger('option_id')->index();
            // $table->foreign('option_id')->references('option_id')->on('posts_polls_options');

            $table->unsignedBigInteger('poll_id')->index();
            // $table->foreign('poll_id')->references('poll_id')->on('posts_polls');

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
