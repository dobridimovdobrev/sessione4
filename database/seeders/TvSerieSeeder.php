<?php

namespace Database\Seeders;

use App\Models\Season;
use App\Models\Episode;
use App\Models\TvSerie;
use Illuminate\Database\Seeder;

class TvSerieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Breaking Bad TV series
        $breakingBad = TvSerie::create([
            'title' => 'Breaking Bad',
            'description' => 'A high school chemistry teacher turned methamphetamine manufacturer.',
            'year' => 2008,
            'duration' => 45,
            'imdb_rating' => 9.5,
            'total_seasons' => 5,
            'premiere_date' => '2008-01-20',
            'status' => 'published',
            'category_id' => 1
        ]);

        // Create Season 1 for Breaking Bad
        $season1 = Season::create([
            'season_number' => 1,
            'total_episodes' => 7,
            'year' => 2008,
            'premiere_date' => '2008-01-20',
            'tv_series_id' => $breakingBad->tv_series_id  
        ]);

           // Create Episodes for Season 1
           Episode::create([
            'title' => 'Pilot',
            'slug' => 'pilot',
            'description' => 'Walter White begins his life of crime as a meth producer...',
            'episode_number' => 1,
            'duration' => 58,
            'status' => 'published',
            'season_id' => $season1->season_id,
        ]);

        Episode::create([
            'title' => 'Cat’s in the Bag...',
            'slug' => 'cats-in-the-bag',
            'description' => 'Walter and Jesse face problems with disposing of the bodies...',
            'episode_number' => 2,
            'duration' => 48,
            'status' => 'published',
            'season_id' => $season1->season_id,
        ]);

        Episode::create([
            'title' => '...And the Bag’s in the River',
            'slug' => 'and-the-bags-in-the-river',
            'description' => 'Walter is faced with a tough decision regarding Krazy-8...',
            'episode_number' => 3,
            'duration' => 48,
            'status' => 'published',
            'season_id' => $season1->season_id,
        ]);
    }
}
