<?php

namespace Database\Seeders;

use App\Models\Episode;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EpisodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Episode::create([
            'season_id' => 1,
            'title' => 'Pilot',
            'description' => 'A high school chemistry teacher turned meth manufacturer...',
            'episode_number' => 1,
            'duration' => 58,
            'status' => 'published',
        ]);
    }
}
