<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['country_id' => 1, 'name' => 'Bulgaria', 'continent' => 'Europe', 'iso_char2' => 'BG', 'iso_char3' => 'BGR', 'phone_prefix' => '+359'],
            ['country_id' => 2, 'name' => 'Italy', 'continent' => 'Europe', 'iso_char2' => 'IT', 'iso_char3' => 'ITA', 'phone_prefix' => '+39'],
            ['country_id' => 3, 'name' => 'United States', 'continent' => 'North America', 'iso_char2' => 'US', 'iso_char3' => 'USA', 'phone_prefix' => '+1'],
            ['country_id' => 4, 'name' => 'United Kingdom', 'continent' => 'Europe', 'iso_char2' => 'GB', 'iso_char3' => 'GBR', 'phone_prefix' => '+44'],
            ['country_id' => 5, 'name' => 'Germany', 'continent' => 'Europe', 'iso_char2' => 'DE', 'iso_char3' => 'DEU', 'phone_prefix' => '+49'],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}
