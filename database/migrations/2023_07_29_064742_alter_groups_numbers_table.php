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
        Schema::table('groups_members', function (Blueprint $table) {
            $table->unsignedBigInteger('group_id')->index();
            // $table->foreign('group_id')->references('group_id')->on('groups');
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
