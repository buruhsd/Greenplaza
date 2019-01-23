<?php

use Illuminate\Database\Seeder;

class ConfPaketPincodeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_paket_pincode')->delete();
        
        \DB::table('conf_paket_pincode')->insert(array (
            0 => 
            array (
                'id' => 1,
                'paket_pincode_name' => 'putih',
                'paket_pincode_price' => '50000.00',
                'paket_pincode_amount' => '10.00',
                'paket_pincode_bonus' => '0.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'paket_pincode_name' => 'merah',
                'paket_pincode_price' => '100000.00',
                'paket_pincode_amount' => '20.00',
                'paket_pincode_bonus' => '5.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'paket_pincode_name' => 'biru',
                'paket_pincode_price' => '150000.00',
                'paket_pincode_amount' => '30.00',
                'paket_pincode_bonus' => '15.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'paket_pincode_name' => 'hijau',
                'paket_pincode_price' => '200000.00',
                'paket_pincode_amount' => '40.00',
                'paket_pincode_bonus' => '25.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'paket_pincode_name' => 'hitam',
                'paket_pincode_price' => '250000.00',
                'paket_pincode_amount' => '50.00',
                'paket_pincode_bonus' => '35.00',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}