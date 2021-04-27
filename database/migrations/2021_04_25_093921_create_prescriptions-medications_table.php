<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsMedicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescriptions-medications', function (Blueprint $table) {
            $table->foreignId('pres_id')->references('id')->on('prescriptions');
            $table->foreignId('medic_id')->references('id')->on('medications');
            $table->integer('quantity');
            $table->string('dosage');
            $table->timestamps();
            $table->primary(array('pres_id', 'medic_id'));
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
        Schema::dropIfExists('prescriptions-medications');
    }
}
