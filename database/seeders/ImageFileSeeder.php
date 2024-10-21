<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Trailer;
use App\Models\VideoFile;
use App\Models\ImageFile;
use Illuminate\Database\Seeder;


class ImageFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $contentFiles = [
            'onward' => [
                'trailer' => 'https://example.com/onward-trailer.mp4',
                'video_file' => 'https://example.com/onward-movie.mp4',
                'image' => 'https://example.com/onward-poster.jpg'
            ],
            'tenet' => [
                'trailer' => 'https://example.com/tenet-trailer.mp4',
                'video_file' => 'https://example.com/tenet-movie.mp4',
                'image' => 'https://example.com/tenet-poster.jpg'
            ],
            'bad-boys-for-life' => [
                'trailer' => 'https://example.com/bad-boys-for-life-trailer.mp4',
                'video_file' => 'https://example.com/bad-boys-for-life-movie.mp4',
                'image' => 'https://example.com/bad-boys-for-life-poster.jpg'
            ],
            'the-invisible-man' => [
                'trailer' => 'https://example.com/the-invisible-man-trailer.mp4',
                'video_file' => 'https://example.com/the-invisible-man-movie.mp4',
                'image' => 'https://example.com/the-invisible-man-poster.jpg'
            ],
            'american-murder-the-family-next-door' => [
                'trailer' => 'https://example.com/american-murder-trailer.mp4',
                'video_file' => 'https://example.com/american-murder-movie.mp4',
                'image' => 'https://example.com/american-murder-poster.jpg'
            ],
            'the-half-of-it' => [
                'trailer' => 'https://example.com/the-half-of-it-trailer.mp4',
                'video_file' => 'https://example.com/the-half-of-it-movie.mp4',
                'image' => 'https://example.com/the-half-of-it-poster.jpg'
            ],
            'greyhound' => [
                'trailer' => 'https://example.com/greyhound-trailer.mp4',
                'video_file' => 'https://example.com/greyhound-movie.mp4',
                'image' => 'https://example.com/greyhound-poster.jpg'
            ],
            'news-of-the-world' => [
                'trailer' => 'https://example.com/news-of-the-world-trailer.mp4',
                'video_file' => 'https://example.com/news-of-the-world-movie.mp4',
                'image' => 'https://example.com/news-of-the-world-poster.jpg'
            ],
            'the-witcher-nightmare-of-the-wolf' => [
                'trailer' => 'https://example.com/the-witcher-nightmare-trailer.mp4',
                'video_file' => 'https://example.com/the-witcher-nightmare-movie.mp4',
                'image' => 'https://example.com/the-witcher-nightmare-poster.jpg'
            ],
            'the-grudge' => [
                'trailer' => 'https://example.com/the-grudge-trailer.mp4',
                'video_file' => 'https://example.com/the-grudge-movie.mp4',
                'image' => 'https://example.com/the-grudge-poster.jpg'
            ],
            'soul' => [
                'trailer' => 'https://example.com/soul-trailer.mp4',
                'video_file' => 'https://example.com/soul-movie.mp4',
                'image' => 'https://example.com/soul-poster.jpg'
            ],
            'wonder-woman-1984' => [
                'trailer' => 'https://example.com/wonder-woman-1984-trailer.mp4',
                'video_file' => 'https://example.com/wonder-woman-1984-movie.mp4',
                'image' => 'https://example.com/wonder-woman-1984-poster.jpg'
            ],
            'palm-springs' => [
                'trailer' => 'https://example.com/palm-springs-trailer.mp4',
                'video_file' => 'https://example.com/palm-springs-movie.mp4',
                'image' => 'https://example.com/palm-springs-poster.jpg'
            ],
            'the-call-of-the-wild' => [
                'trailer' => 'https://example.com/the-call-of-the-wild-trailer.mp4',
                'video_file' => 'https://example.com/the-call-of-the-wild-movie.mp4',
                'image' => 'https://example.com/the-call-of-the-wild-poster.jpg'
            ],
            'extraction' => [
                'trailer' => 'https://example.com/extraction-trailer.mp4',
                'video_file' => 'https://example.com/extraction-movie.mp4',
                'image' => 'https://example.com/extraction-poster.jpg'
            ],
            'the-trial-of-the-chicago-7' => [
                'trailer' => 'https://example.com/the-trial-of-the-chicago-7-trailer.mp4',
                'video_file' => 'https://example.com/the-trial-of-the-chicago-7-movie.mp4',
                'image' => 'https://example.com/the-trial-of-the-chicago-7-poster.jpg'
            ],
        ];

        foreach ($contentFiles as $slug => $files) {
            $movie = Movie::where('slug', $slug)->first();

            if ($movie) {
                // Associate the trailer
                Trailer::create([
                    
                    'url' => $files['trailer'],
                    'content_id' => $movie->movie_id,
                    'content_type' => 'movie',
                ]);

                // Associate the video file
                VideoFile::create([
                    
                    'url' => $files['video_file'],
                    'content_id' => $movie->movie_id,
                    'content_type' => 'movie',
                    'format' => 'mp4',
                    'size' => 50000000, // Example size in bytes
                    'resolution' => '1080p',
                    'duration' => $movie->duration,
                ]);

                // Associate the image file
                ImageFile::create([
                    'url' => $files['image'],
                    'title' => "{$movie->title} Poster",
                    'description' => "Official poster for {$movie->title}.",
                    'content_id' => $movie->movie_id,
                    'content_type' => 'movie',
                    'format' => 'jpg',
                    'size' => 500000, // Example size in bytes
                    'width' => 1920,
                    'height' => 1080,
                ]);
            }
        }
    }
}
