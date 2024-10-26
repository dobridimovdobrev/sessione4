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
                "category_id" => 10,
                "title" => "News of the World",
                "description" => "A Civil War veteran embarks on a journey across Texas to return a young girl to her relatives, encountering challenges and rediscovering his own humanity.",
                "year" => 2020,
                "duration" => 118,
                "imdb_rating" => 6.8,
                "status" => "published",
                "slug" => "news-of-the-world",
                "persons" => [11, 12], // Robert De Niro, Al Pacino
                "trailers" => [
                    ['url' => 'https://example.com/news-of-the-world-trailer.mp4']
                ],
                "video_files" => [
                    ['url' => 'https://example.com/news-of-the-world.mp4', 'format' => 'mp4', 'size' => 12000000]
                ],
                "image_files" => [
                    ['url' => 'https://example.com/news-of-the-world.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "movie_id" => 2,
                "category_id" => 11,
                "title" => "The Witcher: Nightmare of the Wolf",
                "description" => "Vesemir escapes poverty to become a witcher and kill monsters for coin, but a new menace rises. The story delves into the origins of the Witcher universe.",
                "year" => 2020,
                "duration" => 81,
                "imdb_rating" => 7.5,
                "status" => "published",
                "slug" => "the-witcher-nightmare-of-the-wolf",
                "persons" => [13, 14], // Leonardo DiCaprio, Tom Hanks
                "trailers" => [
                    ['url' => 'https://example.com/the-witcher-trailer.mp4']
                ],
                "video_files" => [
                    ['url' => 'https://example.com/the-witcher.mp4', 'format' => 'mp4', 'size' => 15000000]
                ],
                "image_files" => [
                    ['url' => 'https://example.com/the-witcher.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "movie_id" => 3,
                "category_id" => 13,
                "title" => "The Grudge",
                "description" => "A detective investigates a murder scene that has a connection to a supernatural curse. The curse spreads and haunts anyone who dares to enter the cursed house.",
                "year" => 2020,
                "duration" => 94,
                "imdb_rating" => 4.3,
                "status" => "published",
                "slug" => "the-grudge",
                "persons" => [15, 16], // Johnny Depp, Brad Pitt
                "trailers" => [
                    ['url' => 'https://example.com/the-grudge-trailer.mp4']
                ],
                "video_files" => [
                    ['url' => 'https://example.com/the-grudge.mp4', 'format' => 'mp4', 'size' => 9000000]
                ],
                "image_files" => [
                    ['url' => 'https://example.com/the-grudge.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "category_id" => 14,
                "title" => "Soul",
                "description" => "A musician who's lost his passion for music is transported out of his body and must find his way back with the help of a young soul learning about life.",
                "year" => 2020,
                "duration" => 100,
                "imdb_rating" => 8.1,
                "status" => "published",
                "slug" => "soul",
                "persons" => [17, 18], // Denzel Washington, Matt Damon
                "trailers" => [
                    ['url' => 'https://example.com/soul-trailer.mp4']
                ],
                "video_files" => [
                    ['url' => 'https://example.com/soul.mp4', 'format' => 'mp4', 'size' => 11000000]
                ],
                "image_files" => [
                    ['url' => 'https://example.com/soul.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "category_id" => 1,
                "title" => "Wonder Woman 1984",
                "description" => "Diana Prince comes into conflict with the Soviet Union during the Cold War in the 1980s. The film sees Wonder Woman battle villains in a colorful, retro setting.",
                "year" => 2020,
                "duration" => 151,
                "imdb_rating" => 5.4,
                "status" => "published",
                "slug" => "wonder-woman-1984",
                "persons" => [19, 20], // Morgan Freeman, Clint Eastwood
                "trailers" => [
                    ['url' => 'https://example.com/wonder-woman-trailer.mp4']
                ],
                "video_files" => [
                    ['url' => 'https://example.com/wonder-woman.mp4', 'format' => 'mp4', 'size' => 16000000]
                ],
                "image_files" => [
                    ['url' => 'https://example.com/wonder-woman.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "category_id" => 2,
                "title" => "Palm Springs",
                "description" => "Stuck in a time loop, two wedding guests develop a budding romance as they relive the same day over and over. The film blends romance with sci-fi elements.",
                "year" => 2020,
                "duration" => 90,
                "imdb_rating" => 7.4,
                "status" => "published",
                "slug" => "palm-springs",
                "persons" => [21, 22], // Will Smith, Christian Bale
                "trailers" => [
                    ['url' => 'https://example.com/palm-springs-trailer.mp4']
                ],
                "video_files" => [
                    ['url' => 'https://example.com/palm-springs.mp4', 'format' => 'mp4', 'size' => 9000000]
                ],
                "image_files" => [
                    ['url' => 'https://example.com/palm-springs.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "category_id" => 3,
                "title" => "The Call of the Wild",
                "description" => "A domesticated dog embarks on an adventure in the Yukon during the Klondike Gold Rush. As the dog adapts to wilderness life, it learns to embrace its wild nature.",
                "year" => 2020,
                "duration" => 100,
                "imdb_rating" => 6.8,
                "status" => "published",
                "slug" => "the-call-of-the-wild",
                "persons" => [23, 24], // Robert Downey Jr., Chris Hemsworth
                "trailers" => [
                    ['url' => 'https://example.com/the-call-of-the-wild-trailer.mp4']
                ],
                "video_files" => [
                    ['url' => 'https://example.com/the-call-of-the-wild.mp4', 'format' => 'mp4', 'size' => 10000000]
                ],
                "image_files" => [
                    ['url' => 'https://example.com/the-call-of-the-wild.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "category_id" => 4,
                "title" => "Extraction",
                "description" => "A black ops mercenary must rescue the kidnapped son of an international crime lord. As he battles his way through adversaries, he confronts his own demons.",
                "year" => 2020,
                "duration" => 116,
                "imdb_rating" => 6.7,
                "status" => "published",
                "slug" => "extraction",
                "persons" => [25, 26], // Chris Evans, Scarlett Johansson
                "trailers" => [
                    ['url' => 'https://example.com/extraction-trailer.mp4']
                ],
                "video_files" => [
                    ['url' => 'https://example.com/extraction.mp4', 'format' => 'mp4', 'size' => 12000000]
                ],
                "image_files" => [
                    ['url' => 'https://example.com/extraction.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "category_id" => 5,
                "title" => "The Trial of the Chicago 7",
                "description" => "The story of seven individuals charged with conspiracy and inciting a riot during the 1968 Democratic National Convention. The film focuses on the courtroom drama and political turbulence.",
                "year" => 2020,
                "duration" => 130,
                "imdb_rating" => 7.8,
                "status" => "published",
                "slug" => "the-trial-of-the-chicago-7",
                "persons" => [27, 28], // Natalie Portman, Julia Roberts
                "trailers" => [
                    ['url' => 'https://example.com/the-trial-of-the-chicago-7-trailer.mp4']
                ],
                "video_files" => [
                    ['url' => 'https://example.com/the-trial-of-the-chicago-7.mp4', 'format' => 'mp4', 'size' => 14000000]
                ],
                "image_files" => [
                    ['url' => 'https://example.com/the-trial-of-the-chicago-7.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "category_id" => 3,
                "title" => "Onward",
                "description" => "Two brothers embark on a magical quest to bring their father back for one day. They encounter magical creatures and learn valuable lessons about life and family. Along the way, their bond strengthens as they face challenges.",
                "year" => 2020,
                "duration" => 102,
                "imdb_rating" => 7.4,
                "status" => "published",
                "slug" => "onward",
                "persons" => [1, 2, 3], // Example: Sylvester Stallone, Bruce Lee, Mike Tyson
                "trailers" => [
                    ['url' => 'https://example.com/onward-trailer.mp4']
                ],
                "video_files" => [
                    ['url' => 'https://example.com/onward.mp4', 'format' => 'mp4', 'size' => 10000000]
                ],
                "image_files" => [
                    ['url' => 'https://example.com/onward.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "category_id" => 4,
                "title" => "Tenet",
                "description" => "A secret agent embarks on a time-bending mission to prevent the start of World War III. Armed with one word—Tenet—he must navigate through a twilight world of international espionage. The film challenges concepts of time, perception, and loyalty.",
                "year" => 2020,
                "duration" => 150,
                "imdb_rating" => 7.5,
                "status" => "published",
                "slug" => "tenet",
                "persons" => [107, 108, 109], // Example: Tom Holland, John David Washington, Robert Pattinson
                "trailers" => [
                    ['url' => 'https://example.com/tenet-trailer.mp4']
                ],
                "video_files" => [
                    ['url' => 'https://example.com/tenet.mp4', 'format' => 'mp4', 'size' => 20000000]
                ],
                "image_files" => [
                    ['url' => 'https://example.com/tenet.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "category_id" => 5,
                "title" => "Bad Boys for Life",
                "description" => "The wife and son of a Mexican drug lord embark on a vengeful quest. Two Miami detectives must face their old foes, confronting danger and personal turmoil along the way. As their past catches up to them, they must make a choice: justice or revenge.",
                "year" => 2020,
                "duration" => 124,
                "imdb_rating" => 7.2,
                "status" => "published",
                "slug" => "bad-boys-for-life",
                "persons" => [110, 111], // Example: Martin Lawrence, Elisabeth Moss
                "trailers" => [
                    ['url' => 'https://example.com/bad-boys-for-life-trailer.mp4']
                ],
                "video_files" => [
                    ['url' => 'https://example.com/bad-boys-for-life.mp4', 'format' => 'mp4', 'size' => 18000000]
                ],
                "image_files" => [
                    ['url' => 'https://example.com/bad-boys-for-life.jpg', 'format' => 'jpg', 'size' => 600000]
                ]
            ],
            [
                "category_id" => 6,
                "title" => "The Invisible Man",
                "description" => "A woman believes she's being hunted by her abusive ex-boyfriend who has become invisible. She fights to prove that she's being terrorized, but no one believes her. As the mystery unfolds, she realizes that the greatest threat might be her own mind.",
                "year" => 2020,
                "duration" => 124,
                "imdb_rating" => 7.1,
                "status" => "published",
                "slug" => "the-invisible-man",
                "persons" => [112, 113], // Example: Shanann Watts, Leah Lewis
                "trailers" => [
                    ['url' => 'https://example.com/the-invisible-man-trailer.mp4']
                ],
                "video_files" => [
                    ['url' => 'https://example.com/the-invisible-man.mp4', 'format' => 'mp4', 'size' => 15000000]
                ],
                "image_files" => [
                    ['url' => 'https://example.com/the-invisible-man.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            [
                "category_id" => 7,
                "title" => "American Murder: The Family Next Door",
                "description" => "Using raw, firsthand footage, this documentary examines the disappearance of Shanann Watts and her children. The story explores the disturbing events that led to their tragic deaths and the psychological toll it took on those involved.",
                "year" => 2020,
                "duration" => 83,
                "imdb_rating" => 7.2,
                "status" => "published",
                "slug" => "american-murder",
                "persons" => [112, 114], // Example: Shanann Watts, Daniel Diemer
                "trailers" => [
                    ['url' => 'https://example.com/american-murder-trailer.mp4']
                ],
                "video_files" => [
                    ['url' => 'https://example.com/american-murder.mp4', 'format' => 'mp4', 'size' => 9000000]
                ],
                "image_files" => [
                    ['url' => 'https://example.com/american-murder.jpg', 'format' => 'jpg', 'size' => 400000]
                ]
            ],
            // Additional movies...
            [
                "category_id" => 8,
                "title" => "The Half of It",
                "description" => "A shy, introverted student helps the school jock woo a girl whom, secretly, they both want. The story explores love, friendship, and identity, and how sometimes, the most important lessons are those we learn about ourselves.",
                "year" => 2020,
                "duration" => 104,
                "imdb_rating" => 7.0,
                "status" => "published",
                "slug" => "the-half-of-it",
                "persons" => [115, 116], // Example: Helena Zengel, Theo James
                "trailers" => [
                    ['url' => 'https://example.com/the-half-of-it-trailer.mp4']
                ],
                "video_files" => [
                    ['url' => 'https://example.com/the-half-of-it.mp4', 'format' => 'mp4', 'size' => 14000000]
                ],
                "image_files" => [
                    ['url' => 'https://example.com/the-half-of-it.jpg', 'format' => 'jpg', 'size' => 600000]
                ]
            ],
            [
                "category_id" => 9,
                "title" => "Greyhound",
                "description" => "In the early days of World War II, an inexperienced U.S. Navy captain must lead an Allied convoy through dangerous waters. As the battle intensifies, the captain must make decisions that will determine the fate of his crew and the convoy.",
                "year" => 2020,
                "duration" => 91,
                "imdb_rating" => 7.0,
                "status" => "published",
                "slug" => "greyhound",
                "persons" => [117, 118], // Example: Andrea Riseborough, Jamie Foxx
                "trailers" => [
                    ['url' => 'https://example.com/greyhound-trailer.mp4']
                ],
                "video_files" => [
                    ['url' => 'https://example.com/greyhound.mp4', 'format' => 'mp4', 'size' => 12000000]
                ],
                "image_files" => [
                    ['url' => 'https://example.com/greyhound.jpg', 'format' => 'jpg', 'size' => 500000]
                ]
            ],
            // More movies...
        ];

        foreach ($movies as $movieData) {
            // Create the movie
            $movie = Movie::create([
                'category_id' => $movieData['category_id'],
                'title' => $movieData['title'],
                'description' => $movieData['description'],
                'year' => $movieData['year'],
                'duration' => $movieData['duration'],
                'imdb_rating' => $movieData['imdb_rating'],
                'status' => $movieData['status']
            ]);

            // Attach persons (actors) to the movie
            if (!empty($movieData['persons'])) {
                $movie->persons()->sync($movieData['persons']);
            }

            // Attach trailers to the movie
            if (!empty($movieData['trailers'])) {
                foreach ($movieData['trailers'] as $trailerData) {
                    $trailer = Trailer::create($trailerData);
                    $movie->trailers()->attach($trailer->trailer_id);
                }
            }

            // Attach video files to the movie
            if (!empty($movieData['video_files'])) {
                foreach ($movieData['video_files'] as $videoFileData) {
                    $videoFile = VideoFile::create($videoFileData);
                    $movie->videoFiles()->attach($videoFile->video_file_id);
                }
            }

            // Attach image files to the movie
            if (!empty($movieData['image_files'])) {
                foreach ($movieData['image_files'] as $imageFileData) {
                    $imageFile = ImageFile::create($imageFileData);
                    $movie->imageFiles()->attach($imageFile->image_id);
                }
            }
        }
    }
}
