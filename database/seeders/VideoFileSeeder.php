<?php

namespace Database\Seeders;

use App\Models\VideoFile;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VideoFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VideoFile::create([
            'url' => 'https://example.com/breakingbad-trailer.mp4',
            'content_id' => 1,
            'content_type' => 'tvseries',
            'format' => 'mp4',
            'size' => 50000000,
            'resolution' => '1080p',
            'duration' => '02:30',
        ]);
    }
}
