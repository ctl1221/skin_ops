<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_claims', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->unsignedInteger('owner_id')->nullable();
            $table->unsignedInteger('claimed_by_id')->nullable();
            $table->date('claimed_by_date')->nullable();
            $table->morphs('parent');
            $table->morphs('sellable');
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
        Schema::dropIfExists('client_claims');
    }
}
