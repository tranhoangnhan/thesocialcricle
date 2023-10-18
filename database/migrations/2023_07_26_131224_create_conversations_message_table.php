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
        Schema::create('conversations_message', function (Blueprint $table) {
            $table->bigIncrements('message_id');
            // $table->integer('conversations_id');
            $table->enum('type',['voice','photo','video','text'])->default('text');
            // $table->integer('user_id');
            $table->longtext('message')->nullable();
            $table->string('source')->nullable();
            $table->unsignedInteger('reaction_like_count')->default('0');
            $table->unsignedInteger('reaction_love_count')->default('0');
            $table->unsignedInteger('reaction_haha_count')->default('0');
            $table->unsignedInteger('reaction_yay_count')->default('0');
            $table->unsignedInteger('reaction_wow_count')->default('0');
            $table->unsignedInteger('reaction_sad_count')->default('0');
            $table->unsignedInteger('reaction_angry_count')->default('0');
            $table->timestamp('time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conversations_message');
    }
};
