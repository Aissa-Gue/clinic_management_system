<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
            [
                'id' => 1,
                'city' => 'Adrar',
                'zip_code' => '01000',
            ],
            [
                'id' => 2,
                'city' => 'Chlef',
                'zip_code' => '02000',
            ],
            [
                'id' => 3,
                'city' => 'Laghouat',
                'zip_code' => '03000',
            ],
            [
                'id' => 4,
                'city' => 'Oum El Bouaghi',
                'zip_code' => '04000',
            ],
            [
                'id' => 5,
                'city' => 'Batna',
                'zip_code' => '05000',
            ],
            [
                'id' => 6,
                'city' => 'Béjaïa',
                'zip_code' => '06000',
            ],
            [
                'id' => 7,
                'city' => 'Biskra',
                'zip_code' => '07000',
            ],
            [
                'id' => 8,
                'city' => 'Béchar',
                'zip_code' => '08000',
            ],
            [
                'id' => 9,
                'city' => 'Blida',
                'zip_code' => '09000',
            ],
            [
                'id' => 10,
                'city' => 'Bouïra',
                'zip_code' => '10000',
            ],
            [
                'id' => 11,
                'city' => 'Tamanrasset',
                'zip_code' => '11000',
            ],
            [
                'id' => 12,
                'city' => 'Tébessa',
                'zip_code' => '12000',
            ],
            [
                'id' => 13,
                'city' => 'Tlemcen',
                'zip_code' => '13000',
            ],[
                'id' => 14,
                'city' => 'Tiaret',
                'zip_code' => '14000',
            ],
            [
                'id' => 15,
                'city' => 'Tizi Ouzou',
                'zip_code' => '15000',
            ],[
                'id' => 16,
                'city' => 'Alger',
                'zip_code' => '16000',
            ],
            [
                'id' => 17,
                'city' => 'Djelfa',
                'zip_code' => '17000',
            ],
            [
                'id' => 18,
                'city' => 'Jijel',
                'zip_code' => '18000',
            ],
            [
                'id' => 19,
                'city' => 'Sétif',
                'zip_code' => '19000',
            ],
            [
                'id' => 20,
                'city' => 'Saïda',
                'zip_code' => '20000',
            ],
            [
                'id' => 21,
                'city' => '	Skikda',
                'zip_code' => '21000',
            ],
            [
                'id' => 22,
                'city' => 'Sidi Bel Abbès',
                'zip_code' => '22000',
            ],
            [
                'id' => 23,
                'city' => 'Annaba',
                'zip_code' => '23000',
            ],
            [
                'id' => 24,
                'city' => 'Guelma',
                'zip_code' => '24000',
            ],
            [
                'id' => 25,
                'city' => 'Constantine',
                'zip_code' => '25000',
            ],
            [
                'id' => 26,
                'city' => 'Médéa',
                'zip_code' => '26000',
            ],[
                'id' => 27,
                'city' => 'Mostaganem',
                'zip_code' => '27000',
            ],
            [
                'id' => 28,
                'city' => 'M\'Sila',
                'zip_code' => '28000',
            ],
            [
                'id' => 29,
                'city' => 'Mascara',
                'zip_code' => '29000',
            ],
            [
                'id' => 30,
                'city' => 'Ouargla',
                'zip_code' => '30000',
            ],
            [
                'id' => 31,
                'city' => 'Oran',
                'zip_code' => '31000',
            ],
            [
                'id' => 32,
                'city' => 'El Bayadh',
                'zip_code' => '32000',
            ],
            [
                'id' => 33,
                'city' => 'Illizi',
                'zip_code' => '33000',
            ],
            [
                'id' => 34,
                'city' => 'Bordj Bou Arréridj',
                'zip_code' => '34000',
            ],
            [
                'id' => 35,
                'city' => 'Boumerdès',
                'zip_code' => '35000',
            ],
            [
                'id' => 36,
                'city' => 'El Tarf',
                'zip_code' => '36000',
            ],
            [
                'id' => 37,
                'city' => 'Tindouf',
                'zip_code' => '37000',
            ],
            [
                'id' => 38,
                'city' => 'Tissemsilt',
                'zip_code' => '38000',
            ],
            [
                'id' => 39,
                'city' => 'El Oued',
                'zip_code' => '39000',
            ],
            [
                'id' => 40,
                'city' => 'Khenchela',
                'zip_code' => '40000',
            ],
            [
                'id' => 41,
                'city' => 'Souk Ahras',
                'zip_code' => '41000',
            ],
            [
                'id' => 42,
                'city' => 'Tipaza',
                'zip_code' => '42000',
            ],
            [
                'id' => 43,
                'city' => 'Mila',
                'zip_code' => '43000',
            ],
            [
                'id' => 44,
                'city' => 'Aïn Defla',
                'zip_code' => '44000',
            ],
            [
                'id' => 45,
                'city' => 'Naâma',
                'zip_code' => '45000',
            ],
            [
                'id' => 46,
                'city' => 'Aïn Témouchent',
                'zip_code' => '46000',
            ],
            [
                'id' => 47,
                'city' => 'Ghardaïa',
                'zip_code' => '47000',
            ],
            [
                'id' => 48,
                'city' => 'Relizane',
                'zip_code' => '48000',
            ],
        ]);
    }
}
