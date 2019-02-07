<?php

use Illuminate\Database\Seeder;

class ConfPaymentTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_payment')->delete();
        
        \DB::table('conf_payment')->insert(array (
            0 => 
            array (
                'id' => 1,
                'payment_kode' => 'TF',
                'payment_name' => 'Transfer',
                'payment_status' => 1,
                'payment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'payment_kode' => 'Mt',
                'payment_name' => 'Midtrans',
                'payment_status' => 1,
                'payment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'payment_kode' => 'Me',
                'payment_name' => 'Masedi',
                'payment_status' => 1,
                'payment_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}