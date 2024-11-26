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
        Schema::table('products', function (Blueprint $table) {
            
            $table->unsignedBigInteger('popular_id')->nullable();
            $table->foreign('popular_id')->references('id')->on('popular')->onDelete('cascade');

            $table->unsignedBigInteger('category_id')->nullable();;
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
           
            $table->unsignedBigInteger('special_occassion_id')->nullable();
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
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['popular_id']);
            $table->dropColumn('popular_id');

            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');

            $table->dropForeign(['special_occassion_id']);
            $table->dropColumn('special_occassion_id');
        });
    }
};
