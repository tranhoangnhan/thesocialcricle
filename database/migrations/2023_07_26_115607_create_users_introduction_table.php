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
        Schema::create('users_introduction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('location')->nullable();
            $table->text('hometown')->nullable();
            $table->text('marital')->nullable();
            $table->text('website')->nullable();
            $table->text('job')->nullable();
            $table->text('university')->nullable();
            $table->text('high_school')->nullable();
            $table->text('middle_school')->nullable();
            $table->text('primary_school')->nullable();
            $table->text('language')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_introduction');
    }
};
