<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSaleItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_items', function (Blueprint $table) {
           $table->increments('id')->unsigned();
           $table->integer('sale_id')->unsigned()->index();
           $table->integer('product_id')->unsigned()->index();
           $table->integer('unit_id')->unsigned()->index();
           $table->integer('quantity')->unsigned();
           $table->decimal('price', 15, 0);
           $table->text('description')->nullable();
           $table->timestamps();
           $table->softDeletes();

           $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
           $table->foreign('product_id')->references('id')->on('products')->onDelete('restrict');
           $table->foreign('unit_id')->references('id')->on('units')->onDelete('restrict');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_items');
    }
}
