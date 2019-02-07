<?php

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'migration' => '2014_10_12_000000_create_users_table',
                'batch' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'migration' => '2014_10_12_100000_create_password_resets_table',
                'batch' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'migration' => '2016_01_01_193651_create_roles_permissions_tables',
                'batch' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'migration' => '2018_08_21_022728_add_username_to_users',
                'batch' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'migration' => '2018_11_06_060900_create_conf_configs_table',
                'batch' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'migration' => '2018_11_07_032405_conf_bank',
                'batch' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'migration' => '2018_11_07_032512_sys_brand',
                'batch' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'migration' => '2018_11_07_033410_sys_category',
                'batch' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'migration' => '2018_11_07_041839_user_detail',
                'batch' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'migration' => '2018_11_07_063113_create_produk',
                'batch' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'migration' => '2018_11_07_070546_setup_config',
                'batch' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'migration' => '2018_11_08_082819_update_category',
                'batch' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'migration' => '2018_11_09_071822_sys_message',
                'batch' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'migration' => '2018_11_09_073005_sys_produk_discuss',
                'batch' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'migration' => '2018_11_09_082118_sys_trans',
                'batch' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'migration' => '2018_11_10_034241_create_wishlist',
                'batch' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'migration' => '2018_11_13_053950_update_user',
                'batch' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'migration' => '2018_11_13_060103_sys_email',
                'batch' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'migration' => '2018_11_14_062051_sys_produk_image',
                'batch' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'migration' => '2018_11_26_032110_komplain',
                'batch' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'migration' => '2018_11_27_034747_user_shipment',
                'batch' => 1,
            ),
            21 => 
            array (
                'id' => 22,
                'migration' => '2018_11_27_071838_review',
                'batch' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'migration' => '2018_11_29_034233_conf_page',
                'batch' => 1,
            ),
            23 => 
            array (
                'id' => 24,
                'migration' => '2018_12_02_095116_conf_area',
                'batch' => 1,
            ),
            24 => 
            array (
                'id' => 25,
                'migration' => '2018_12_05_065116_user_upload',
                'batch' => 1,
            ),
            25 => 
            array (
                'id' => 26,
                'migration' => '2018_12_05_141728_user_wallet',
                'batch' => 1,
            ),
            26 => 
            array (
                'id' => 27,
                'migration' => '2018_12_06_030500_update_user2',
                'batch' => 1,
            ),
            27 => 
            array (
                'id' => 28,
                'migration' => '2018_12_06_034808_widrawel',
                'batch' => 1,
            ),
            28 => 
            array (
                'id' => 29,
                'migration' => '2018_12_17_074151_user_tree',
                'batch' => 1,
            ),
            29 => 
            array (
                'id' => 30,
                'migration' => '2018_12_18_043906_log_wallet',
                'batch' => 1,
            ),
            30 => 
            array (
                'id' => 31,
                'migration' => '2018_12_19_034235_other_transaction',
                'batch' => 1,
            ),
            31 => 
            array (
                'id' => 32,
                'migration' => '2018_12_22_042037_update_frizka',
                'batch' => 1,
            ),
            32 => 
            array (
                'id' => 33,
                'migration' => '2018_12_27_102548_pincode_and_hotlist',
                'batch' => 1,
            ),
            33 => 
            array (
                'id' => 34,
                'migration' => '2018_12_28_030349_update_iklan',
                'batch' => 1,
            ),
            34 => 
            array (
                'id' => 35,
                'migration' => '2018_12_28_081726_update_other_trans',
                'batch' => 1,
            ),
            35 => 
            array (
                'id' => 36,
                'migration' => '2019_01_08_093119_update_sys_pincode',
                'batch' => 1,
            ),
            36 => 
            array (
                'id' => 37,
                'migration' => '2019_01_14_045038_user_activate_mail',
                'batch' => 1,
            ),
            37 => 
            array (
                'id' => 38,
                'migration' => '2019_01_23_093207_update_log_wallet',
                'batch' => 1,
            ),
            38 => 
            array (
                'id' => 39,
                'migration' => '2019_01_28_063434_update_review_stars',
                'batch' => 1,
            ),
            39 => 
            array (
                'id' => 40,
                'migration' => '2019_01_31_100202_update_category_field',
                'batch' => 1,
            ),
            40 => 
            array (
                'id' => 41,
                'migration' => '2019_02_02_113621_trans_masedi',
                'batch' => 1,
            ),
            41 => 
            array (
                'id' => 42,
                'migration' => '2019_02_07_073351_update_category_position_field',
                'batch' => 1,
            ),
        ));
        
        
    }
}