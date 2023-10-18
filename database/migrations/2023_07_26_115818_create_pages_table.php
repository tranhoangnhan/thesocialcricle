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
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('page_id');
            // $table->integer('page_admin');
            // $table->integer('page_category');
            $table->string('page_name')->unique();
            $table->string('page_title');
            $table->enum('page_verified',['0','1'])->default('0');
            $table->string('page_company')->nullable();
            $table->string('page_phone')->nullable();
            $table->mediumtext('page_website')->nullable();
            $table->string('page_address')->nullable();
            $table->mediumtext('page_description');
            $table->integer('page_likes')->default('0');
            $table->timestamp('page_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
