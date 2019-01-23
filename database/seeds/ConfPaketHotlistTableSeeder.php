<?php

use Illuminate\Database\Seeder;

class ConfPaketHotlistTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_paket_hotlist')->delete();
        
        \DB::table('conf_paket_hotlist')->insert(array (
            0 => 
            array (
                'id' => 1,
                'paket_hotlist_name' => 'mercurius',
                'paket_hotlist_price' => '50000.00',
                'paket_hotlist_amount' => '1000.00',
                'paket_hotlist_bonus' => '1.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'paket_hotlist_name' => 'venus',
                'paket_hotlist_price' => '100000.00',
                'paket_hotlist_amount' => '2000.00',
                'paket_hotlist_bonus' => '1.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'paket_hotlist_name' => 'mars',
                'paket_hotlist_price' => '200000.00',
                'paket_hotlist_amount' => '4000.00',
                'paket_hotlist_bonus' => '1.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'paket_hotlist_name' => 'jupiter',
                'paket_hotlist_price' => '300000.00',
                'paket_hotlist_amount' => '6000.00',
                'paket_hotlist_bonus' => '1.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'paket_hotlist_name' => 'saturnus',
                'paket_hotlist_price' => '500000.00',
                'paket_hotlist_amount' => '10000.00',
                'paket_hotlist_bonus' => '1.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'paket_hotlist_name' => 'uranus',
                'paket_hotlist_price' => '750000.00',
                'paket_hotlist_amount' => '15000.00',
                'paket_hotlist_bonus' => '10.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'paket_hotlist_name' => 'neptunus',
                'paket_hotlist_price' => '1000000.00',
                'paket_hotlist_amount' => '20000.00',
                'paket_hotlist_bonus' => '10.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}