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
            // $table->integer('course_id');
            $table->string('material_name');
            $table->enum('material_type',['lecture', 'reading', 'video', 'other']);
            $table->string('material_url');
            $table->bigIncrements('user_id')->nullable();
            $table->bigIncrements('course_id');
            $table->bigIncrements('section_id');
            $table->string('view');
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
