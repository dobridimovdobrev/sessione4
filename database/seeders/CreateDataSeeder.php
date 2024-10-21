<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TvSerie;
use App\Models\Season;
use App\Models\Episode;
use App\Models\Person;
use App\Models\ContentPerson;
use App\Models\Trailer;
use App\Models\VideoFile;
use App\Models\ImageFile;

class CreateDataSeeder extends Seeder
{
    public function run(): void
    {
        // Define the TV series data with 3 series as an example
        $tvSeries = [
            [
                'title' => 'The Mandalorian',
                'description' => 'A lone bounty hunter traverses the galaxy, taking dangerous missions and facing off with deadly foes.',
                'year' => 2019,
                'imdb_rating' => 8.8,
                'category_id' => 2,
                'status' => 'published',
                'seasons' => [
                    [
                        'season_number' => 1,
                        'total_episodes' => 5,
                        'year' => 2019,
                        'premiere_date' => '2019-11-12',
                        'episodes' => [
                            ['title' => 'The Mandalorian', 'description' => 'The Mandalorian begins his journey with a dangerous mission.', 'episode_number' => 1, 'duration' => 45],
                            ['title' => 'The Child', 'description' => 'The Mandalorian becomes the guardian of a mysterious child.', 'episode_number' => 2, 'duration' => 48],
                            // More episodes...
                        ],
                        'trailer' => 'https://example.com/the-mandalorian-season1-trailer.mp4',
                        'video_file' => 'https://example.com/the-mandalorian-season1.mp4',
                        'image' => 'https://example.com/the-mandalorian-season1-poster.jpg',
                    ],
                    // More seasons...
                ],
                'actors' => [1, 3, 5],
            ],
            [
                'title' => 'Breaking Bad',
                'description' => 'A high school chemistry teacher turns to the drug trade to support his family.',
                'year' => 2008,
                'imdb_rating' => 9.5,
                'category_id' => 3,
                'status' => 'published',
                'seasons' => [
                    [
                        'season_number' => 1,
                        'total_episodes' => 5,
                        'year' => 2008,
                        'premiere_date' => '2008-01-20',
                        'episodes' => [
                            ['title' => 'Pilot', 'description' => 'Walter White makes a life-altering decision to start manufacturing drugs.', 'episode_number' => 1, 'duration' => 55],
                            // More episodes...
                        ],
                        'trailer' => 'https://example.com/breaking-bad-season1-trailer.mp4',
                        'video_file' => 'https://example.com/breaking-bad-season1.mp4',
                        'image' => 'https://example.com/breaking-bad-season1-poster.jpg',
                    ],
                    // More seasons...
                ],
                'actors' => [2, 4],
            ],
            // Add more TV series in the same way
        ];

        // Process TV series and their relationships
        foreach ($tvSeries as $tvData) {
            // No 'duration' field here anymore
            $tvSerie = TvSerie::create([
                'title' => $tvData['title'],
                'description' => $tvData['description'],
                'year' => $tvData['year'],
                'imdb_rating' => $tvData['imdb_rating'],
                'category_id' => $tvData['category_id'],
                'status' => $tvData['status'],
            ]);

            foreach ($tvData['seasons'] as $seasonData) {
                $season = Season::create([
                    'tv_series_id' => $tvSerie->tv_series_id,
                    'season_number' => $seasonData['season_number'],
                    'total_episodes' => $seasonData['total_episodes'],
                    'year' => $seasonData['year'],
                    'premiere_date' => $seasonData['premiere_date'],
                ]);

                foreach ($seasonData['episodes'] as $episodeData) {
                    Episode::create([
                        'season_id' => $season->season_id,
                        'title' => $episodeData['title'],
                        'description' => $episodeData['description'],
                        'episode_number' => $episodeData['episode_number'],
                        'duration' => $episodeData['duration'],
                    ]);
                }

                // Add trailer
                Trailer::create([
                    'url' => $seasonData['trailer'],
                    'content_id' => $season->season_id,
                    'content_type' => 'season',
                ]);

                // Add video file
                VideoFile::create([
                    'url' => $seasonData['video_file'],
                    'content_id' => $season->season_id,
                    'content_type' => 'season',
                    'format' => 'mp4',
                    'size' => 100000000,
                    'resolution' => '1080p',
                    'duration' => 60 * $seasonData['total_episodes'], // Assuming each episode is ~60 minutes
                ]);

                // Add image file
                ImageFile::create([
                    'url' => $seasonData['image'],
                    'title' => "{$tvSerie->title} Season {$season->season_number} Poster",
                    'description' => "Official poster for {$tvSerie->title} Season {$season->season_number}.",
                    'content_id' => $season->season_id,
                    'content_type' => 'season',
                    'format' => 'jpg',
                    'size' => 500000,
                    'width' => 1920,
                    'height' => 1080,
                ]);
            }

            // Associate actors with the TV series
            foreach ($tvData['actors'] as $actorId) {
                ContentPerson::create([
                    'content_id' => $tvSerie->tv_series_id,
                    'content_type' => 'tvseries',
                    'person_id' => $actorId,
                ]);
            }
        }
    }
}



        // Define actors
       /*  $persons = [
            ['name' => "Bryan Cranston"],
            ['name' => "Aaron Paul"],
            ['name' => "Scarlett Johansson"],
            ['name' => "Henry Cavill"],
            ['name' => "Emilia Clarke"],
            ['name' => "Pedro Pascal"],
            ['name' => "Millie Bobby Brown"],
            ['name' => "David Harbour"],
            ['name' => "Tom Hiddleston"],
            ['name' => "Chris Hemsworth"],
        ];

        foreach ($persons as $personData) {
            Person::create($personData);
        }

        // Define TV series with seasons, episodes, trailers, video files, image files, and actors
        $tvSeries = [
            [
                'title' => 'Stranger Things',
                'description' => 'A group of kids uncover strange events in their small town while battling supernatural forces. They encounter a mysterious girl with supernatural powers. Together, they must stop the sinister forces threatening their town.',
                'year' => 2016,
                'duration' => 45,
                'imdb_rating' => 8.7,
                'category_id' => 1,
                'status' => 'published',
                'total_seasons' => [
                    [
                        'season_number' => 1,
                        'total_episodes' => 5,
                        'year' => 2016,
                        'premiere_date' => '2016-07-15',
                        'episodes' => [
                            ['title' => 'The Vanishing of Will Byers', 'description' => 'A boy goes missing in the small town of Hawkins. His friends begin to search for him, uncovering dark secrets along the way.', 'episode_number' => 1, 'duration' => 55],
                            ['title' => 'The Weirdo on Maple Street', 'description' => 'The friends meet a strange girl with powers who might know what happened to Will. More mysterious events unfold.', 'episode_number' => 2, 'duration' => 50],
                            ['title' => 'Holly, Jolly', 'description' => 'The kids begin to suspect that more is going on in Hawkins than they thought. Joyce believes she has made contact with Will.', 'episode_number' => 3, 'duration' => 55],
                            ['title' => 'The Body', 'description' => 'A body is discovered, but the truth might be darker than anyone imagines. The kids uncover more about Eleven\'s powers.', 'episode_number' => 4, 'duration' => 60],
                            ['title' => 'The Flea and the Acrobat', 'description' => 'The kids learn about parallel dimensions and realize that something terrible is lurking there.', 'episode_number' => 5, 'duration' => 58],
                        ],
                        'trailer' => 'https://example.com/stranger-things-season1-trailer.mp4',
                        'video_file' => 'https://example.com/stranger-things-season1.mp4',
                        'image' => 'https://example.com/stranger-things-season1-poster.jpg',
                    ],
                    [
                        'season_number' => 2,
                        'total_episodes' => 5,
                        'year' => 2017,
                        'premiere_date' => '2017-10-27',
                        'episodes' => [
                            ['title' => 'MADMAX', 'description' => 'The kids are back, but new threats emerge in Hawkins. The town is still haunted by the events of last year.', 'episode_number' => 1, 'duration' => 54],
                            ['title' => 'Trick or Treat, Freak', 'description' => 'It\'s Halloween in Hawkins, but the kids realize that things are far from normal as they deal with dangerous new threats.', 'episode_number' => 2, 'duration' => 52],
                            ['title' => 'The Pollywog', 'description' => 'Dustin discovers a strange new creature, and the group works together to figure out what it is.', 'episode_number' => 3, 'duration' => 57],
                            ['title' => 'Will the Wise', 'description' => 'Will\'s connection to the Upside Down grows stronger, causing the group to fear what\'s coming.', 'episode_number' => 4, 'duration' => 55],
                            ['title' => 'Dig Dug', 'description' => 'Hopper goes on a dangerous mission to uncover the truth about what\'s beneath Hawkins.', 'episode_number' => 5, 'duration' => 58],
                        ],
                        'trailer' => 'https://example.com/stranger-things-season2-trailer.mp4',
                        'video_file' => 'https://example.com/stranger-things-season2.mp4',
                        'image' => 'https://example.com/stranger-things-season2-poster.jpg',
                    ],
                    [
                        'season_number' => 3,
                        'total_episodes' => 5,
                        'year' => 2019,
                        'premiere_date' => '2019-07-04',
                        'episodes' => [
                            ['title' => 'Suzie, Do You Copy?', 'description' => 'The gang faces new dangers as they uncover a sinister plot tied to the Russians and the Upside Down.', 'episode_number' => 1, 'duration' => 55],
                            ['title' => 'The Mall Rats', 'description' => 'The new mall in Hawkins becomes the center of attention as strange things begin happening again.', 'episode_number' => 2, 'duration' => 52],
                            ['title' => 'The Case of the Missing Lifeguard', 'description' => 'A local lifeguard goes missing, and the group starts to investigate.', 'episode_number' => 3, 'duration' => 60],
                            ['title' => 'The Sauna Test', 'description' => 'The gang tries to prove that a dangerous entity is controlling some of the residents.', 'episode_number' => 4, 'duration' => 57],
                            ['title' => 'The Battle of Starcourt', 'description' => 'The season concludes with a dramatic battle at the Starcourt Mall as the Upside Down invades.', 'episode_number' => 5, 'duration' => 61],
                        ],
                        'trailer' => 'https://example.com/stranger-things-season3-trailer.mp4',
                        'video_file' => 'https://example.com/stranger-things-season3.mp4',
                        'image' => 'https://example.com/stranger-things-season3-poster.jpg',
                    ],
                ],
                'actors' => [1, 2, 9, 10], // Associating actors by ID
            ],
            // Add 6 more TV series below, following the same structure as above...
            // Each with unique descriptions, seasons, episodes, and associations to actors.
        ];

        foreach ($tvSeries as $tvData) {
            $tvSerie = TvSerie::create([
                'title' => $tvData['title'],
                'description' => $tvData['description'],
                'year' => $tvData['year'],
                'duration' => $tvData['duration'],
                'imdb_rating' => $tvData['imdb_rating'],
                'category_id' => $tvData['category_id'],
                'status' => $tvData['status'],
            ]);

            foreach ($tvData['total_seasons'] as $seasonData) {
                $season = Season::create([
                    'tv_series_id' => $tvSerie->tv_series_id,
                    'season_number' => $seasonData['season_number'],
                    'total_episodes' => $seasonData['total_episodes'],
                    'year' => $seasonData['year'],
                    'premiere_date' => $seasonData['premiere_date'],
                ]);

                foreach ($seasonData['episodes'] as $episodeData) {
                    Episode::create([
                        'season_id' => $season->season_id,
                        'title' => $episodeData['title'],
                        'description' => $episodeData['description'],
                        'episode_number' => $episodeData['episode_number'],
                        'duration' => $episodeData['duration'],
                        'status' => 'published',
                    ]);
                }

                // Create associated trailer for the season
                Trailer::create([
                    'url' => $seasonData['trailer'],
                    'content_id' => $season->season_id,
                    'content_type' => 'season',
                ]);

                // Create associated video file for the season
                VideoFile::create([
                    'url' => $seasonData['video_file'],
                    'content_id' => $season->season_id,
                    'content_type' => 'season',
                    'format' => 'mp4',
                    'size' => 100000000,
                    'resolution' => '1080p',
                    'duration' => 60 * $seasonData['total_episodes'], // Assuming each episode is ~60 minutes
                ]);

                // Create associated image file for the season
                ImageFile::create([
                    'url' => $seasonData['image'],
                    'title' => "{$tvSerie->title} Season {$season->season_number} Poster",
                    'description' => "Official poster for {$tvSerie->title} Season {$season->season_number}.",
                    'content_id' => $season->season_id,
                    'content_type' => 'season',
                    'format' => 'jpg',
                    'size' => 500000,
                    'width' => 1920,
                    'height' => 1080,
                ]);
            }

            // Associate actors with the TV series
            foreach ($tvData['actors'] as $actorId) {
                ContentPerson::create([
                    'content_id' => $tvSerie->tv_series_id,
                    'content_type' => 'tv_series',
                    'person_id' => $actorId,
                ]);
            }
        } */
