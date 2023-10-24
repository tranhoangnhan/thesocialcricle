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
        Schema::create('course', function (Blueprint $table) {
            $table->bigIncrements('course_id');
            $table->bigInteger('category_id');
            $table->enum('payment',['0','1'])->default('0');
            $table->string('course_name',255);
            $table->string('slug',255);
            $table->string('required_skill',255);
            $table->string('learn_skill',255);
            $table->text('description');
            $table->enum('status',['0','1'])->default('0');
            $table->string('banner');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course');
    }
};
