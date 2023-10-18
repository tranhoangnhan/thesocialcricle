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
        {
            Schema::table('posts', function (Blueprint $table) {
                $table->unsignedInteger('reaction_like_count')->default('0')->change();
                $table->unsignedInteger('reaction_love_count')->default('0')->change();
                $table->unsignedInteger('reaction_haha_count')->default('0')->change();
                $table->unsignedInteger('reaction_yay_count')->default('0')->change();
                $table->unsignedInteger('reaction_wow_count')->default('0')->change();
                $table->unsignedInteger('reaction_sad_count')->default('0')->change();
                $table->unsignedInteger('reaction_angry_count')->default('0')->change();
                $table->unsignedInteger('comments')->default('0')->change();
                $table->unsignedInteger('views')->default('0')->change();
                $table->unsignedInteger('shares')->default('0')->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
