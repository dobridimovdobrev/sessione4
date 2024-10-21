<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csv = storage_path('app/csv/nazioni.csv');
        $file = fopen($csv, 'r');
        while(($data = fgetcsv($file, 0, ',')) !== false){  
            Country::create([
                'country_id' => $data[0],
                'name' => $data[1],
                'continent' => $data[2],
                'iso_char2' => $data[3],
                'iso_char3' => $data[4],
                'phone_prefix' => $data[5]
            ]);
        }

        
    }
}


