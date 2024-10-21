<?php

namespace Database\Seeders;

use App\Models\View;
use Illuminate\Database\Seeder;


class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        View::create([
            'user_id' => 1,
            'content_id' => 1,
            'content_type' => 'movie',
            'view_date' => now(),
        ]);

        View::create([
            'user_id' => 3,
            'content_id' => 1,
            'content_type' => 'episode',
            'view_date' => now(),
        ]);

        View::create([
            'user_id' => 4,
            'content_id' => 1,
            'content_type' => 'tvserie',
            'view_date' => now(),
        ]);


        View::create([
            'user_id' => 1,
            'content_id' => 1,
            'content_type' => 'movie',
            'view_date' => now(),
        ]);
    }
}
