<?php

use Illuminate\Database\Seeder;

class Conf_configsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		\App\Models\Bank::create(
			[
				'configs_name' => 'profil_address',
				'configs_value' => 'jl.meranti no 314 Semarang',
				'configs_status' => 1,
				'configs_note' => NULL,
			],
			[
				'configs_name' => 'profil_phone',
				'configs_value' => '08xxxxxxxx',
				'configs_status' => 1,
				'configs_note' => NULL,
			],
			[
				'configs_name' => 'profil_pin_bb',
				'configs_value' => 'GHJK45',
				'configs_status' => 1,
				'configs_note' => NULL,
			],
			[
				'configs_name' => 'profil_email',
				'configs_value' => 'greenplaza@greenplaza.com',
				'configs_status' => 1,
				'configs_note' => NULL,
			],
			[
				'configs_name' => 'profil_facebook_group',
				'configs_value' => 'http://facebook.com/groups/greenplaza',
				'configs_status' => 1,
				'configs_note' => NULL,
			],
			[
				'configs_name' => 'profil_twitter',
				'configs_value' => 'http://twitter.com/nama_twitter',
				'configs_status' => 1,
				'configs_note' => NULL,
			],
			[
				'configs_name' => 'profil_google_plus',
				'configs_value' => 'http://plus.google.com/+greenplaza',
				'configs_status' => 1,
				'configs_note' => NULL,
			],
			[
				'configs_name' => 'profil_instagram',
				'configs_value' => 'http://instagram.com/greenplaza',
				'configs_status' => 1,
				'configs_note' => NULL,
			],
			[
				'configs_name' => 'profil_youtube',
				'configs_value' => 'http://youtube.com/user/greenplaza',
				'configs_status' => 1,
				'configs_note' => NULL,
			],
			[
				'configs_name' => 'transaksi_durasi_checkout',
				'configs_value' => '2',
				'configs_status' => 1,
				'configs_note' => NULL,
			],
			[
				'configs_name' => 'transaksi_durasi_seller_tunggu',
				'configs_value' => '3',
				'configs_status' => 1,
				'configs_note' => NULL,
			],
			[
				'configs_name' => 'transaksi_durasi_shipping',
				'configs_value' => '14',
				'configs_status' => 1,
				'configs_note' => NULL,
			],
			[
				'configs_name' => 'transaksi_durasi_seller_sanggup',
				'configs_value' => '5',
				'configs_status' => 1,
				'configs_note' => NULL,
			],
			[
				'configs_name' => 'transaksi_durasi_beli_hot_list',
				'configs_value' => '2',
				'configs_status' => 1,
				'configs_note' => NULL,
			],
			[
				'configs_name' => 'transaksi_durasi_beli_pin_code',
				'configs_value' => '2',
				'configs_status' => 1,
				'configs_note' => NULL,
			],
			[
				'configs_name' => 'bank_greenplaza',
				'configs_value' => '-/BRI/Praditya/222222222222/1/,-/BCA/Praditya/1111111111/1/',
				'configs_status' => 1,
				'configs_note' => NULL,
			],
		);
    }
}
