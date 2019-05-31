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
            $table->bigInteger('claimed_by_id')->nullable()->unsigned()->index();
            $table->date('claimed_by_date')->nullable();
            $table->morphs('parent');
            $table->morphs('sellable');
            $table->morphs('category');
            $table->bigInteger('branch_id')->nullable()->unsigned()->index();
            $table->bigInteger('treated_by_id')->nullable()->unsigned()->index();
            $table->bigInteger('assisted_by_id')->nullable()->unsigned()->index();
            $table->text('notes')->nullable();
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
