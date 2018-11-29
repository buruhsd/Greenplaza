<?php

use Illuminate\Database\Seeder;

class Conf_bankTableSeeder extends Seeder
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
				'bank_kode' => 'BRI',
				'bank_name' => 'Bank Rakyat Indonesia',
				'bank_status' => 1,
				'bank_note' => NULL,
			],
			[
				'bank_kode' => 'BCA',
				'bank_name' => 'Bank Central Asia',
				'bank_status' => 1,
				'bank_note' => NULL
			],
			[
				'bank_kode' => 'Mandiri',
				'bank_name' => 'Mandiri',
				'bank_status' => 1,
				'bank_note' => NULL
			],
			[
				'bank_kode' => 'BNI',
				'bank_name' => 'Bank Negara Indonesia',
				'bank_status' => 1,
				'bank_note' => NULL
			],
			[
				'bank_kode' => 'BTN',
				'bank_name' => 'Bank Tabungan Negara',
				'bank_status' => 1,
				'bank_note' => NULL
			],
			[
				'bank_kode' => 'BMT',
				'bank_name' => 'Bank Mandiri Taspen',
				'bank_status' => 1,
				'bank_note' => NULL
			];
		);
    }
}
