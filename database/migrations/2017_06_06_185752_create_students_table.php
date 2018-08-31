<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('sex');
            $table->string('dob');
            $table->string('email');
            $table->string('phone');
            $table->string('nationality');
            $table->string('national_id')->nullable();
            $table->string('passport')->nullable();
            $table->string('status')->nullable();
            $table->string('village');
            $table->string('commune');
            $table->string('district');
            $table->string('city');
            $table->string('current_address');
            $table->string('dateregistered');
            $table->string('photo');
            $table->integer('user_id');
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
        Schema::dropIfExists('students');
    }
}
