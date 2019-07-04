<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('branch_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable()->default(null);
            $table->text('address')->nullable()->default(null);
            $table->integer('sex');
            $table->string('position')->nullable()->default(null);
            $table->date('appointment_date')->nullable()->default(null);
            $table->date('dob')->nullable()->default(null);
            $table->integer('status')->default(1);
            $table->string('photo')->nullable()->default(null);
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
