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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->decimal('price', 18,8)->default(0);
            $table->decimal('user_ref', 18,8)->default(0);
            $table->integer('daily_limit')->default(0);
            $table->decimal('ptc_rate', 18,8)->default(0);
            $table->decimal('ptc_per_click_ref', 18,8)->default(0.00000000);
            $table->integer('ptc_per_click_ref_daily_limit')->default(0);
            $table->boolean('ptc_per_click_ref_status')->default(false);
            $table->decimal('sl_per_click_ref', 18,8)->default(0.00000000);
            $table->integer('sl_per_click_ref_daily_limit')->default(0);
            $table->boolean('sl_per_click_ref_status')->default(false);
            $table->decimal('task_per_click_ref', 18,8)->default(0.00000000);
            $table->integer('task_per_click_ref_daily_limit')->default(0);
            $table->boolean('task_per_click_ref_status')->default(false);
            $table->decimal('ca_ref_commission', 18,8)->default(0.00000000);
            $table->integer('ca_ref_commission_daily_limit')->default(0);
            $table->boolean('ca_ref_commission_status')->default(false);
            $table->integer('channel_subscribe_dl')->default(0);
            $table->boolean('status')->default(false);
            $table->integer('validity')->default(0);
            $table->integer('ref_level')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('plans');
    }
};
