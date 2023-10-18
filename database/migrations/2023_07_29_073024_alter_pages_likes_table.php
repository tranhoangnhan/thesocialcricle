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
        Schema::table('page_likes', function (Blueprint $table) {
            $table->unsignedBigInteger('page_id')->default('0')->index();
            // $table->foreign('page_id')->references('page_id')->on('pages');

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
