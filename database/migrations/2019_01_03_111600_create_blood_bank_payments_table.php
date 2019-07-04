<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodBankPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_bank_payments', function (Blueprint $table) {
            $table->increments('id');

            $table->date('date');
            $table->integer('blood_bank_history_id');
            $table->integer('name');
            $table->double('price');
            $table->integer('discount')->default(0);
            $table->boolean('is_subtract_discount')->default(true);
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
        Schema::dropIfExists('blood_bank_payments');
    }
}
