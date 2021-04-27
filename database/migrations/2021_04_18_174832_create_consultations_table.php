<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConsultationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultations', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('app_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->foreignId('pres_id')->references('id')->on('prescriptions')->onDelete('cascade');;
            $table->integer('length')->nullable();
            $table->integer('weight')->nullable();
            $table->float('temperature')->nullable();
            $table->string('description')->nullable();
            $table->integer('paid_amount')->nullable();
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
        Schema::dropIfExists('consultations');
    }
}
