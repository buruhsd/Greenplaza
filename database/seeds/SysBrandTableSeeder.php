<?php

use Illuminate\Database\Seeder;

class SysBrandTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_brand')->delete();
        
        \DB::table('sys_brand')->insert(array (
            0 => 
            array (
                'id' => 1,
                'brand_name' => 'Greenplaza',
                'brand_status' => 0,
                'brand_user_status' => 0,
                'brand_seller_id' => 0,
                'brand_admin_id' => 0,
                'brand_superadmin_id' => 0,
                'brand_image' => '17-Jan-2019_03-46-16_307Ol.png',
                'brand_slug' => 'greenplaza',
                'brand_note' => 'Greenplaza',
                'created_at' => '2019-01-17 03:46:16',
                'updated_at' => '2019-01-17 03:46:16',
            ),
            1 => 
            array (
                'id' => 2,
                'brand_name' => 'Lenovo',
                'brand_status' => 0,
                'brand_user_status' => 3,
                'brand_seller_id' => 3,
                'brand_admin_id' => 0,
                'brand_superadmin_id' => 0,
                'brand_image' => '15-Jan-2019_09-41-16_qZKwY.png',
                'brand_slug' => 'lenovo',
                'brand_note' => 'lenovo',
                'created_at' => '2019-01-15 09:41:16',
                'updated_at' => '2019-01-15 09:41:16',
            ),
        ));
        
        
    }
}