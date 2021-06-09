<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'first_name' => 'Manager',
                'last_name' => 'Man',
                'birthdate' => '2000-01-01',
                'gender' => 'Male',
                'role' => 'man',
                'email' => 'manager@clinic.com',
                'phone' => '0500000001',
                'password' => 'admin'
                ],
            [
                'id' => 2,
                'first_name' => 'Secritaire',
                'last_name' => 'Sec',
                'birthdate' => '2000-01-01',
                'gender' => 'Female',
                'role' => 'sec',
                'email' => 'secritaire@clinic.com',
                'phone' => '0500000000',
                'password' => 'secritaire'
            ]
        ]);
    }
}
