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
        Schema::table('conversations_message', function (Blueprint $table) {
            $table->unsignedBigInteger('conversations_id')->index();
            // $table->foreign('conversations_id')->references('conversations_id')->on('conversations');

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
