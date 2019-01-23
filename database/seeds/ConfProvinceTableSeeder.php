<?php

use Illuminate\Database\Seeder;

class ConfProvinceTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_province')->delete();
        
        \DB::table('conf_province')->insert(array (
            0 => 
            array (
                'id' => 1,
                'province_name' => 'Bali',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'province_name' => 'Bangka Belitung',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'province_name' => 'Banten',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'province_name' => 'Bengkulu',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'province_name' => 'DI Yogyakarta',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'province_name' => 'DKI Jakarta',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'province_name' => 'Gorontalo',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'province_name' => 'Jambi',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'province_name' => 'Jawa Barat',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'province_name' => 'Jawa Tengah',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'province_name' => 'Jawa Timur',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'province_name' => 'Kalimantan Barat',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'province_name' => 'Kalimantan Selatan',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'province_name' => 'Kalimantan Tengah',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'province_name' => 'Kalimantan Timur',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'province_name' => 'Kalimantan Utara',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'province_name' => 'Kepulauan Riau',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'province_name' => 'Lampung',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'province_name' => 'Maluku',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'province_name' => 'Maluku Utara',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
            'province_name' => 'Nanggroe Aceh Darussalam (NAD)',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
            'province_name' => 'Nusa Tenggara Barat (NTB)',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
            'province_name' => 'Nusa Tenggara Timur (NTT)',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'province_name' => 'Papua',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'province_name' => 'Papua Barat',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'province_name' => 'Riau',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'province_name' => 'Sulawesi Barat',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'province_name' => 'Sulawesi Selatan',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'province_name' => 'Sulawesi Tengah',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'province_name' => 'Sulawesi Tenggara',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'province_name' => 'Sulawesi Utara',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'province_name' => 'Sumatera Barat',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'province_name' => 'Sumatera Selatan',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'province_name' => 'Sumatera Utara',
                'province_lat' => NULL,
                'province_lng' => NULL,
            ),
        ));
        
        
    }
}