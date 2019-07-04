<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaboratoryPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laboratory_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('patient_id');
            $table->integer('branch_id');
            $table->double('amount');
            $table->string('pay_type');
            $table->integer('collected_by');
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
        Schema::dropIfExists('laboratory_payments');
    }
}
