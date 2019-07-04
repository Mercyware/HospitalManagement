<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDrugAdministersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drug_administers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('drug_id');
            $table->integer('user_id');
            $table->integer('days');
            $table->string('usage');
            $table->date('date_created');
            $table->integer('status')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drug_administers');
    }
}
