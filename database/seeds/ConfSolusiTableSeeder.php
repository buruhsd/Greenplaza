<?php

use Illuminate\Database\Seeder;

class ConfSolusiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_solusi')->delete();
        
        \DB::table('conf_solusi')->insert(array (
            0 => 
            array (
                'id' => 1,
                'solusi_komplain_id' => '1,2,3,4',
                'solusi_name' => 'Kembalikan Dana',
                'solusi_status' => 1,
                'solusi_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'solusi_komplain_id' => '1,2',
                'solusi_name' => 'Tukar barang sesuai dengan pesanan',
                'solusi_status' => 1,
                'solusi_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'solusi_komplain_id' => '3',
                'solusi_name' => 'Kirim sisa barang yang kurang',
                'solusi_status' => 1,
                'solusi_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'solusi_komplain_id' => '1,2,3,4',
                'solusi_name' => 'Return barang dan kembalikan dana',
                'solusi_status' => 1,
                'solusi_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}