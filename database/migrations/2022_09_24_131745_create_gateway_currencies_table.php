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
        Schema::create('gateway_currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->unique();
            $table->string('currency', 10);
            $table->string('symbol', 10);
            $table->unsignedBigInteger('gateway_id');
            $table->decimal('min_amount', 18,8)->default(0);
            $table->decimal('max_amount', 18,8)->default(0);
            $table->integer('percentage_charge')->default(0);
            $table->decimal('fixed_charge', 18,8)->default(0);
            $table->decimal('rate', 18,8)->default(0);
            $table->json('gateway_parameter')->default('[]');
            $table->timestamps();

            $table->foreign('gateway_id')->on('gateways')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gateway_currencies');
    }
};
