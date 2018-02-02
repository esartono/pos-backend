<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProductsUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('products_units', function (Blueprint $table) {
            $table->integer('product_id')->unsigned()->index();
            $table->integer('unit_id')->unsigned()->index();
            $table->boolean('is_retail_unit')->default(false);
            $table->integer('exchange_value');

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
            $table->unique(['product_id', 'unit_id']);
        });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::dropIfExists('products_units');
     }
}
