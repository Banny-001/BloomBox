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
        // Schema::create('payment', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('user_id')->unique();
        //     $table->unsignedBigInteger('order_id')->unique();
        //     $table->foreign('user_id')->references('user_id')->on('customer')->onDelete('cascade');
        //     $table->foreign('order_id')->references("order_id")->on('orders')->onDelete('cascade');
        //     $table->double('amount');
        //     $table->string('payment_intent_id')->unique();
        //     $table->enum('status', ['pending', 'succeeded', 'failed'])->default('pending');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment');
    }
};
