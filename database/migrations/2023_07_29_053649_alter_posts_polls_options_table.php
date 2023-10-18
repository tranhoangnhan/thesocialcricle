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
        Schema::table('posts_polls_options', function (Blueprint $table) {
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
