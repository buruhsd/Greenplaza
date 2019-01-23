<?php

use Illuminate\Database\Seeder;

class ConfPaketIklanTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_paket_iklan')->delete();
        
        \DB::table('conf_paket_iklan')->insert(array (
            0 => 
            array (
                'id' => 1,
                'paket_iklan_name' => 'melati',
                'paket_iklan_price' => '50000.00',
                'paket_iklan_amount' => '50000.00',
                'paket_iklan_bonus' => '0.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'paket_iklan_name' => 'mawar',
                'paket_iklan_price' => '100000.00',
                'paket_iklan_amount' => '100000.00',
                'paket_iklan_bonus' => '0.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'paket_iklan_name' => 'teratai',
                'paket_iklan_price' => '250000.00',
                'paket_iklan_amount' => '250000.00',
                'paket_iklan_bonus' => '0.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'paket_iklan_name' => 'tulib',
                'paket_iklan_price' => '500000.00',
                'paket_iklan_amount' => '500000.00',
                'paket_iklan_bonus' => '0.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'paket_iklan_name' => 'anggrek',
                'paket_iklan_price' => '1000000.00',
                'paket_iklan_amount' => '1000000.00',
                'paket_iklan_bonus' => '0.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'paket_iklan_name' => 'lily',
                'paket_iklan_price' => '1500000.00',
                'paket_iklan_amount' => '1500000.00',
                'paket_iklan_bonus' => '0.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'paket_iklan_name' => 'sakura',
                'paket_iklan_price' => '2000000.00',
                'paket_iklan_amount' => '2000000.00',
                'paket_iklan_bonus' => '0.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}