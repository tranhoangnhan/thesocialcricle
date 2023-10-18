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
        Schema::table('enrollment', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->index();
            // $table->foreign('user_id')->references('user_id')->on('users');

            $table->unsignedBigInteger('course_id')->index();
            // $table->foreign('course_id')->references('course_id')->on('course');

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
