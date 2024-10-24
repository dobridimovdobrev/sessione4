<?php

namespace Database\Seeders;

use App\Models\Trailer;
use Illuminate\Database\Seeder;


class TrailerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Trailer::create([
           
            'url' => 'https://example.com/breakingbad-trailer.mp4',
            'content_id' => 1, // This refers to the TV Series ID or Movie ID
            'content_type' => 'tvseries', // You can also use 'movie' for movies
        ]);

        Trailer::create([
            
            'url' => 'https://example.com/inception-trailer.mp4',
            'content_id' => 2, // This refers to the movie ID
            'content_type' => 'movie',
        ]);
    }
}
