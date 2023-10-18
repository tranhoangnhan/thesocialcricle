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
        Schema::create('posts_links', function (Blueprint $table) {
            $table->bigIncrements('link_id');
            // $table->integer('post_id');
            $table->enum('type',['media','link'])->default('link');
            $table->text('source_url');
            $table->string('source_host');
            $table->text('source_title');
            $table->text('source_text')->nullable();
            $table->text('source_html')->nullable();
            $table->text('source_thumbnail');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_links');
    }
};
