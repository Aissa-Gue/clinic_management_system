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
            $table->id('doc_id');
            $table->string('last_name',50);
            $table->string('first_name',50);
            $table->string('gender',10);
            $table->date('birthdate');
            $table->string('Address',50);
            $table->string('email',30);
            $table->integer('phone');
            $table->foreignId('spec_id')->references('spec_id')->on('specialisations');
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
        Schema::dropIfExists('doctors');
    }
}
