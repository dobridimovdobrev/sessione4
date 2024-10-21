<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'action',
            'slug' => 'action'
        ]);

        Category::create([
            'name' => 'comedy',
            'slug' => 'comedy'
        ]);

        Category::create([
            'name' => 'adventure',
            'slug' => 'adventure'
        ]);

        Category::create([
            'name' => 'thriller',
            'slug' => 'thriller'
        ]);

        Category::create([
            'name' => 'crime',
            'slug' => 'crime'
        ]);

        Category::create([
            'name' => 'drama',
            'slug' => 'drama'
        ]);

        Category::create([
            'name' => 'documentary',
            'slug' => 'documentary'
        ]);

        Category::create([
            'name' => 'romance',
            'slug' => 'romance'
        ]);

        Category::create([
            'name' => 'war',
            'slug' => 'war'
        ]);

        Category::create([
            'name' => 'western',
            'slug' => 'western'
        ]);

        Category::create([
            'name' => 'fantasy',
            'slug' => 'fantasy'
        ]);

        Category::create([
            'name' => 'family',
            'slug' => 'family'
        ]);

        Category::create([
            'name' => 'horror',
            'slug' => 'horror'
        ]);

        Category::create([
            'name' => 'animation',
            'slug' => 'animation'
        ]);
    }
}
