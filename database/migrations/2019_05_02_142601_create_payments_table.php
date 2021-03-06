<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('py_number')->nullable();
            $table->date('date');
            $table->morphs('parent');
            $table->double('amount',2);
            $table->string('reference')->nullable();
            $table->text('notes')->nullable();
            $table->bigInteger('payment_type_id')->unsigned()->index();
            $table->bigInteger('branch_id')->unsigned()->index();
            $table->bigInteger('receptionist_id')->unsigned()->index();
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
        Schema::dropIfExists('payments');
    }
}
