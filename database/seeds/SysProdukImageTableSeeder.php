<?php

use Illuminate\Database\Seeder;

class SysProdukImageTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_produk_image')->delete();
        
        \DB::table('sys_produk_image')->insert(array (
            0 => 
            array (
                'id' => 1,
                'produk_image_produk_id' => 1,
                'produk_image_image' => '15-Jan-2019_09-50-36_Or4zQ.jpg',
                'created_at' => '2019-01-15 09:50:37',
                'updated_at' => '2019-01-15 09:50:37',
            ),
            1 => 
            array (
                'id' => 2,
                'produk_image_produk_id' => 1,
                'produk_image_image' => '15-Jan-2019_09-50-37_ljM07.jpg',
                'created_at' => '2019-01-15 09:50:37',
                'updated_at' => '2019-01-15 09:50:37',
            ),
        ));
        
        
    }
}