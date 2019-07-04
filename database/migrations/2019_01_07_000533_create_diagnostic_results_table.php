<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnosticResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnostic_results', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('patient_id');
            $table->integer('diagnostic_id');
            $table->string('result')->nullable();
            $table->boolean('is_file')->default(false);
            $table->string('normal_range');
            $table->decimal('price');
            $table->decimal('discount');

            $table->integer('created_by');
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
        Schema::dropIfExists('diagnostic_results');
    }
}
