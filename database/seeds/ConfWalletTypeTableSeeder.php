<?php

use Illuminate\Database\Seeder;

class ConfWalletTypeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_wallet_type')->delete();
        
        \DB::table('conf_wallet_type')->insert(array (
            0 => 
            array (
                'id' => 1,
                'wallet_type_kode' => 'cw',
                'wallet_type_name' => 'cw',
                'wallet_type_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'wallet_type_kode' => 'rw',
                'wallet_type_name' => 'rw',
                'wallet_type_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'wallet_type_kode' => 'transaksi',
                'wallet_type_name' => 'transaksi',
                'wallet_type_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'wallet_type_kode' => 'iklan',
                'wallet_type_name' => 'iklan',
                'wallet_type_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'wallet_type_kode' => 'pin_code',
                'wallet_type_name' => 'pin_code',
                'wallet_type_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'wallet_type_kode' => 'hotlist',
                'wallet_type_name' => 'hotlist',
                'wallet_type_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}