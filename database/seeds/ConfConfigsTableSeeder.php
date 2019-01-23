<?php

use Illuminate\Database\Seeder;

class ConfConfigsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conf_configs')->delete();
        
        \DB::table('conf_configs')->insert(array (
            0 => 
            array (
                'id' => 1,
                'configs_name' => 'profil_address',
                'configs_value' => 'jl.meranti no 314 Semarang',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => '2018-11-28 17:52:40',
            ),
            1 => 
            array (
                'id' => 2,
                'configs_name' => 'profil_phone',
                'configs_value' => '08xxxxxxxx',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'configs_name' => 'profil_pin_bb',
                'configs_value' => 'GHJK45',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => '2018-11-26 09:19:39',
                'updated_at' => '2018-11-26 09:19:39',
            ),
            3 => 
            array (
                'id' => 4,
                'configs_name' => 'profil_email',
                'configs_value' => 'greenplaza@greenplaza.com',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => '2018-11-26 09:20:08',
                'updated_at' => '2018-11-26 09:20:08',
            ),
            4 => 
            array (
                'id' => 5,
                'configs_name' => 'profil_facebook_group',
                'configs_value' => 'http://facebook.com/groups/greenplaza',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => '2018-11-26 09:21:09',
                'updated_at' => '2018-11-26 09:21:09',
            ),
            5 => 
            array (
                'id' => 6,
                'configs_name' => 'profil_twitter',
                'configs_value' => 'http://twitter.com/nama_twitter',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => '2018-11-26 09:21:39',
                'updated_at' => '2018-11-26 09:21:39',
            ),
            6 => 
            array (
                'id' => 7,
                'configs_name' => 'profil_google_plus',
                'configs_value' => 'http://plus.google.com/+greenplaza',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => '2018-11-26 09:22:10',
                'updated_at' => '2018-11-26 09:22:10',
            ),
            7 => 
            array (
                'id' => 8,
                'configs_name' => 'profil_instagram',
                'configs_value' => 'http://instagram.com/greenplaza',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => '2018-11-26 09:22:42',
                'updated_at' => '2018-11-26 09:22:42',
            ),
            8 => 
            array (
                'id' => 9,
                'configs_name' => 'profil_youtube',
                'configs_value' => 'http://youtube.com/user/greenplaza',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => '2018-11-26 09:23:07',
                'updated_at' => '2018-11-26 09:23:07',
            ),
            9 => 
            array (
                'id' => 10,
                'configs_name' => 'transaksi_durasi_checkout',
                'configs_value' => '2',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => '2018-11-26 09:09:43',
                'updated_at' => '2018-11-26 09:09:43',
            ),
            10 => 
            array (
                'id' => 11,
                'configs_name' => 'transaksi_durasi_seller_tunggu',
                'configs_value' => '3',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => '2018-11-26 09:09:56',
                'updated_at' => '2018-11-26 09:09:56',
            ),
            11 => 
            array (
                'id' => 12,
                'configs_name' => 'transaksi_durasi_shipping',
                'configs_value' => '14',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => '2018-11-26 09:10:08',
                'updated_at' => '2018-11-26 09:10:08',
            ),
            12 => 
            array (
                'id' => 13,
                'configs_name' => 'transaksi_durasi_seller_sanggup',
                'configs_value' => '5',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => '2018-11-26 09:10:24',
                'updated_at' => '2018-11-26 09:10:24',
            ),
            13 => 
            array (
                'id' => 14,
                'configs_name' => 'transaksi_durasi_beli_hot_list',
                'configs_value' => '2',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => '2018-11-26 09:10:41',
                'updated_at' => '2018-11-26 09:10:41',
            ),
            14 => 
            array (
                'id' => 15,
                'configs_name' => 'transaksi_durasi_beli_pin_code',
                'configs_value' => '2',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => '2018-11-26 09:10:55',
                'updated_at' => '2018-11-26 09:10:55',
            ),
            15 => 
            array (
                'id' => 16,
                'configs_name' => 'bank_greenplaza',
                'configs_value' => '/BRI/Praditya/222222222222/1/,/BCA/Praditya/1111111111/1/',
                'configs_status' => 1,
                'configs_note' => '#/Bank Name/Owner/NO/Status/<br/>
#Status 0.non active, 1.active',
                'created_at' => NULL,
                'updated_at' => '2018-11-29 08:41:47',
            ),
            16 => 
            array (
                'id' => 17,
                'configs_name' => 'price_percent_profit',
                'configs_value' => '0.00',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'configs_name' => 'price_profit_admin',
                'configs_value' => '70',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'configs_name' => 'price_pajak_cw_bonus',
                'configs_value' => '0',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'configs_name' => 'price_pajak_admin',
                'configs_value' => '10',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'configs_name' => 'price_persen_dana_charity',
                'configs_value' => '0',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'configs_name' => 'price_kurs_pin_code',
                'configs_value' => '5000',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'configs_name' => 'price_kurs_hot_list',
                'configs_value' => '50',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'configs_name' => 'price_profit_admin',
                'configs_value' => '70',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'configs_name' => 'price_profit_developer',
                'configs_value' => '30',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'configs_name' => 'price_alokasi_bonus_pin_code',
                'configs_value' => '20',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'configs_name' => 'price_alokasi_bonus_hot_list',
                'configs_value' => '20',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'configs_name' => 'price_alokasi_bonus_saldo_iklan',
                'configs_value' => '20',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'configs_name' => 'price_save_claim_saldo_iklan',
                'configs_value' => '50',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'configs_name' => 'price_iklan_baris',
                'configs_value' => '100000',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'configs_name' => 'price_iklan_banner',
                'configs_value' => '250000',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'configs_name' => 'price_iklan_banner_khusus',
                'configs_value' => '300000',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'configs_name' => 'price_iklan_slider',
                'configs_value' => '200000',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'configs_name' => 'konfigurasi_superadmin_id',
                'configs_value' => '1',
                'configs_status' => 1,
                'configs_note' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}