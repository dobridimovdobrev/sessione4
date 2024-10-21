<?php

namespace Database\Seeders;

use App\Models\ContentPerson;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContentPersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ContentPerson::create([
            'content_id' => 1,
            'content_type' => 'movie',
            'person_id' => 1,  // Bryan Cranston
        ]);

        ContentPerson::create([
            'content_id' => 2,
            'content_type' => 'tv_series',
            'person_id' => 2,  // Aaron Paul
        ]);
    }
}
