<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Database\Seeders\ImageFileSeeder;




class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
          /* CountrySeeder::class,
             RoleSeeder::class, 
             PermissionSeeder::class, 
             CategorySeeder::class, 
             MovieSeeder::class, 
            TvSerieSeeder::class,
            ViewSeeder::class,
            NotificationSeeder::class,
            SeasonSeeder::class,
            EpisodeSeeder::class,
            LikeSeeder::class, 
            PersonSeeder::class,
            CreditSeeder::class,
             TrailerSeeder::class,
            ImageFileSeeder::class
            VideoFileSeeder::class */
            CreateDataSeeder::class

        ]);
    }
}
