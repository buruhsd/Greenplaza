<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'superadmin',
                'label' => 'sp',
                'created_at' => '2018-11-13 12:56:49',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'admin',
                'label' => 'adm',
                'created_at' => '2018-11-13 12:56:59',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'member',
                'label' => 'mbr',
                'created_at' => '2018-11-13 12:57:15',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}