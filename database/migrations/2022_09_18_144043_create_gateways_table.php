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
        Schema::create('gateways', function (Blueprint $table) {
            $table->id();
            $table->integer('code')->nullable();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->string('description', 600)->nullable();
            $table->boolean('crypto')->nullable();
            $table->boolean('status')->nullable();
            $table->boolean('is_manual')->nullable();
            $table->json('parameters')->nullable();
            $table->json('supported_currencies')->nullable();
            $table->json('extra')->nullable();
            $table->json('input_form')->nullable();
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
        Schema::dropIfExists('gateways');
    }
};
