<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPurchaseItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_items', function (Blueprint $table) {
           $table->increments('id')->unsigned();
           $table->integer('purchase_id')->unsigned()->index();
           $table->integer('product_id')->unsigned()->index();
           $table->integer('unit_id')->unsigned()->index();
           $table->integer('quantity')->unsigned();
           $table->decimal('price', 15, 0);
           $table->text('description')->nullable();
           $table->timestamps();
           $table->softDeletes();

           $table->foreign('purchase_id')->references('id')->on('purchases')->onDelete('cascade');
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
        Schema::dropIfExists('purchase_items');
    }
}
