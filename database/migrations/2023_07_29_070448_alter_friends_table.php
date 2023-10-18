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
        Schema::table('friends', function (Blueprint $table) {
            $table->unsignedBigInteger('user_one_id')->index();
            // $table->foreign('user_one_id')->references('user_id')->on('users');

            $table->unsignedBigInteger('user_two_id')->index();
            // $table->foreign('user_two_id')->references('user_id')->on('users');
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
