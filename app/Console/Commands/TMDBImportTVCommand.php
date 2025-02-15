<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TMDBTVImportService;
use Exception;

class TMDBImportTVCommand extends Command
{
    protected $signature = 'tmdb:import-tv {count=1 : Numero di serie TV da importare per categoria} {--series-id= : ID specifico di una serie TV da importare}';
    protected $description = 'Importa serie TV da TMDB per ogni categoria';

    protected $tvService;

    public function __construct(TMDBTVImportService $tvService)
    {
        parent::__construct();
        $this->tvService = $tvService;
    }

    public function handle()
    {
        // Se è specificato un ID serie, importa solo quella
        if ($seriesId = $this->option('series-id')) {
            $this->info("\n=== Test importazione serie TV ID: {$seriesId} ===\n");
            
            try {
                $series = $this->tvService->importTvSeries($seriesId);
                $this->info("Serie TV importata con successo: " . $series->title);
                return;
            } catch (\Exception $e) {
                $this->error("Errore durante l'importazione: " . $e->getMessage());
                $this->error($e->getTraceAsString());
                return;
            }
        }

        // Altrimenti procedi con l'importazione normale
        $count = $this->argument('count');
        
        // Crea le categorie se non esistono
        $this->info("\n=== Creazione categorie ===\n");
        $categories = [
            1 => 'Action & Adventure',
            2 => 'Comedy',
            3 => 'Adventure',
            4 => 'Thriller',
            5 => 'Crime',
            6 => 'Drama',
            7 => 'Documentary',
            8 => 'Romance',
            9 => 'War & Politics',
            10 => 'Western',
            11 => 'Fantasy',
            12 => 'Family',
            13 => 'Horror',
            14 => 'Animation'
        ];

        foreach ($categories as $id => $name) {
            try {
                \App\Models\Category::firstOrCreate(
                    ['category_id' => $id],
                    [
                        'name' => $name,
                        'slug' => \Illuminate\Support\Str::slug($name)
                    ]
                );
                $this->info("Categoria creata: {$name}");
            } catch (\Exception $e) {
                $this->error("Errore creazione categoria {$name}: " . $e->getMessage());
                return;
            }
        }

        $this->info("\n=== Inizio importazione di {$count} serie TV per ogni categoria ===\n");

        foreach ($categories as $categoryId => $name) {
            $this->info("\n>> Categoria: " . $this->getCategoryName($categoryId));
            
            try {
                $this->importByCategory($categoryId);
            } catch (Exception $e) {
                $this->error("Errore durante l'importazione per la categoria {$categoryId}: " . $e->getMessage());
            }
        }

        $this->info("\n=== Importazione completata ===\n");
    }

    protected function importByCategory($categoryId)
    {
        try {
            $this->tvService->importByGenre($categoryId, 1, function($current, $total, $message) {
                $this->line("   Progresso: {$current}/{$total} - {$message}");
            });
        } catch (\Exception $e) {
            $this->error("Errore durante l'importazione per la categoria {$categoryId}: " . $e->getMessage());
        }
    }

    protected function getCategoryName($id)
    {
        $categories = [
            1 => 'action',
            2 => 'comedy',
            3 => 'adventure',
            4 => 'thriller',
            5 => 'crime',
            6 => 'drama',
            7 => 'documentary',
            8 => 'romance',
            9 => 'war & politics',
            10 => 'western',
            11 => 'fantasy',
            12 => 'family',
            13 => 'horror',
            14 => 'animation'
        ];

        return $categories[$id] ?? 'unknown';
    }
}
