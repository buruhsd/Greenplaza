<?php

use Illuminate\Database\Seeder;

class SysUserAddressTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_user_address')->delete();
        
        \DB::table('sys_user_address')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_address_user_id' => 1,
                'user_address_label' => 'Saya',
                'user_address_owner' => 'Saya',
                'user_address_address' => ' ',
                'user_address_phone' => '080000000001',
                'user_address_tlp' => '0',
                'user_address_province' => 1,
                'user_address_city' => 1,
                'user_address_subdist' => 1,
                'user_address_pos' => 56195,
                'user_address_status' => 0,
                'user_address_note' => NULL,
                'created_at' => '2019-01-21 11:14:15',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'user_address_user_id' => 2,
                'user_address_label' => 'Saya',
                'user_address_owner' => 'Saya',
                'user_address_address' => ' ',
                'user_address_phone' => '080000000000',
                'user_address_tlp' => '0',
                'user_address_province' => 1,
                'user_address_city' => 1,
                'user_address_subdist' => 1,
                'user_address_pos' => 56195,
                'user_address_status' => 0,
                'user_address_note' => NULL,
                'created_at' => '2019-01-21 11:14:15',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'user_address_user_id' => 3,
                'user_address_label' => 'Saya',
                'user_address_owner' => 'Saya',
                'user_address_address' => ' ',
                'user_address_phone' => '085701045375',
                'user_address_tlp' => '085701045375',
                'user_address_province' => 10,
                'user_address_city' => 249,
                'user_address_subdist' => 3527,
                'user_address_pos' => 56195,
                'user_address_status' => 0,
                'user_address_note' => NULL,
                'created_at' => '2019-01-21 11:14:15',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}