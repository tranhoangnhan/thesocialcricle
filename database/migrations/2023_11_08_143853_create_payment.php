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
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('vnp_TxnRef');
            $table->string('vnp_OrderInfo');
            $table->bigInteger('vnp_Amount');
            $table->string('vnp_ResponseCode');
            $table->bigInteger('user_id');
            $table->bigInteger('course_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment');
    }
};
