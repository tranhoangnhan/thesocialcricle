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
            // $table->bigInteger('user_id');
            $table->text('position')->nullable();
            $table->text('workplace')->nullable();
            $table->timestamps();
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
