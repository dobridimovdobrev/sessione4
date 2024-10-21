<?php

namespace Database\Seeders;

use App\Models\ImageFile;
use Illuminate\Database\Seeder;


class ImageFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ImageFile::create([
            'url' => 'https://example.com/breakingbad-poster.jpg',
            'title' => 'Breaking Bad Poster',
            'description' => 'Official poster for Breaking Bad season 1.',
            'content_id' => 1,
            'content_type' => 'tvseries',
            'format' => 'jpg',
            'size' => 500000,
            'width' => 1920,
            'height' => 1080,
        ]);
    }
}
