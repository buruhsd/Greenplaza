<?php

use Illuminate\Database\Seeder;

class ConfProdukLocationTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_produk_location')->delete();
        
        \DB::table('conf_produk_location')->insert(array (
            0 => 
            array (
                'id' => 1,
                'produk_location_name' => 'etalase',
                'produk_location_status' => 1,
                'produk_location_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'produk_location_name' => 'gudang',
                'produk_location_status' => 1,
                'produk_location_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}