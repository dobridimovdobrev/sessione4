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
        $categories = [
            ['category_id' => 1, 'name' => 'action', 'slug' => 'action'],
            ['category_id' => 2, 'name' => 'comedy', 'slug' => 'comedy'],
            ['category_id' => 3, 'name' => 'adventure', 'slug' => 'adventure'],
            ['category_id' => 4, 'name' => 'thriller', 'slug' => 'thriller'],
            ['category_id' => 5, 'name' => 'crime', 'slug' => 'crime'],
            ['category_id' => 6, 'name' => 'drama', 'slug' => 'drama'],
            ['category_id' => 7, 'name' => 'documentary', 'slug' => 'documentary'],
            ['category_id' => 8, 'name' => 'horror', 'slug' => 'horror'],
            ['category_id' => 9, 'name' => 'romance', 'slug' => 'romance'],
            ['category_id' => 10, 'name' => 'war', 'slug' => 'war'],
            ['category_id' => 11, 'name' => 'western', 'slug' => 'western'],
            ['category_id' => 12, 'name' => 'fantasy', 'slug' => 'fantasy'],
            ['category_id' => 13, 'name' => 'family', 'slug' => 'family'],
            ['category_id' => 14, 'name' => 'animation', 'slug' => 'animation']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
