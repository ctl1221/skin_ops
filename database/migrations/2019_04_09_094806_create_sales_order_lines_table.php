<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOrderLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_order_lines', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sales_order_id')->unsigned()->index();
            $table->morphs('sellable');
            $table->double('price');
            $table->bigInteger('sold_by_id')->nullable();
            $table->bigInteger('treated_by_id')->nullable();
            $table->bigInteger('assisted_by_id')->nullable();
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
        Schema::dropIfExists('sales_order_lines');
    }
}
