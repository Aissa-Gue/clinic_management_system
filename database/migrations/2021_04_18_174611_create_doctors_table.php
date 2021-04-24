<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id('id');
            $table->string('last_name',50);
            $table->string('first_name',50);
            $table->string('gender',10);
            $table->date('birthdate')->nullable();
            $table->string('address',50)->nullable();
            $table->foreignId('city_id')->references('id')->on('cities');
            $table->string('email',30)->nullable();
            $table->integer('phone')->nullable();
            $table->foreignId('spec_id')->references('id')->on('specialisations');
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
        Schema::dropIfExists('doctors');
    }
}
