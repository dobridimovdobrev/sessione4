<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TMDBImportService;
use App\Models\Category;

class ImportMoviesByCategory extends Command
{
    protected $signature = 'tmdb:import-by-category {count=30 : Numero di film per categoria}';
    protected $description = 'Importa un numero specifico di film per ogni categoria';

    public function handle(TMDBImportService $tmdb)
    {
        $categories = Category::all();
        $count = $this->argument('count');
        
        $this->info("\n=== Inizio importazione di {$count} film per ogni categoria ===\n");
        
        $totalMovies = 0;
        
        foreach ($categories as $category) {
            $this->info("\n>> Categoria: {$category->name}");
            
            try {
                $movies = $tmdb->importMoviesByCategory($category->category_id, $count, function($step, $total, $message) {
                    $this->info("   Progresso: {$step}/{$total} - {$message}");
                });
                
                $totalMovies += count($movies);
                $this->info("✓ Completato: " . count($movies) . " film importati per {$category->name}\n");
                
            } catch (\Exception $e) {
                $this->error("✗ Errore per {$category->name}: " . $e->getMessage() . "\n");
                continue;
            }
        }
        
        $this->info("\n=== Importazione completata! Totale film importati: {$totalMovies} ===");
    }
}
