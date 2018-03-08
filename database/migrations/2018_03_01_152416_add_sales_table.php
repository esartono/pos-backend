<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
           $table->increments('id')->unsigned();
           $table->integer('customer_id')->unsigned()->index();
           $table->datetime('sale_at');
           $table->text('description')->nullable();
           $table->timestamps();
           $table->softDeletes();

           $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
