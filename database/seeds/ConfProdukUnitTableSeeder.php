<?php

use Illuminate\Database\Seeder;

class ConfProdukUnitTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_produk_unit')->delete();
        
        \DB::table('conf_produk_unit')->insert(array (
            0 => 
            array (
                'id' => 1,
                'produk_unit_name' => 'box',
                'produk_unit_status' => 1,
                'produk_unit_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'produk_unit_name' => 'pcs',
                'produk_unit_status' => 1,
                'produk_unit_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'produk_unit_name' => 'unit',
                'produk_unit_status' => 1,
                'produk_unit_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'produk_unit_name' => 'gram',
                'produk_unit_status' => 1,
                'produk_unit_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'produk_unit_name' => 'pasang',
                'produk_unit_status' => 1,
                'produk_unit_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}