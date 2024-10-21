<?php

namespace Database\Seeders;

use App\Models\Like;
use Illuminate\Database\Seeder;


class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Like::create([
            'user_id' => 1,
            'content_id' => 1,
            'content_type' => 'movie',
        ]);

        Like::create([
            'user_id' => 3,
            'content_id' => 4,
            'content_type' => 'movie',
        ]);

        Like::create([
            'user_id' => 1,
            'content_id' => 2,
            'content_type' => 'movie',
        ]);

        Like::create([
            'user_id' => 4,
            'content_id' => 1,
            'content_type' => 'tvseries',
        ]);
    }
}
