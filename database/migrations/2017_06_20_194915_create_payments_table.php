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
            $table->increments('id');
            $table->integer('patient_id')->default(0);
            $table->string('bill_title')->default('null');
            $table->integer('amount')->default(0);
            $table->integer('user_id')->default(0);
            $table->integer('branch_id')->default(0);
            $table->integer('paytype')->default(0);
            $table->date('bill_date')->default(date('Y-m-d'));
            $table->date('date_received')->default(date('Y-m-d'));
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
