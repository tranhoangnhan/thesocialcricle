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
        Schema::create('users_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip', 100)->nullable();
            $table->string('country', 100)->nullable();
            $table->string('country_code', 100)->nullable();
            $table->string('city', 100)->nullable();
            $table->string('timezone', 150)->nullable();
            $table->string('location', 60)->nullable();
            $table->string('latitude', 60)->nullable();
            $table->string('longitude', 60)->nullable();
            $table->string('browser', 60)->nullable();
            $table->string('os', 60)->nullable();
            $table->string('proxy', 60)->nullable();
            $table->unsignedBigInteger('user_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_log');
    }
};
