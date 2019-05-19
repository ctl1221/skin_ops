<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToPricelistSellableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pricelist_sellable', function (Blueprint $table) {
            $table->foreign('pricelist_id')->references('id')->on('pricelists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pricelist_sellable', function (Blueprint $table) {
            $table->dropForeign(['pricelist_id']);
        });
    }
}
