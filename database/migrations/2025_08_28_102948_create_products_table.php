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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('florist_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('special_occassion_id')->nullable();
            $table->string('name');
            $table->string('image');
            $table->text('description')->nullable();
            $table->decimal('price');
            $table->timestamps();

            $table->foreign('florist_id')->references('id')->on('florists')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('special_occassion_id')->references('id')->on('special_occassions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
