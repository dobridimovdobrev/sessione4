<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TMDBImportService;
use Illuminate\Support\Facades\Log;

class ImportTMDBMovies extends Command
{
    protected $signature = 'tmdb:import-movies {count=10}';
    protected $description = 'Importa film popolari da TMDB';

    public function handle(TMDBImportService $tmdbService)
    {
        try {
            $count = $this->argument('count');
            $this->info("Iniziando l'importazione di {$count} film...");

            $movies = $tmdbService->importPopularMovies($count);
            
            if (empty($movies)) {
                $this->error("Nessun film importato. Controlla i log per i dettagli.");
                return 1;
            }
            
            $this->info('Importazione completata con successo!');
            $this->table(
                ['ID', 'Titolo', 'Anno', 'Immagini', 'Trailer'],
                collect($movies)->map(function ($movie) {
                    return [
                        $movie->movie_id,
                        $movie->title,
                        $movie->year,
                        $movie->imageFiles->count() . ' immagini',
                        $movie->trailers->count() . ' trailer'
                    ];
                })
            );

            return 0;
        } catch (\Exception $e) {
            $this->error("Errore durante l'importazione: " . $e->getMessage());
            Log::error("Errore nel comando di importazione: " . $e->getMessage());
            Log::error($e->getTraceAsString());
            return 1;
        }
    }
}
