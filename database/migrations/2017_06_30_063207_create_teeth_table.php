<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeethTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teeth', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('patient_id');
            $table->integer('user_id');
            $table->integer('tooth_position');
            $table->integer('tooth_number');
            $table->integer('tooth_status');
            $table->string('tooth_part')->default(NULL);
            $table->integer('part_value')->default(0);
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
        Schema::dropIfExists('teeth');
    }
}
