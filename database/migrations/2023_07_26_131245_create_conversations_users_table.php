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
        Schema::create('conversations_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->integer('conversations_id');
            // $table->integer('user_id');
            $table->enum('seen',['0','1'])->default('0');
            $table->enum('typing',['0','1'])->default('0');
            $table->enum('deleted',['0','1'])->default('0');
            $table->integer('role')->nullable();
            $table->integer('kick')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations_users');
    }
};
