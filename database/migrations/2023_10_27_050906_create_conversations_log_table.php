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
        Schema::create('conversations_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('conversations_id')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->string('event_type');
            $table->text('event_data');
            $table->timestamp('time')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations_log');
    }
};
