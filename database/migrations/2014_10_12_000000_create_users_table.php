<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plan_id')->nullable();
            $table->string('firstname', 40)->nullable();
            $table->string('lastname', 40)->nullable();
            $table->string('name', 40)->nullable();
            $table->string('username', 40)->nullable();
            $table->string('uuid', 10)->nullable();
            $table->string('user_type', 10)->nullable();
            $table->unsignedBigInteger('ref_by')->nullable();
            $table->integer('daily_limit')->default(0);
            $table->string('email', 40)->unique();
            $table->string('country_code', 40)->nullable();
            $table->string('mobile', 40)->nullable();
            $table->decimal('balance', 28,8)->default('0.00000000');
            $table->decimal('profit_bonus', 28,8)->default('0.00000000');
            $table->decimal('deposit_commission', 28,8)->default('0.00000000');
            $table->decimal('current_profit', 28,8)->default('0.00000000');
            $table->string('password');
            $table->string('image')->nullable();
            $table->text('address')->nullable()->comment('contains full address');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->text('kyc_data')->nullable();
            $table->enum('kv', ['verified', 'unverified'])->default('unverified');
            $table->enum('ev', ['verified', 'unverified'])->default('unverified');
            $table->enum('sv', ['verified', 'unverified'])->default('unverified');
            $table->tinyInteger('reg_step')->default(0);
            $table->string('ver_code', 40)->nullable()->comment('stores verification code');
            $table->dateTime('ver_code_send_at')->nullable()->comment('verification send time');
            $table->enum('ts', ['active', 'inactive'])->default('inactive')->comment('0: 2fa off, 1: 2fa on');
            $table->enum('tv', ['verified', 'unverified'])->default('verified')->comment('0: 2fa unverified, 1: 2fa verified');
            $table->string('tsc')->nullable();
            $table->string('ban_reason')->nullable();
            $table->dateTime('expire_date')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('ref_by')->references('id')->on('users')->onDelete('cascade');
              });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
