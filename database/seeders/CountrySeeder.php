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
        $file = fopen(storage_path('storage/app/csv/nazioni.csv'), 'r');
        
        // Salta l'header
        fgetcsv($file);
        
        while (($data = fgetcsv($file)) !== false) {
            Country::create([
                'country_id' => $data[0],
                'name' => $data[1],
                'continent' => $data[2],
                'iso_char2' => $data[3],
                'iso_char3' => $data[4],
                'phone_prefix' => $data[5]
            ]);
        }
        
        fclose($file);
    }
}
