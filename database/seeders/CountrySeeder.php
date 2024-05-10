<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use  App\Models\Country;
class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $country = new  Country;
      //  $country->country="Argentina";
      //  $country->save();
      //  Country::create([
      //    'country' => "India"
      //  ]);
      $country->country= "Thailand";
        $country->save();
    }
}
