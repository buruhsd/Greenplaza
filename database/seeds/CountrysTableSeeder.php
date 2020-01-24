<?php

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
        $country = new Country();
  		$country->country_id = 0;
  		$country->country_name = "Indonesia";
  		$country->save();

  		$country = new Country();
  		$country->country_id = 108;
  		$country->country_name = "Malaysia";
  		$country->save();


    }
}
