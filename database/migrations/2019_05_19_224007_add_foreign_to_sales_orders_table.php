<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToSalesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales_orders', function (Blueprint $table) {
             $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
             $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
             $table->foreign('receptionist_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales_orders', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropForeign(['branch_id']);
            $table->dropForeign(['receptionist_id']);
        });
    }
}
