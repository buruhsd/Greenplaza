<?php

use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_user')->delete();
        
        \DB::table('role_user')->insert(array (
            0 => 
            array (
                'role_id' => 1,
                'user_id' => 1,
            ),
            1 => 
            array (
                'role_id' => 2,
                'user_id' => 2,
            ),
            2 => 
            array (
                'role_id' => 3,
                'user_id' => 3,
            ),
            3 => 
            array (
                'role_id' => 3,
                'user_id' => 4,
            ),
            4 => 
            array (
                'role_id' => 3,
                'user_id' => 7,
            ),
        ));
        
        
    }
}