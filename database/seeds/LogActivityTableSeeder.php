<?php

use Illuminate\Database\Seeder;

class LogActivityTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('log_activity')->delete();
        
        
        
    }
}