<?php

namespace App\Console\Commands;

use App\Models\TvSerie;
use App\Models\ImageFile;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class UpdateTVSeriesImages extends Command
{
    protected $signature = 'tv:update-images';
    protected $description = 'Aggiorna le immagini di stagioni ed episodi per le serie TV esistenti';

    protected $client;
    protected $apiKey;
    protected $imageBaseUrl = 'https://image.tmdb.org/t/p/';

    public function __construct()
    {
        parent::__construct();
        $this->apiKey = config('services.tmdb.api_key');
        $this->client = new Client([
            'base_uri' => 'https://api.themoviedb.org/3/',
            'timeout' => 10.0,
        ]);
    }

    public function handle()
    {
        $series = TvSerie::all();
        $total = $series->count();
        
        $this->info("Aggiornamento immagini per {$total} serie TV...");
        
        foreach ($series as $index => $tvSeries) {
            $this->info("\n[" . ($index + 1) . "/{$total}] Aggiornamento {$tvSeries->title}");
            
            try {
                if (!$tvSeries->tmdb_id) {
                    $this->warn("Serie TV {$tvSeries->title} non ha tmdb_id, salto...");
                    continue;
                }

                // Ottieni dettagli serie
                $response = $this->client->get("tv/{$tvSeries->tmdb_id}", [
                    'query' => [
                        'api_key' => $this->apiKey,
                        'language' => 'en-US'
                    ]
                ]);
                
                $seriesData = json_decode($response->getBody(), true);

                // Aggiorna immagini stagioni
                foreach ($tvSeries->seasons as $season) {
                    $this->info("Aggiornamento stagione {$season->season_number}");
                    
                    $seasonResponse = $this->client->get("tv/{$tvSeries->tmdb_id}/season/{$season->season_number}", [
                        'query' => [
                            'api_key' => $this->apiKey,
                            'language' => 'en-US'
                        ]
                    ]);
                    
                    $seasonData = json_decode($seasonResponse->getBody(), true);
                    
                    if (!empty($seasonData['poster_path'])) {
                        $posterImage = $this->downloadAndSaveImage($seasonData['poster_path'], 'poster', "{$tvSeries->title} Season {$season->season_number}");
                        if ($posterImage) {
                            $image = ImageFile::create($posterImage);
                            $season->imageFiles()->attach($image->image_id);
                            $this->info("✓ Poster stagione {$season->season_number}");
                        }
                    }

                    // Aggiorna immagini episodi
                    foreach ($season->episodes as $episode) {
                        foreach ($seasonData['episodes'] as $epData) {
                            if ($epData['episode_number'] == $episode->episode_number) {
                                if (!empty($epData['still_path'])) {
                                    $stillImage = $this->downloadAndSaveImage($epData['still_path'], 'still', $epData['name']);
                                    if ($stillImage) {
                                        $image = ImageFile::create($stillImage);
                                        $episode->imageFiles()->attach($image->image_id);
                                        $this->info("✓ Still episodio {$episode->episode_number}");
                                    }
                                }
                                break;
                            }
                        }
                    }
                }

            } catch (\Exception $e) {
                $this->error("Errore per {$tvSeries->title}: " . $e->getMessage());
                Log::error($e);
                continue;
            }
        }

        $this->info("\nAggiornamento completato!");
    }

    protected function downloadAndSaveImage($path, $type, $title)
    {
        try {
            if (empty($path)) {
                return null;
            }

            // Usa w500 per poster e w300 per still
            $size = $type === 'still' ? 'w300' : 'w500';
            $url = $this->imageBaseUrl . $size . $path;
            
            // Genera nome file
            $filename = \Str::slug($title) . '-' . \Str::random(10) . '.jpg';
            $fullPath = 'images/' . $type . '/' . $filename;
            
            // Scarica e salva
            $imageContent = file_get_contents($url);
            if ($imageContent === false) {
                throw new \Exception("Impossibile scaricare l'immagine da: " . $url);
            }
            
            // Crea directory
            $directory = storage_path('app/public/images/' . $type);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            
            // Salva
            \Storage::disk('public')->put($fullPath, $imageContent);
            
            // Dimensioni
            $imageSize = getimagesize(storage_path('app/public/' . $fullPath));
            
            return [
                'url' => 'https://api.dobridobrev.com/storage/' . $fullPath,
                'title' => $title,
                'description' => $type === 'poster' ? "Season poster for {$title}" : "Episode still for {$title}",
                'format' => 'jpg',
                'size' => \Storage::disk('public')->size($fullPath),
                'width' => $imageSize[0],
                'height' => $imageSize[1]
            ];

        } catch (\Exception $e) {
            Log::error("Errore download immagine: " . $e->getMessage());
            return null;
        }
    }
}
