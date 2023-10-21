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
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('post_id');
            $table->enum('user_type', ['user', 'page']);
            $table->enum('in_group',['0', '1'])->default(0);
            // $table->integer('group_id')->nullable();
            $table->enum('group_approved',['0','1'])->default('0');
            $table->enum('in_wall',['0','1'])->default('0');
            // $table->integer('wall_id');
            $table->string('post_type', 32)->nullable();
            // $table->integer('colored_pattern')->default('0');
            $table->string('privacy');
            $table->longtext('text')->nullable();
            $table->enum('comment_disable',['0','1'])->default('0');
            $table->enum('is_hidden',['0','1'])->default('0');
            $table->enum('is_anonymous',['0','1'])->default('0');
            $table->unsignedInteger('reaction_like_count');
            $table->unsignedInteger('reaction_love_count');
            $table->unsignedInteger('reaction_haha_count');
            $table->unsignedInteger('reaction_yay_count');
            $table->unsignedInteger('reaction_wow_count');
            $table->unsignedInteger('reaction_sad_count');
            $table->unsignedInteger('reaction_angry_count');
            $table->unsignedInteger('comments');
            $table->unsignedInteger('views');
            $table->unsignedInteger('shares');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
