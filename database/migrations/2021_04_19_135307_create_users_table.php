<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id('id');
            $table->string('last_name',50);
            $table->string('first_name',50);
            $table->string('gender',10);
            $table->date('birthdate');
            $table->string('address',50)->nullable();
            $table->string('email',30)->unique();
            $table->integer('phone')->unique();
            $table->string('role',3);
            $table->string('password',32)->default('admin');;
            $table->timestamps();
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });

        // Insert manager and secritaire
        DB::table('users')->insert(
            array(
                'first_name' => 'Manager',
                'last_name' => 'Man',
                'gender' => 'Male',
                'role' => 'admin',
                'email' => 'manager@clinic.com',
                'password' => 'admin'
            ),
            array(
                'first_name' => 'Secritaire',
                'last_name' => 'Sec',
                'gender' => 'Female',
                'role' => 'sec',
                'email' => 'secritaire@clinic.com',
                'password' => 'secritaire'
            )
        );
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
