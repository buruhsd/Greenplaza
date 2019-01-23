<?php

use Illuminate\Database\Seeder;

class ConfIklanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_iklan')->delete();
        
        \DB::table('conf_iklan')->insert(array (
            0 => 
            array (
                'id' => 1,
                'iklan_name' => 'banner1',
                'iklan_price' => '355.00',
                'iklan_status' => 1,
                'iklan_type' => 1,
                'iklan_note' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'iklan_name' => 'banner2',
                'iklan_price' => '22.00',
                'iklan_status' => 1,
                'iklan_type' => 1,
                'iklan_note' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'iklan_name' => 'banner3',
                'iklan_price' => '23.00',
                'iklan_status' => 1,
                'iklan_type' => 1,
                'iklan_note' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'iklan_name' => 'banner4',
                'iklan_price' => '234.00',
                'iklan_status' => 1,
                'iklan_type' => 1,
                'iklan_note' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'iklan_name' => 'banner5',
                'iklan_price' => '23.00',
                'iklan_status' => 1,
                'iklan_type' => 1,
                'iklan_note' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'iklan_name' => 'slider1',
                'iklan_price' => '0.00',
                'iklan_status' => 1,
                'iklan_type' => 2,
                'iklan_note' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'iklan_name' => 'slider2',
                'iklan_price' => '0.00',
                'iklan_status' => 1,
                'iklan_type' => 2,
                'iklan_note' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'iklan_name' => 'slider3',
                'iklan_price' => '0.00',
                'iklan_status' => 1,
                'iklan_type' => 2,
                'iklan_note' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'iklan_name' => 'slider4',
                'iklan_price' => '0.00',
                'iklan_status' => 1,
                'iklan_type' => 2,
                'iklan_note' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'iklan_name' => 'slider5',
                'iklan_price' => '0.00',
                'iklan_status' => 1,
                'iklan_type' => 4,
                'iklan_note' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'iklan_name' => 'slider6',
                'iklan_price' => '0.00',
                'iklan_status' => 1,
                'iklan_type' => 4,
                'iklan_note' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'iklan_name' => 'slider7',
                'iklan_price' => '0.00',
                'iklan_status' => 1,
                'iklan_type' => 4,
                'iklan_note' => '',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}