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
        Schema::create('quiz_result', function (Blueprint $table) {
            $table->id('result_id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('quiz_id');
            $table->text('question_content');
            $table->integer('score-percent');
            $table->string('mark', 10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_result');
    }
};
