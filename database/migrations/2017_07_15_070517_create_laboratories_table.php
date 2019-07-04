<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaboratoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratories', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('patient_id');

            $table->integer('test_id');
            $table->string('test_name');
            $table->string('result')->nullable();
            $table->string('normal_range')->nullable();

            $table->double('price');
            $table->integer('discount')->default(0);
            $table->integer('charged_by');
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
        Schema::dropIfExists('laboratories');
    }
}
