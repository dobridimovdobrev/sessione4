<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Services\TMDBTVImportService;
use Illuminate\Console\Command;

class ImportTVSeriesByCategory extends Command
{
    protected $signature = 'tmdb:import-tv {count=1 : Numero di serie TV per categoria}';
    protected $description = 'Importa un numero specifico di serie TV per ogni categoria';

    public function handle(TMDBTVImportService $tmdb)
    {
        $categories = Category::all();
        $count = $this->argument('count');
        
        $this->info("\n=== Inizio importazione di {$count} serie TV per ogni categoria ===\n");
        
        $totalSeries = 0;
        
        foreach ($categories as $category) {
            $this->info("\n>> Categoria: {$category->name}");
            
            try {
                $series = $tmdb->importByGenre($category->category_id, $count, function($step, $total, $message) {
                    $this->info("   Progresso: {$step}/{$total} - {$message}");
                });
                
                $totalSeries += count($series);
                $this->info("✓ Completato: " . count($series) . " serie TV importate per {$category->name}\n");
                
            } catch (\Exception $e) {
                $this->error("✗ Errore per {$category->name}: " . $e->getMessage() . "\n");
                continue;
            }
        }
        
        $this->info("\n=== Importazione completata! Totale serie TV importate: {$totalSeries} ===");
    }
}
