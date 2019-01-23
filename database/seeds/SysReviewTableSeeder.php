<?php

use Illuminate\Database\Seeder;

class SysReviewTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_review')->delete();
        
        \DB::table('sys_review')->insert(array (
            0 => 
            array (
                'id' => 1,
                'review_produk_id' => 1,
                'review_user_id' => 3,
                'review_status' => 1,
                'review_text' => 'centongnya bagus sekali bapak fahmi.',
                'created_at' => '2019-01-15 10:21:03',
                'updated_at' => '2019-01-15 10:21:03',
            ),
        ));
        
        
    }
}