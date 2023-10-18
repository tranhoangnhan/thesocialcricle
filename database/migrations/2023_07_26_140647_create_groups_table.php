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
        Schema::create('groups', function (Blueprint $table) {
            $table->bigIncrements('group_id');
            $table->enum('group_privacy',['secret', 'closed', 'public'])->default('public');
            // $table->integer('group_member');
            $table->string('group_name',64)->unique();
            $table->string('group_title');
            $table->mediumtext('group_description');
            $table->string('group_picture')->nullable();
            $table->string('group_cover')->nullable();
            $table->integer('group_pinned_post')->nullable();
            $table->timestamp('group_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('groups');
    }
};
