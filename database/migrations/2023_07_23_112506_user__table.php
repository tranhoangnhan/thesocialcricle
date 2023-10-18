<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('user_id');
            $table->string('user_username', 30)->unique()->nullable();
            $table->string('user_fullname', 100)->nullable();
            $table->text('user_password');
            $table->string('user_cover', 255)->nullable();
            $table->enum('user_banned', ['0', '1'])->default('0');
            $table->text('user_banned_message')->nullable();
            $table->string('user_email', 256)->unique();
            $table->enum('user_email_verified', ['0', '1'])->default('0');
            $table->string('user_email_verification_code')->nullable();
            $table->enum('user_activated', ['0', '1'])->default('0');
            $table->string('user_phone', 10)->unique()->nullable();
            $table->tinyInteger('user_role')->default('0');
            $table->date('user_birthday')->nullable();
            $table->string('user_avatar', 255)->nullable();
            $table->text('user_bio')->nullable();
            $table->text('user_ip_address')->nullable();
            $table->enum('user_gender', ['0', '1', '2'])->nullable();
            $table->timestamp('user_registered')->nullable()->useCurrent();
            $table->timestamp('user_last_seen')->nullable()->useCurrent();
            $table->enum('user_chat_enabled', ['0', '1'])->default('0');
            $table->string('user_token')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
