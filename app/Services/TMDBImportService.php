<?php

namespace App\Services;

use App\Models\Movie;
use App\Models\Person;
use App\Models\Trailer;
use App\Models\ImageFile;
use App\Models\VideoFile;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Exception;
use Illuminate\Support\Facades\DB;

class TMDBImportService
{
    protected $client;
    protected $apiKey;
    protected $imageBaseUrl = 'https://image.tmdb.org/t/p/';
    protected $genreMap = [
        28 => 1,     // Action
        35 => 2,     // Comedy
        12 => 3,     // Adventure
        53 => 4,     // Thriller
        80 => 5,     // Crime
        18 => 6,     // Drama
        99 => 7,     // Documentary
        10749 => 8,  // Romance
        10752 => 9,  // War
        37 => 10,    // Western
        14 => 11,    // Fantasy
        10751 => 12, // Family
        27 => 13,    // Horror
        16 => 14     // Animation
    ];

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.themoviedb.org/3/',
            'timeout'  => 10.0,
        ]);
        $this->apiKey = config('services.tmdb.api_key');
        
        if (empty($this->apiKey)) {
            throw new Exception('TMDB API key non configurata. Aggiungi TMDB_API_KEY nel file .env');
        }
    }

    protected function mapGenreToCategory($genres)
    {
        if (empty($genres)) {
            return 1; // Default to Action if no genres
        }

        // Prendi il primo genere che corrisponde alla nostra mappa
        foreach ($genres as $genre) {
            if (isset($this->genreMap[$genre['id']])) {
                return $this->genreMap[$genre['id']];
            }
        }

        return 1; // Default to Action if no matching genre
    }

    public function importMovie($tmdbId)
    {
        try {
            Log::info("=== INIZIO IMPORTAZIONE FILM ID: " . $tmdbId . " ===");

            // Ottieni i dettagli del film
            $response = $this->client->get("movie/{$tmdbId}", [
                'query' => [
                    'api_key' => $this->apiKey,
                    'append_to_response' => 'videos,credits,images',
                    'language' => 'en-US',
                    'include_image_language' => 'en,null'
                ]
            ]);
            
            $movieData = json_decode($response->getBody(), true);
            
            // Log dettagliato dei dati ricevuti
            Log::info("Dati film ricevuti:", [
                'title' => $movieData['title'],
                'release_date' => $movieData['release_date'],
                'runtime' => $movieData['runtime'],
                'vote_average' => $movieData['vote_average'],
                'poster_path' => $movieData['poster_path'],
                'backdrop_path' => $movieData['backdrop_path'],
                'cast_count' => isset($movieData['credits']['cast']) ? count($movieData['credits']['cast']) : 0,
                'videos_count' => isset($movieData['videos']['results']) ? count($movieData['videos']['results']) : 0,
                'images_count' => isset($movieData['images']) ? [
                    'posters' => count($movieData['images']['posters'] ?? []),
                    'backdrops' => count($movieData['images']['backdrops'] ?? [])
                ] : 0
            ]);

            // Controlla se il film esiste già
            $existingMovie = Movie::where('tmdb_id', $tmdbId)->first();
            if ($existingMovie) {
                Log::info("Film già esistente nel database: " . $existingMovie->title);
                return $existingMovie;
            }

            DB::beginTransaction();
            try {
                // 1. Crea il film
                $movie = Movie::create([
                    'title' => $movieData['title'],
                    'slug' => Str::slug($movieData['title']),
                    'description' => $movieData['overview'],
                    'year' => substr($movieData['release_date'], 0, 4),
                    'duration' => $movieData['runtime'],
                    'imdb_rating' => $movieData['vote_average'],
                    'status' => 'published',
                    'category_id' => $this->mapGenreToCategory($movieData['genres']),
                    'premiere_date' => $movieData['release_date'],
                    'tmdb_id' => $tmdbId
                ]);
                Log::info("Film creato: " . $movie->title);

                // 2. Salva il poster se disponibile
                if (!empty($movieData['poster_path'])) {
                    $this->saveMovieImage($movie, $movieData['poster_path'], 'poster', $movieData['title']);
                }

                // 3. Salva il backdrop se disponibile
                if (!empty($movieData['backdrop_path'])) {
                    $this->saveMovieImage($movie, $movieData['backdrop_path'], 'backdrop', $movieData['title']);
                }

                // 4. Salva gli attori (massimo 5)
                if (isset($movieData['credits']['cast'])) {
                    $this->saveMovieCast($movie, array_slice($movieData['credits']['cast'], 0, 5));
                }

                // 5. Salva i trailer
                if (isset($movieData['videos']['results'])) {
                    $this->saveMovieTrailers($movie, $movieData['videos']['results']);
                }

                DB::commit();
                Log::info("=== IMPORTAZIONE COMPLETATA PER: " . $movie->title . " ===");
                return $movie;

            } catch (Exception $e) {
                DB::rollBack();
                Log::error("Errore durante la transazione: " . $e->getMessage());
                throw $e;
            }
        } catch (Exception $e) {
            Log::error("Errore durante l'importazione del film: " . $e->getMessage());
            Log::error($e->getTraceAsString());
            throw $e;
        }
    }

    protected function saveMovieImage($movie, $imagePath, $type, $title)
    {
        Log::info("Salvataggio immagine {$type} per film: " . $movie->title);
        
        try {
            // 1. Scarica e salva l'immagine
            $imageData = $this->downloadAndSaveImage($imagePath, $type, $title);
            if (!$imageData) {
                Log::error("Impossibile scaricare l'immagine {$type} per: " . $movie->title);
                return;
            }

            // 2. Crea il record ImageFile
            $image = ImageFile::create($imageData);
            
            // 3. Collega l'immagine al film
            $movie->imageFiles()->attach($image->image_id, ['type' => $type]);
            
            Log::info("Immagine {$type} salvata con successo per: " . $movie->title);
        } catch (Exception $e) {
            Log::error("Errore nel salvataggio dell'immagine {$type}: " . $e->getMessage());
        }
    }

    protected function saveMovieCast($movie, $cast)
    {
        Log::info("Salvataggio cast per film: " . $movie->title);
        
        foreach ($cast as $actor) {
            try {
                // 1. Crea o trova la persona
                $person = Person::firstOrCreate(
                    ['tmdb_id' => $actor['id']],
                    [
                        'name' => $actor['name'],
                        'tmdb_id' => $actor['id']
                    ]
                );
                
                // 2. Collega la persona al film
                $movie->persons()->attach($person->person_id, ['role' => 'actor']);
                
                // 3. Salva l'immagine della persona se non esiste già
                if (!$person->imageFiles()->exists() && !empty($actor['profile_path'])) {
                    $this->savePersonImage($person, $actor['profile_path'], $actor['name']);
                }
            } catch (Exception $e) {
                Log::error("Errore nel salvataggio dell'attore {$actor['name']}: " . $e->getMessage());
            }
        }
    }

    protected function savePersonImage($person, $imagePath, $name)
    {
        Log::info("Salvataggio immagine per attore: " . $name);
        
        try {
            // 1. Scarica e salva l'immagine
            $imageData = $this->downloadAndSaveImage($imagePath, 'persons', $name);
            if (!$imageData) {
                Log::error("Impossibile scaricare l'immagine per l'attore: " . $name);
                return;
            }

            // 2. Crea il record ImageFile
            $image = ImageFile::create($imageData);
            
            // 3. Collega l'immagine alla persona
            $person->imageFiles()->attach($image->image_id, ['type' => 'persons']);
            
            Log::info("Immagine salvata con successo per attore: " . $name);
        } catch (Exception $e) {
            Log::error("Errore nel salvataggio dell'immagine dell'attore: " . $e->getMessage());
        }
    }

    protected function saveMovieTrailers($movie, $videos)
    {
        Log::info("Salvataggio trailer per film: " . $movie->title);
        
        foreach ($videos as $video) {
            try {
                if ($video['type'] === 'Trailer' && $video['site'] === 'YouTube') {
                    $trailerUrl = "https://www.youtube.com/watch?v=" . $video['key'];
                    
                    // 1. Crea il trailer
                    $trailer = Trailer::create([
                        'title' => $movie->title . ' - Trailer',
                        'description' => $video['name'],
                        'url' => $trailerUrl,
                        'format' => 'youtube'
                    ]);
                    
                    // 2. Crea il video file
                    $videoFile = VideoFile::create([
                        'title' => $movie->title . ' - Trailer',
                        'url' => $trailerUrl,
                        'format' => 'youtube',
                        'resolution' => 'HD',
                        'size' => 0
                    ]);
                    
                    // 3. Collega entrambi al film
                    $movie->trailers()->attach($trailer->trailer_id);
                    $movie->videoFiles()->attach($videoFile->video_file_id);
                    
                    Log::info("Trailer salvato con successo per: " . $movie->title);
                    break; // Prendiamo solo il primo trailer
                }
            } catch (Exception $e) {
                Log::error("Errore nel salvataggio del trailer: " . $e->getMessage());
            }
        }
    }

    public function importPopularMovies($count = 10)
    {
        try {
            Log::info("Inizio importazione di {$count} film popolari");
            
            $response = $this->client->get("movie/popular", [
                'query' => [
                    'api_key' => $this->apiKey,
                    'page' => 1
                ]
            ]);
            
            $data = json_decode($response->getBody(), true);
            Log::info("Ricevuti " . count($data['results']) . " film da TMDB");
            
            $movies = [];
            
            foreach (array_slice($data['results'], 0, $count) as $movieData) {
                try {
                    $movie = $this->importMovie($movieData['id']);
                    if ($movie) {
                        $movies[] = $movie;
                    }
                } catch (Exception $e) {
                    Log::error("Errore durante l'importazione del film ID " . $movieData['id'] . ": " . $e->getMessage());
                    continue;
                }
            }

            Log::info("Importazione completata. Importati " . count($movies) . " film");
            return $movies;
        } catch (Exception $e) {
            Log::error("Errore durante l'importazione dei film popolari: " . $e->getMessage());
            throw $e;
        }
    }

    public function importMoviesByCategory($categoryId, $count = 1, $progressCallback = null)
    {
        $movies = [];
        $page = 1;
        $genreId = array_search($categoryId, $this->genreMap);

        if (!$genreId) {
            throw new Exception("Categoria non trovata: " . $categoryId);
        }

        while (count($movies) < $count) {
            $response = $this->client->get('discover/movie', [
                'query' => [
                    'api_key' => $this->apiKey,
                    'with_genres' => $genreId,
                    'page' => $page,
                    'language' => 'it-IT'
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            
            foreach ($data['results'] as $movieData) {
                if (count($movies) >= $count) break;
                
                try {
                    if ($progressCallback) {
                        $progressCallback(count($movies) + 1, $count, "Importazione: " . $movieData['title']);
                    }
                    
                    $movie = $this->importMovie($movieData['id']);
                    if ($movie) {
                        $movies[] = $movie;
                    }
                } catch (Exception $e) {
                    Log::error("Errore durante l'importazione del film {$movieData['title']}: " . $e->getMessage());
                    continue;
                }
            }

            if ($data['page'] >= $data['total_pages']) break;
            $page++;
        }

        return $movies;
    }

    protected function downloadAndSaveImage($path, $type, $title = null)
    {
        try {
            if (empty($path)) {
                Log::error("Path dell'immagine vuoto");
                return null;
            }

            // Valida il tipo di immagine
            if (!in_array($type, ['poster', 'backdrop', 'still', 'persons'])) {
                Log::error("Tipo di immagine non valido: " . $type);
                return null;
            }

            // Mappa delle dimensioni per tipo di immagine
            $sizeMap = [
                'poster' => 'w500',
                'backdrop' => 'original',
                'still' => 'original',
                'persons' => 'w185'
            ];

            // Costruisci l'URL TMDB completo
            $size = $sizeMap[$type];
            $tmdbUrl = $this->imageBaseUrl . $size . $path;
            Log::info("Download immagine da: " . $tmdbUrl);

            // Genera nome file unico
            $filename = Str::slug($title ?? 'image') . '-' . Str::random(10) . '.jpg';
            $relativePath = "images/{$type}/" . $filename;
            $fullPath = storage_path('app/public/' . $relativePath);

            // Crea la directory se non esiste
            $directory = dirname($fullPath);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }

            // Scarica l'immagine
            $imageContent = @file_get_contents($tmdbUrl);
            if ($imageContent === false) {
                Log::error("Impossibile scaricare l'immagine da: " . $tmdbUrl);
                return null;
            }

            // Salva l'immagine
            if (!file_put_contents($fullPath, $imageContent)) {
                Log::error("Impossibile salvare l'immagine in: " . $fullPath);
                return null;
            }

            // Ottieni dimensioni immagine
            $imageSize = @getimagesize($fullPath);
            if ($imageSize === false) {
                Log::error("Impossibile ottenere dimensioni immagine: " . $fullPath);
                return null;
            }

            $fileSize = filesize($fullPath);
            Log::info("Immagine salvata con successo: {$relativePath} ({$fileSize} bytes)");

            return [
                'url' => $relativePath,
                'title' => $title ?? basename($path),
                'description' => "Image for " . ($title ?? 'unknown'),
                'type' => $type,
                'size_path' => $size,
                'base_path' => $this->imageBaseUrl,
                'format' => 'jpg',
                'size' => $fileSize,
                'width' => $imageSize[0],
                'height' => $imageSize[1]
            ];
        } catch (Exception $e) {
            Log::error("Errore durante il download dell'immagine: " . $e->getMessage());
            Log::error($e->getTraceAsString());
            return null;
        }
    }
}
