<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProductsTableAddUnitIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('unit_id')->unsigned()->index()->after('name');

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
         Schema::table('products', function (Blueprint $table) {
             $table->dropForeign(['unit_id']);
         });

         Schema::table('products', function (Blueprint $table) {
             $table->dropColumn('unit_id');
         });
     }
}
