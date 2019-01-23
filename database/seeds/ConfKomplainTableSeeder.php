<?php

use Illuminate\Database\Seeder;

class ConfKomplainTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_komplain')->delete();
        
        \DB::table('conf_komplain')->insert(array (
            0 => 
            array (
                'id' => 1,
                'komplain_name' => 'Barang yang diterima tidak sesuai dengan deskripsi',
                'komplain_status' => 1,
                'komplain_note' => NULL,
                'created_at' => '2018-11-26 12:29:50',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'komplain_name' => 'Barang cacat atau rusak',
                'komplain_status' => 1,
                'komplain_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'komplain_name' => 'Barang diterima tapi komponen tidak lengkap',
                'komplain_status' => 1,
                'komplain_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'komplain_name' => 'Kurir tidak sesuai dengan permintaan',
                'komplain_status' => 0,
                'komplain_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'komplain_name' => 'Barang tidak sampai',
                'komplain_status' => 0,
                'komplain_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}