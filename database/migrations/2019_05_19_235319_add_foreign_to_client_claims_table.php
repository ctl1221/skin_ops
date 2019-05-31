<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignToClientClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('client_claims', function (Blueprint $table) {
            $table->foreign('claimed_by_id')->references('id')->on('clients')->onDelete('cascade'); 
            $table->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade'); 
            $table->foreign('treated_by_id')->references('id')->on('employees')->onDelete('cascade'); 
            $table->foreign('assisted_by_id')->references('id')->on('employees')->onDelete('cascade'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('client_claims', function (Blueprint $table) {
            $table->dropForeign(['client_id']);
            $table->dropForeign(['branch_id']);
            $table->dropForeign(['treated_by_id']);
            $table->dropForeign(['assisted_by_id']);
        });
    }
}
