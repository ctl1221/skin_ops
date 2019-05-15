<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageBreakdownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_breakdowns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('package_id')->unsigned()->index();
            //$table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->morphs('sellable');
            $table->integer('quantity');
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
        Schema::dropIfExists('package_breakdowns');
    }
}
