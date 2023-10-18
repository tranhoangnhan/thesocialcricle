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
        Schema::table('pages', function (Blueprint $table) {
            // $table->unsignedBigInteger('page_admin')->index();
            // $table->foreign('page_admin')->references('id')->on('pages_admin');

            $table->unsignedBigInteger('page_category')->index();
            // $table->foreign('page_category')->references('category_id')->on('pages_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
