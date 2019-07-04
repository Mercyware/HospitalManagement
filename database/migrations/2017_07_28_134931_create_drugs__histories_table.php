<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDrugsHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drugs__histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('drug_id');
            $table->integer('qty');
            $table->integer('operation');
            $table->integer('user_id');
            $table->text('reason')->nullable;
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
        Schema::dropIfExists('drugs__histories');
    }
}
