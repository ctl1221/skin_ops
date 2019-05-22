<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSequencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sequences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('prefix');
            $table->text('description');
            $table->unsignedInteger('integer_value');
            $table->double('decimal_value');
            $table->string('text_value');
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
        Schema::dropIfExists('sequences');
    }
}
