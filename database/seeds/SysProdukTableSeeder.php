<?php

use Illuminate\Database\Seeder;

class SysProdukTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_produk')->delete();
        
        \DB::table('sys_produk')->insert(array (
            0 => 
            array (
                'id' => 1,
                'produk_seller_id' => 3,
                'produk_category_id' => 8,
                'produk_brand_id' => 1,
                'produk_name' => 'Centong',
                'produk_slug' => 'gandor-centong',
                'produk_unit' => 2,
                'produk_price' => '2000.00000000',
                'produk_size' => 's,m,l',
                'produk_length' => '200.00',
                'produk_wide' => '100.00',
                'produk_color' => '#ffffff',
                'produk_stock' => 999999,
                'produk_weight' => 40,
                'produk_discount' => '0.00',
                'produk_location' => 1,
                'produk_image' => '15-Jan-2019_09-50-36_Or4zQ.jpg',
                'produk_viewer' => 0,
                'produk_status' => 1,
                'produk_user_status' => 3,
                'produk_is_best' => 0,
                'produk_is_hot' => 0,
                'produk_hotlist' => 0,
                'produk_note' => 'centong, preorder',
                'created_at' => '2019-01-15 09:50:37',
                'updated_at' => '2019-01-15 09:50:37',
            ),
        ));
        
        
    }
}