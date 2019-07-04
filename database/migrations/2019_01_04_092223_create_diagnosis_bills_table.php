<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosisBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnosis_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('patient_id');
            $table->string('name');
            $table->double('price');
            $table->integer('qty')->default(1);
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
        Schema::dropIfExists('diagnosis_bills');
    }
}
