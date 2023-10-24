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
        Schema::table('posts', function (Blueprint $table) {
            // Đảm bảo cột user_id có kiểu dữ liệu phù hợp, ví dụ unsignedBigInteger
            $table->unsignedBigInteger('user_id')->index();
            // $table->foreign('user_id')->references('user_id')->on('users');

            $table->unsignedBigInteger('group_id')->index()->nullable();
            // $table->foreign('group_id')->references('group_id')->on('groups');

            $table->unsignedBigInteger('colored_pattern')->index()->nullable();
            // $table->foreign('colored_pattern')->references('pattern_id')->on('posts_colored_patterns');
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
