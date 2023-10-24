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
            $table->string('course_name',255);
            $table->integer('category_id',255);
            $table->string('payment',255);
            $table->text('require_skill');
            $table->text('learn_skill');
            $table->text('description');
            $table->enum('status',['0','1'])->default('0');
            
            $table->string('banner');
            $table->string('slug');
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
