<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('last_name');
            $table->string('first_name');
            $table->boolean('is_active')->default(1);
            $table->unsignedInteger('branch_id');
            $table->boolean('is_receptionist');
            $table->boolean('is_aesthetician');
            $table->boolean('is_doctor');
            $table->boolean('is_administrator');
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
        Schema::dropIfExists('employees');
    }
}
