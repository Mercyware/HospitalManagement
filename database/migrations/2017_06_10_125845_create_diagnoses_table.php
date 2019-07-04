<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiagnosesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnoses', function (Blueprint $table) {
            $table->increments('id');
            $table->date('diagnosis_date')->useCurrent();
            $table->integer('patient_id')->default(0);
            $table->integer('user_id')->default(0);
            $table->integer('diagnosis_type')->default(0); //1 for Dental, 2 for Eye
            $table->integer('pressure')->nullable();
            $table->integer('temperature')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('pulse')->nullable();
            $table->string('complaint')->nullable();
            $table->string('drug_history')->nullable();
            $table->string('med_history')->nullable();
            $table->string('social_history')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('treatment')->nullable();
            $table->string('summary')->nullable();
            $table->string('left_eye')->nullable();
            $table->string('right_eye')->nullable();


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
        Schema::dropIfExists('diagnoses');
    }
}
