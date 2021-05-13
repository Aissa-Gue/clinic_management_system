<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id('id');
            $table->string('last_name',50);
            $table->string('first_name',50);
            $table->string('gender',10);
            $table->date('birthdate');
            $table->string('address',50)->nullable();
            $table->foreignId('city_id')->references('id')->on('cities');
            $table->string('blood_type',3)->nullable();
            $table->string('blood_pressure',5)->nullable();
            $table->string('diabetes',5)->nullable();
            $table->string('email',50)->unique()->nullable();
            $table->integer('phone')->unique();
            $table->timestamps();
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
