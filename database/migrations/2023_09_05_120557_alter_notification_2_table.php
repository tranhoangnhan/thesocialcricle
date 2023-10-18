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
        Schema::table('notification', function (Blueprint $table) {
            $table->enum('from_user_type',['user','page'])->default('user')->change();
            $table->string('node_type')->nullable()->change();
            $table->string('node_url')->nullable()->change();
            $table->text('message')->nullable()->change();
            $table->enum('seen',['0','1'])->default('0')->change();
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
