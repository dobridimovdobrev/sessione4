<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\CleanDatabaseSeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\PermissionSeeder;
use Database\Seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CleanDatabaseSeeder::class,  // Prima puliamo il database
            CountrySeeder::class,        // Poi aggiungiamo i dati essenziali
            RoleSeeder::class,
            PermissionSeeder::class,
            CategorySeeder::class
        ]);
    }
}
