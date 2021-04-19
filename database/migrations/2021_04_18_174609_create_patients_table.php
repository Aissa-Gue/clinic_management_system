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
            $table->id('pat_id');
            $table->string('last_name',50);
            $table->string('first_name',50);
            $table->string('gender',10);
            $table->date('birthdate');
            $table->string('blood_type',3);
            $table->string('blood pressure',3);
            $table->string('diabetes',3);
            $table->string('email')->unique();
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
