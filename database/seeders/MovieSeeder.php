<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Trailer;
use App\Models\ImageFile;
use App\Models\VideoFile;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $movies = [
            [
                "movie_id" => 1,
                "category_id" => 1, // Action
                "title" => "News of the World",
                "description" => "A Civil War veteran embarks on a journey across Texas to return a young girl to her relatives, encountering challenges and rediscovering his own humanity.",
                "year" => 2020,
                "duration" => 118,
                "imdb_rating" => 6.8,
                "status" => "published",
                "premiere_date" => "2020-12-25",
                "slug" => "news-of-the-world",
                "persons" => [11, 12],
                "trailers" => [
                    ['url' => 'https://example.com/news-of-the-world-trailer.mp4', 'title' => 'News of the World - Trailer']
                ],
                "image_files" => [
                    ['url' => 'https://example.com/news-of-the-world.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "movie_id" => 2,
                "category_id" => 2, // Comedy
                "title" => "The Witcher: Nightmare of the Wolf",
                "description" => "Vesemir escapes poverty to become a witcher and kill monsters for coin, but a new menace rises. The story delves into the origins of the Witcher universe.",
                "year" => 2020,
                "duration" => 81,
                "imdb_rating" => 7.5,
                "status" => "published",
                "premiere_date" => "2020-08-23",
                "slug" => "the-witcher-nightmare-of-the-wolf",
                "persons" => [13, 14],
                "trailers" => [
                    ['url' => 'https://example.com/witcher-trailer.mp4', 'title' => 'The Witcher - Trailer']
                ],
                "image_files" => [
                    ['url' => 'https://example.com/witcher.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "movie_id" => 3,
                "category_id" => 3, // Drama
                "title" => "The Grudge",
                "description" => "A detective investigates a murder scene that has a connection to a supernatural curse. The curse spreads and haunts anyone who dares to enter the cursed house.",
                "year" => 2020,
                "duration" => 94,
                "imdb_rating" => 4.3,
                "status" => "published",
                "premiere_date" => "2020-01-03",
                "slug" => "the-grudge",
                "persons" => [15, 16],
                "trailers" => [
                    ['url' => 'https://example.com/the-grudge-trailer.mp4', 'title' => 'The Grudge - Trailer']
                ],
                "image_files" => [
                    ['url' => 'https://example.com/the-grudge.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "movie_id" => 4,
                "category_id" => 4, // Horror
                "title" => "Soul",
                "description" => "A musician who's lost his passion for music is transported out of his body and must find his way back with the help of a young soul learning about life.",
                "year" => 2020,
                "duration" => 100,
                "imdb_rating" => 8.1,
                "status" => "published",
                "premiere_date" => "2020-12-25",
                "slug" => "soul",
                "persons" => [17, 18],
                "trailers" => [
                    ['url' => 'https://example.com/soul-trailer.mp4', 'title' => 'Soul - Trailer']
                ],
                "image_files" => [
                    ['url' => 'https://example.com/soul.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "movie_id" => 5,
                "category_id" => 5, // Thriller
                "title" => "Wonder Woman 1984",
                "description" => "Diana Prince comes into conflict with the Soviet Union during the Cold War in the 1980s. The film sees Wonder Woman battle villains in a colorful, retro setting.",
                "year" => 2020,
                "duration" => 151,
                "imdb_rating" => 5.4,
                "status" => "published",
                "premiere_date" => "2020-12-25",
                "slug" => "wonder-woman-1984",
                "persons" => [19, 20],
                "trailers" => [
                    ['url' => 'https://example.com/wonder-woman-trailer.mp4', 'title' => 'Wonder Woman 1984 - Trailer']
                ],
                "image_files" => [
                    ['url' => 'https://example.com/wonder-woman.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "movie_id" => 6,
                "category_id" => 6, // Sci-Fi
                "title" => "Palm Springs",
                "description" => "Stuck in a time loop, two wedding guests develop a budding romance as they relive the same day over and over. The film blends romance with sci-fi elements.",
                "year" => 2020,
                "duration" => 90,
                "imdb_rating" => 7.4,
                "status" => "published",
                "premiere_date" => "2020-07-10",
                "slug" => "palm-springs",
                "persons" => [21, 22],
                "trailers" => [
                    ['url' => 'https://example.com/palm-springs-trailer.mp4', 'title' => 'Palm Springs - Trailer']
                ],
                "image_files" => [
                    ['url' => 'https://example.com/palm-springs.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "movie_id" => 7,
                "category_id" => 7, // Adventure
                "title" => "The Call of the Wild",
                "description" => "A domesticated dog embarks on an adventure in the Yukon during the Klondike Gold Rush. As the dog adapts to wilderness life, it learns to embrace its wild nature.",
                "year" => 2020,
                "duration" => 100,
                "imdb_rating" => 6.8,
                "status" => "published",
                "premiere_date" => "2020-02-21",
                "slug" => "the-call-of-the-wild",
                "persons" => [23, 24],
                "trailers" => [
                    ['url' => 'https://example.com/the-call-of-the-wild-trailer.mp4', 'title' => 'The Call of the Wild - Trailer']
                ],
                "image_files" => [
                    ['url' => 'https://example.com/the-call-of-the-wild.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "movie_id" => 8,
                "category_id" => 8, // Mystery
                "title" => "Extraction",
                "description" => "A black ops mercenary must rescue the kidnapped son of an international crime lord. As he battles his way through adversaries, he confronts his own demons.",
                "year" => 2020,
                "duration" => 116,
                "imdb_rating" => 6.7,
                "status" => "published",
                "premiere_date" => "2020-04-24",
                "slug" => "extraction",
                "persons" => [25, 26],
                "trailers" => [
                    ['url' => 'https://example.com/extraction-trailer.mp4', 'title' => 'Extraction - Trailer']
                ],
                "image_files" => [
                    ['url' => 'https://example.com/extraction.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ]
        ];

        foreach ($movies as $movieData) {
            $persons = $movieData['persons'];
            $trailers = $movieData['trailers'];
            $imageFiles = $movieData['image_files'];

            unset($movieData['persons'], $movieData['trailers'], $movieData['image_files']);

            $movie = Movie::create($movieData);

            // Collega i trailer
            foreach ($trailers as $trailerData) {
                $trailer = Trailer::create($trailerData);
                $movie->trailers()->attach($trailer->trailer_id);
            }

            // Collega le immagini
            foreach ($imageFiles as $imageData) {
                $image = ImageFile::create($imageData);
                $movie->imageFiles()->attach($image->image_id);
            }
        }
    }
}
