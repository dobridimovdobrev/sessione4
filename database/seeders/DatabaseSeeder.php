<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Disabilita i controlli delle foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Svuota le tabelle se esistono
        $tables = ['roles', 'categories', 'countries'];
        foreach ($tables as $table) {
            if (Schema::hasTable($table)) {
                DB::table($table)->truncate();
            }
        }

        // Popola le tabelle base (senza foreign key)
        $this->call([
            RoleSeeder::class,        // Prima i ruoli
            CategorySeeder::class,    // Poi le categorie
            CountrySeeder::class,     // Infine i paesi
        ]);

        // Riabilita i controlli delle foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
