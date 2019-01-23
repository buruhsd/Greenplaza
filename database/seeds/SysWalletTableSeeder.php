<?php

use Illuminate\Database\Seeder;

class SysWalletTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_wallet')->delete();
        
        \DB::table('sys_wallet')->insert(array (
            0 => 
            array (
                'id' => 1,
                'wallet_user_id' => 1,
                'wallet_type' => 1,
                'wallet_ballance_before' => '0.00',
                'wallet_ballance' => '0.00',
                'wallet_address' => NULL,
                'wallet_public' => NULL,
                'wallet_private' => NULL,
                'wallet_note' => 'Created by registration',
                'created_at' => '2019-01-15 03:22:10',
                'updated_at' => '2019-01-15 03:22:10',
            ),
            1 => 
            array (
                'id' => 2,
                'wallet_user_id' => 1,
                'wallet_type' => 2,
                'wallet_ballance_before' => '0.00',
                'wallet_ballance' => '0.00',
                'wallet_address' => NULL,
                'wallet_public' => NULL,
                'wallet_private' => NULL,
                'wallet_note' => 'Created by registration',
                'created_at' => '2019-01-15 03:22:10',
                'updated_at' => '2019-01-15 03:22:10',
            ),
            2 => 
            array (
                'id' => 3,
                'wallet_user_id' => 1,
                'wallet_type' => 3,
                'wallet_ballance_before' => '0.00',
                'wallet_ballance' => '0.00',
                'wallet_address' => NULL,
                'wallet_public' => NULL,
                'wallet_private' => NULL,
                'wallet_note' => 'Created by registration',
                'created_at' => '2019-01-15 03:22:10',
                'updated_at' => '2019-01-15 03:22:10',
            ),
            3 => 
            array (
                'id' => 4,
                'wallet_user_id' => 1,
                'wallet_type' => 4,
                'wallet_ballance_before' => '0.00',
                'wallet_ballance' => '0.00',
                'wallet_address' => NULL,
                'wallet_public' => NULL,
                'wallet_private' => NULL,
                'wallet_note' => 'Created by registration',
                'created_at' => '2019-01-15 03:22:10',
                'updated_at' => '2019-01-15 03:22:10',
            ),
            4 => 
            array (
                'id' => 5,
                'wallet_user_id' => 1,
                'wallet_type' => 5,
                'wallet_ballance_before' => '0.00',
                'wallet_ballance' => '0.00',
                'wallet_address' => NULL,
                'wallet_public' => NULL,
                'wallet_private' => NULL,
                'wallet_note' => 'Created by registration',
                'created_at' => '2019-01-15 03:22:10',
                'updated_at' => '2019-01-15 03:22:10',
            ),
            5 => 
            array (
                'id' => 6,
                'wallet_user_id' => 2,
                'wallet_type' => 1,
                'wallet_ballance_before' => '0.00',
                'wallet_ballance' => '0.00',
                'wallet_address' => NULL,
                'wallet_public' => NULL,
                'wallet_private' => NULL,
                'wallet_note' => 'Created by registration',
                'created_at' => '2019-01-15 03:40:48',
                'updated_at' => '2019-01-15 03:40:48',
            ),
            6 => 
            array (
                'id' => 7,
                'wallet_user_id' => 2,
                'wallet_type' => 2,
                'wallet_ballance_before' => '0.00',
                'wallet_ballance' => '0.00',
                'wallet_address' => NULL,
                'wallet_public' => NULL,
                'wallet_private' => NULL,
                'wallet_note' => 'Created by registration',
                'created_at' => '2019-01-15 03:40:48',
                'updated_at' => '2019-01-15 03:40:48',
            ),
            7 => 
            array (
                'id' => 8,
                'wallet_user_id' => 2,
                'wallet_type' => 3,
                'wallet_ballance_before' => '0.00',
                'wallet_ballance' => '0.00',
                'wallet_address' => NULL,
                'wallet_public' => NULL,
                'wallet_private' => NULL,
                'wallet_note' => 'Created by registration',
                'created_at' => '2019-01-15 03:40:48',
                'updated_at' => '2019-01-15 03:40:48',
            ),
            8 => 
            array (
                'id' => 9,
                'wallet_user_id' => 2,
                'wallet_type' => 4,
                'wallet_ballance_before' => '0.00',
                'wallet_ballance' => '0.00',
                'wallet_address' => NULL,
                'wallet_public' => NULL,
                'wallet_private' => NULL,
                'wallet_note' => 'Created by registration',
                'created_at' => '2019-01-15 03:40:48',
                'updated_at' => '2019-01-15 03:40:48',
            ),
            9 => 
            array (
                'id' => 10,
                'wallet_user_id' => 2,
                'wallet_type' => 5,
                'wallet_ballance_before' => '0.00',
                'wallet_ballance' => '0.00',
                'wallet_address' => NULL,
                'wallet_public' => NULL,
                'wallet_private' => NULL,
                'wallet_note' => 'Created by registration',
                'created_at' => '2019-01-15 03:40:48',
                'updated_at' => '2019-01-15 03:40:48',
            ),
            10 => 
            array (
                'id' => 11,
                'wallet_user_id' => 3,
                'wallet_type' => 1,
                'wallet_ballance_before' => '0.00',
                'wallet_ballance' => '0.00',
                'wallet_address' => NULL,
                'wallet_public' => NULL,
                'wallet_private' => NULL,
                'wallet_note' => 'Created by registration',
                'created_at' => '2019-01-15 03:55:54',
                'updated_at' => '2019-01-15 03:55:54',
            ),
            11 => 
            array (
                'id' => 12,
                'wallet_user_id' => 3,
                'wallet_type' => 2,
                'wallet_ballance_before' => '0.00',
                'wallet_ballance' => '0.00',
                'wallet_address' => NULL,
                'wallet_public' => NULL,
                'wallet_private' => NULL,
                'wallet_note' => 'Created by registration',
                'created_at' => '2019-01-15 03:55:54',
                'updated_at' => '2019-01-15 03:55:54',
            ),
            12 => 
            array (
                'id' => 13,
                'wallet_user_id' => 3,
                'wallet_type' => 3,
                'wallet_ballance_before' => '0.00',
                'wallet_ballance' => '0.00',
                'wallet_address' => NULL,
                'wallet_public' => NULL,
                'wallet_private' => NULL,
                'wallet_note' => 'Created by registration',
                'created_at' => '2019-01-15 03:55:54',
                'updated_at' => '2019-01-15 03:55:54',
            ),
            13 => 
            array (
                'id' => 14,
                'wallet_user_id' => 3,
                'wallet_type' => 4,
                'wallet_ballance_before' => '0.00',
                'wallet_ballance' => '0.00',
                'wallet_address' => NULL,
                'wallet_public' => NULL,
                'wallet_private' => NULL,
                'wallet_note' => 'Created by registration',
                'created_at' => '2019-01-15 03:55:54',
                'updated_at' => '2019-01-15 03:55:54',
            ),
            14 => 
            array (
                'id' => 15,
                'wallet_user_id' => 3,
                'wallet_type' => 5,
                'wallet_ballance_before' => '0.00',
                'wallet_ballance' => '0.00',
                'wallet_address' => NULL,
                'wallet_public' => NULL,
                'wallet_private' => NULL,
                'wallet_note' => 'Created by registration',
                'created_at' => '2019-01-15 03:55:54',
                'updated_at' => '2019-01-15 03:55:54',
            ),
        ));
        
        
    }
}