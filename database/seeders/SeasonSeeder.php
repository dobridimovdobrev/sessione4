<?php

namespace Database\Seeders;

use App\Models\Season;
use Illuminate\Database\Seeder;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Season::create([
            'season_number' => 1,
            'total_episodes' => 7,
            'year' => 2008,
            'premiere_date' => '2008-01-20',
            'tv_series_id' => 1,
        ]);
    }
}
