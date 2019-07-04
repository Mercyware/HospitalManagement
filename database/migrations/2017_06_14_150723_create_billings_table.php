<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id')->default(0);
            $table->string('bill_title')->default('null');
            $table->integer('qty')->default(1);
            $table->integer('amount')->default(0);
            $table->integer('user_id')->default(0);
            $table->integer('drug_id')->default(0);
            $table->date('date_received')->default(date('Y-m-d'));
            $table->integer('discount')->default(0);
            $table->boolean('is_subtract_discount')->default(true);
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
        Schema::dropIfExists('billings');
    }
}
