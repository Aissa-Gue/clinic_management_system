<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
            $table->string('first_name',50);
            $table->string('last_name',50);
            $table->string('gender',10);
            $table->date('birthdate');
            $table->string('speciality',100)->nullable();
            $table->string('address',50)->nullable();
            $table->foreignId('city_id')->nullable()->references('id')->on('cities');
            $table->string('email',30)->unique();
            $table->integer('phone')->unique();
            $table->string('password')->default(Hash::make('admin'));;
            $table->timestamps();
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });

        // Insert manager and secritaire
        DB::table('users')->insert(
            array(
                'id' => 1,
                'first_name' => 'Manager',
                'last_name' => 'Man',
                'birthdate' => '2000-01-01',
                'gender' => 'Male',
                'email' => 'manager@clinic.com',
                'phone' => '0500000001',
                'password' => Hash::make('admin')
            )
        );
        DB::table('users')->insert(
            array(
                'id' => 2,
                'first_name' => 'Secritaire',
                'last_name' => 'Sec',
                'birthdate' => '2000-01-01',
                'gender' => 'Female',
                'email' => 'secritaire@clinic.com',
                'phone' => '0500000000',
                'password' => Hash::make('secritaire')
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
