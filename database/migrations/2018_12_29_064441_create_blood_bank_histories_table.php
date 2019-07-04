<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBloodBankHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blood_bank_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('mobile')->nullable();
            $table->integer('blood_group_id');
            $table->text('details');
            $table->decimal('price');
            $table->integer('discount')->default(0);
            $table->boolean('is_subtract_discount')->default(true);
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
        Schema::dropIfExists('blood_bank_histories');
    }
}
