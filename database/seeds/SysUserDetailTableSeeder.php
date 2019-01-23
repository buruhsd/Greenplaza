<?php

use Illuminate\Database\Seeder;

class SysUserDetailTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_user_detail')->delete();
        
        \DB::table('sys_user_detail')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_detail_user_id' => 1,
                'user_detail_pass_trx' => '$2y$10$1Pyyiv8NhGc6Lw6TvjHbNeEUwFaDLfsvVppv8tbw3JmTbfa0gteUC',
                'user_detail_jk' => 'laki-laki',
                'user_detail_token' => '',
                'user_detail_address' => '',
                'user_detail_phone' => '080000000000',
                'user_detail_tlp' => NULL,
                'user_detail_province' => 1,
                'user_detail_city' => 1,
                'user_detail_subdist' => 1,
                'user_detail_pos' => 56195,
                'user_detail_image' => NULL,
                'user_detail_ktp' => '0',
                'user_detail_bank_id' => 0,
                'user_detail_bank_name' => NULL,
                'user_detail_bank_owner' => NULL,
                'user_detail_bank_no' => NULL,
                'user_detail_npwp' => NULL,
                'user_detail_npwp_image' => NULL,
                'user_detail_siup' => NULL,
                'user_detail_siup_image' => NULL,
                'user_detail_rek_book_image' => NULL,
                'user_detail_status' => 0,
                'user_detail_note' => NULL,
                'created_at' => '2019-01-15 03:22:10',
                'updated_at' => '2019-01-15 03:22:10',
            ),
            1 => 
            array (
                'id' => 2,
                'user_detail_user_id' => 2,
                'user_detail_pass_trx' => '$2y$10$JUDvkrma3ky5bl658ua8ZOj0ogvhlzD/eOj5C8V4F4XpNblFmi7iq',
                'user_detail_jk' => 'laki-laki',
                'user_detail_token' => '',
                'user_detail_address' => '',
                'user_detail_phone' => '080000000001',
                'user_detail_tlp' => NULL,
                'user_detail_province' => 1,
                'user_detail_city' => 1,
                'user_detail_subdist' => 1,
                'user_detail_pos' => 56195,
                'user_detail_image' => NULL,
                'user_detail_ktp' => '0',
                'user_detail_bank_id' => 0,
                'user_detail_bank_name' => NULL,
                'user_detail_bank_owner' => NULL,
                'user_detail_bank_no' => NULL,
                'user_detail_npwp' => NULL,
                'user_detail_npwp_image' => NULL,
                'user_detail_siup' => NULL,
                'user_detail_siup_image' => NULL,
                'user_detail_rek_book_image' => NULL,
                'user_detail_status' => 0,
                'user_detail_note' => NULL,
                'created_at' => '2019-01-15 03:40:48',
                'updated_at' => '2019-01-15 03:40:48',
            ),
            2 => 
            array (
                'id' => 3,
                'user_detail_user_id' => 3,
                'user_detail_pass_trx' => '$2y$10$cUhtgA9mabvGtXZGpoiJIuu8aPUrbxD30n9rtsX68S/esqiIcL0Z6',
                'user_detail_jk' => 'laki-laki',
                'user_detail_token' => '',
                'user_detail_address' => 'jl. selamat',
                'user_detail_phone' => '085701045375',
                'user_detail_tlp' => '085701045375',
                'user_detail_province' => 10,
                'user_detail_city' => 249,
                'user_detail_subdist' => 3527,
                'user_detail_pos' => 56195,
                'user_detail_image' => '15-Jan-2019_10-23-46_tCgD8.jpg',
                'user_detail_ktp' => '0',
                'user_detail_bank_id' => 1,
                'user_detail_bank_name' => 'BRI',
                'user_detail_bank_owner' => 'Fahmi Hidayat',
                'user_detail_bank_no' => '09009009009000',
                'user_detail_npwp' => NULL,
                'user_detail_npwp_image' => NULL,
                'user_detail_siup' => NULL,
                'user_detail_siup_image' => NULL,
                'user_detail_rek_book_image' => NULL,
                'user_detail_status' => 0,
                'user_detail_note' => NULL,
                'created_at' => '2019-01-15 03:55:54',
                'updated_at' => '2019-01-15 10:23:46',
            ),
        ));
        
        
    }
}