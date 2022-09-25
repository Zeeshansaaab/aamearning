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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('gateway_id')->nullable();
            $table->decimal('amount', 18,2)->default(0);
            $table->string('method_currency')->nullable();
            $table->decimal('charge', 18,2)->default(0);
            $table->decimal('rate', 18,2)->default(0);
            $table->decimal('final_amount', 18,2)->default(0);
            $table->decimal('btc_amount', 18,2)->default(0);
            $table->decimal('btc_wallet', 18,2)->default(0);
            $table->string('detail')->nullable();
            $table->string('trx');
            $table->string('admin_feedback');
            $table->integer('try');
            $table->enum('status', ['active', 'inactive', 'pending'])->default(true);
            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id');
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
        Schema::dropIfExists('deposits');
    }
};
