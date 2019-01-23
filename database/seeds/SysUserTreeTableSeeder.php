<?php

use Illuminate\Database\Seeder;

class SysUserTreeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('sys_user_tree')->delete();
        
        \DB::table('sys_user_tree')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_tree_user_id' => 1,
                'user_tree_sponsor_id' => 1,
                'created_at' => '2019-01-15 03:22:10',
                'updated_at' => '2019-01-15 03:22:10',
            ),
            1 => 
            array (
                'id' => 2,
                'user_tree_user_id' => 2,
                'user_tree_sponsor_id' => 1,
                'created_at' => '2019-01-15 03:40:48',
                'updated_at' => '2019-01-15 03:40:48',
            ),
            2 => 
            array (
                'id' => 3,
                'user_tree_user_id' => 3,
                'user_tree_sponsor_id' => 1,
                'created_at' => '2019-01-15 03:55:54',
                'updated_at' => '2019-01-15 03:55:54',
            ),
        ));
        
        
    }
}