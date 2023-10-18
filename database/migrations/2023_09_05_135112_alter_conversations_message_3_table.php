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
        // Schema::table('conversations_message', function (Blueprint $table) {
        //     $table->string('conversations_id')->nullable(false)->change();
        // });
    }

    public function down(): void
    {
        //
    }
};
