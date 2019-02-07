<?php

use Illuminate\Database\Seeder;

class ConfBankTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_bank')->delete();
        
        \DB::table('conf_bank')->insert(array (
            0 => 
            array (
                'id' => 1,
                'bank_kode' => 'BRI',
                'bank_name' => 'Bank Rakyat Indonesia',
                'bank_status' => 1,
                'bank_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'bank_kode' => 'BCA',
                'bank_name' => 'Bank Central Asia',
                'bank_status' => 1,
                'bank_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'bank_kode' => 'Mandiri',
                'bank_name' => 'Mandiri',
                'bank_status' => 1,
                'bank_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'bank_kode' => 'BNI',
                'bank_name' => 'Bank Negara Indonesia',
                'bank_status' => 1,
                'bank_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'bank_kode' => 'BTN',
                'bank_name' => 'Bank Tabungan Negara',
                'bank_status' => 1,
                'bank_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'bank_kode' => 'BMT',
                'bank_name' => 'Bank Mandiri Taspen',
                'bank_status' => 1,
                'bank_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'bank_kode' => 'BI',
                'bank_name' => 'Bank Indonesia',
                'bank_status' => 1,
                'bank_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}