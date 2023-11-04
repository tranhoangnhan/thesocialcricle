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
        Schema::create('course_material', function (Blueprint $table) {
            $table->bigIncrements('material_id');
            $table->string('material_name');
            $table->enum('material_type', ['lecture', 'reading', 'video', 'other']);
            $table->string('material_url');

            $table->string('slug')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('section_id');
            $table->string('view')->nullable();
           $table->enum('review',['0', '1']);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_material');
    }
};
