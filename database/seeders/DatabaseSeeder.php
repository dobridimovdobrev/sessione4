<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Database\Seeders\LikeSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\ViewSeeder;
use Database\Seeders\MovieSeeder;
use Database\Seeders\CreditSeeder;
use Database\Seeders\PersonSeeder;
use Database\Seeders\SeasonSeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\EpisodeSeeder;
use Database\Seeders\TrailerSeeder;
use Database\Seeders\TvSerieSeeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\ImageFileSeeder;
use Database\Seeders\VideoFileSeeder;
use MovieSeeder as GlobalMovieSeeder;
use Database\Seeders\CreateDataSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\NotificationSeeder;

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
             CreateDataSeeder::class
             VideoFileSeeder::class */
             MovieSeeder::class

        ]);
    }
}
