<?php

namespace App\Services;

use App\Models\TvSerie;
use App\Models\Season;
use App\Models\Episode;
use App\Models\Person;
use App\Models\Trailer;
use App\Models\ImageFile;
use App\Models\VideoFile;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Exception;

class TMDBTVImportService
{
    protected $client;
    protected $apiKey;
    protected $imageBaseUrl = 'https://image.tmdb.org/t/p/';

    // Mappa dei generi TMDB alle nostre categorie
    protected $genreMap = [
        28 => 1,    // Action
        10759 => 1, // Action & Adventure
        35 => 2,    // Comedy
        12 => 3,    // Adventure
        53 => 4,    // Thriller
        80 => 5,    // Crime
        18 => 6,    // Drama
        99 => 7,    // Documentary
        27 => 8,    // Horror
        10749 => 9, // Romance
        10752 => 10,// War
        37 => 11,   // Western
        14 => 12,   // Fantasy
        10751 => 13,// Family
        16 => 14,   // Animation
    ];

    public function __construct()
    {
        $this->apiKey = config('services.tmdb.api_key');
        
        if (empty($this->apiKey)) {
            throw new Exception("TMDB API key non trovata in config/services.php");
        }

        // Verifica directory di storage
        $storagePath = storage_path('app/public/images');
        if (!file_exists($storagePath)) {
            if (!mkdir($storagePath, 0755, true)) {
                throw new Exception("Impossibile creare la directory di storage: " . $storagePath);
            }
        }

        // Verifica permessi di scrittura
        if (!is_writable($storagePath)) {
            throw new Exception("Directory di storage non scrivibile: " . $storagePath);
        }

        $this->client = new Client([
            'base_uri' => 'https://api.themoviedb.org/3/',
            'timeout' => 30.0, // Aumentiamo il timeout
            'verify' => false  // Disabilitiamo la verifica SSL per debug
        ]);

        // Test immediato della connessione
        try {
            $response = $this->client->get('configuration', [
                'query' => ['api_key' => $this->apiKey]
            ]);
            
            if ($response->getStatusCode() !== 200) {
                throw new Exception("API key TMDB non valida");
            }

            // Verifica che l'API key sia valida
            $data = json_decode($response->getBody(), true);
            if (!isset($data['images']['base_url'])) {
                throw new Exception("Risposta TMDB non valida");
            }

            // Aggiorna il base URL delle immagini
            $this->imageBaseUrl = $data['images']['base_url'];
            
            $this->log("Connessione a TMDB stabilita con successo");
            $this->log("Image base URL: " . $this->imageBaseUrl);
        } catch (\Exception $e) {
            throw new Exception("Errore di connessione a TMDB: " . $e->getMessage());
        }
    }

    public function importByGenre($categoryId, $count = 1, $progressCallback = null)
    {
        $genreId = array_search($categoryId, $this->genreMap);
        if ($genreId === false) {
            throw new Exception("Categoria non trovata nel genreMap: " . $categoryId);
        }

        $this->log("Inizio importazione per categoria {$categoryId} (genreId: {$genreId})");

        $page = 1;
        $series = [];
        $importedIds = TvSerie::pluck('tmdb_id')->toArray(); // Get already imported series

        while (count($series) < $count) {
            try {
                $this->log("Richiesta serie TV per genere {$genreId}, pagina {$page}");
                $response = $this->client->get('discover/tv', [
                    'query' => [
                        'api_key' => $this->apiKey,
                        'with_genres' => $genreId,
                        'page' => $page,
                        'language' => 'en-US',
                        'sort_by' => 'popularity.desc'
                    ]
                ]);
                
                $data = json_decode($response->getBody(), true);
                
                if (empty($data['results'])) {
                    throw new Exception("Nessun risultato trovato per il genere {$genreId}");
                }

                foreach ($data['results'] as $seriesData) {
                    // Skip if already imported
                    if (in_array($seriesData['id'], $importedIds)) {
                        continue;
                    }

                    if (count($series) >= $count) break;
                    
                    if ($progressCallback) {
                        $progressCallback(count($series) + 1, $count, "Importazione: " . $seriesData['name']);
                    }
                    
                    $tvSeries = $this->importTvSeries($seriesData['id']);
                    if ($tvSeries) {
                        $series[] = $tvSeries;
                        $importedIds[] = $seriesData['id']; // Add to imported list
                    }
                }

                if (empty($series) && $page < $data['total_pages']) {
                    $page++;
                    continue;
                }

                if (empty($series)) {
                    throw new Exception("Nessuna nuova serie TV trovata per il genere {$genreId}");
                }

                break;
            } catch (Exception $e) {
                throw $e;
            }
        }
        
        return $series;
    }

    public function importTvSeries($tmdbId)
    {
        try {
            $this->log("=== INIZIO IMPORTAZIONE SERIE TV ID: {$tmdbId} ===");

            // Get series details with all needed data
            $response = $this->client->get("tv/{$tmdbId}", [
                'query' => [
                    'api_key' => $this->apiKey,
                    'append_to_response' => 'videos,credits,images',
                    'language' => 'en-US'
                ]
            ]);
            
            $seriesData = json_decode($response->getBody(), true);

            // Verifica se ha almeno un trailer
            $hasTrailer = false;
            if (!empty($seriesData['videos']['results'])) {
                foreach ($seriesData['videos']['results'] as $video) {
                    if ($video['site'] === 'YouTube' && $video['type'] === 'Trailer') {
                        $hasTrailer = true;
                        break;
                    }
                }
            }

            if (!$hasTrailer) {
                $this->log("Serie TV saltata: nessun trailer disponibile");
                return null;
            }

            // Check if already exists
            $existingSeries = TvSerie::where('tmdb_id', $tmdbId)->first();
            if ($existingSeries) {
                $this->log("Serie TV già esistente: " . $existingSeries->title);
                return $existingSeries;
            }

            DB::beginTransaction();
            try {
                // Create series
                $series = TvSerie::create([
                    'title' => $seriesData['name'],
                    'slug' => Str::slug($seriesData['name']),
                    'description' => $seriesData['overview'],
                    'year' => substr($seriesData['first_air_date'], 0, 4),
                    'total_episodes' => $seriesData['number_of_episodes'],
                    'imdb_rating' => $seriesData['vote_average'],
                    'total_seasons' => $seriesData['number_of_seasons'],
                    'status' => $this->mapStatus($seriesData['status']),
                    'category_id' => $this->mapGenreToCategory($seriesData['genres']),
                    'premiere_date' => $seriesData['first_air_date'],
                    'tmdb_id' => $tmdbId
                ]);

                // Save images
                if (!empty($seriesData['poster_path'])) {
                    $this->saveSeriesImage($series, $seriesData['poster_path'], 'poster', $seriesData['name']);
                }
                if (!empty($seriesData['backdrop_path'])) {
                    $this->saveSeriesImage($series, $seriesData['backdrop_path'], 'backdrop', $seriesData['name']);
                }

                // Save cast with images
                if (!empty($seriesData['credits']['cast'])) {
                    foreach (array_slice($seriesData['credits']['cast'], 0, 5) as $actor) {
                        try {
                            // Create or update person
                            $person = Person::firstOrCreate(
                                ['tmdb_id' => $actor['id']],
                                [
                                    'name' => $actor['name'],
                                    'biography' => '',
                                    'birthday' => null,
                                    'deathday' => null
                                ]
                            );

                            // Save person image
                            if (!empty($actor['profile_path'])) {
                                $this->savePersonImage($person, $actor['profile_path'], $actor['name']);
                            }

                            // Attach person to series
                            $series->persons()->attach($person->person_id);
                            $this->log("Attore salvato: " . $actor['name']);
                        } catch (\Exception $e) {
                            $this->log("Errore salvataggio attore: " . $e->getMessage(), 'error');
                        }
                    }
                }

                // Save trailers - solo il primo trailer disponibile
                if (!empty($seriesData['videos']['results'])) {
                    foreach ($seriesData['videos']['results'] as $video) {
                        if ($video['site'] === 'YouTube' && $video['type'] === 'Trailer') {
                            try {
                                $trailer = Trailer::firstOrCreate(
                                    ['url' => "https://www.youtube.com/watch?v=" . $video['key']],
                                    [
                                        'title' => $video['name'],
                                        'type' => 'trailer'
                                    ]
                                );
                                
                                $series->trailers()->attach($trailer->trailer_id);
                                $this->log("Trailer salvato: " . $video['name']);
                                break; // Salva solo il primo trailer
                            } catch (\Exception $e) {
                                $this->log("Errore salvataggio trailer: " . $e->getMessage(), 'error');
                            }
                        }
                    }
                }

                // Import seasons and episodes
                if (!empty($seriesData['seasons'])) {
                    foreach ($seriesData['seasons'] as $seasonData) {
                        try {
                            $seasonResponse = $this->client->get("tv/{$tmdbId}/season/{$seasonData['season_number']}", [
                                'query' => [
                                    'api_key' => $this->apiKey,
                                    'language' => 'en-US'
                                ]
                            ]);
                            
                            $seasonDetails = json_decode($seasonResponse->getBody(), true);

                            $year = null;
                            if (!empty($seasonDetails['air_date'])) {
                                $year = (int)substr($seasonDetails['air_date'], 0, 4);
                            }
                            
                            $season = Season::create([
                                'tv_series_id' => $series->tv_series_id,
                                'season_number' => $seasonData['season_number'],
                                'name' => $seasonDetails['name'] ?? "Season {$seasonData['season_number']}",
                                'overview' => $seasonDetails['overview'] ?? '',
                                'year' => $year,
                                'total_episodes' => count($seasonDetails['episodes'] ?? []),
                                'premiere_date' => $seasonDetails['air_date'] ?? null
                            ]);

                            // Import episodes with description
                            if (!empty($seasonDetails['episodes'])) {
                                foreach ($seasonDetails['episodes'] as $episodeData) {
                                    // Skip episodes without description
                                    if (empty($episodeData['overview'])) {
                                        $this->log("Episodio {$episodeData['episode_number']} saltato: nessuna descrizione");
                                        continue;
                                    }

                                    try {
                                        $episode = Episode::create([
                                            'season_id' => $season->season_id,
                                            'title' => $episodeData['name'] ?? "Episode {$episodeData['episode_number']}",
                                            'description' => $episodeData['overview'],
                                            'episode_number' => $episodeData['episode_number'],
                                            'status' => 'published',
                                            'air_date' => $episodeData['air_date'] ?? null,
                                            'tmdb_id' => $episodeData['id']
                                        ]);

                                        if (!empty($episodeData['still_path'])) {
                                            $this->saveEpisodeImage($episode, $episodeData['still_path'], 'still', $episodeData['name']);
                                        }
                                    } catch (\Exception $e) {
                                        $this->log("Errore importazione episodio {$episodeData['episode_number']}: " . $e->getMessage(), 'error');
                                    }
                                }
                            }
                        } catch (\Exception $e) {
                            $this->log("Errore importazione stagione {$seasonData['season_number']}: " . $e->getMessage(), 'error');
                        }
                    }
                }

                DB::commit();
                $this->log("Serie TV importata con successo: " . $series->title);
                return $series;

            } catch (\Exception $e) {
                DB::rollBack();
                $this->log("Errore durante l'importazione: " . $e->getMessage(), 'error');
                throw $e;
            }
        } catch (\Exception $e) {
            $this->log("Errore fatale: " . $e->getMessage(), 'error');
            throw $e;
        }
    }

    protected function saveSeriesImage($series, $imagePath, $type, $title)
    {
        $this->log("Salvataggio immagine {$type} per serie: " . $series->title);
        
        try {
            // 1. Scarica e salva l'immagine
            $imageData = $this->downloadAndSaveImage($imagePath, $type, $title);
            if (!$imageData) {
                $this->log("Impossibile scaricare l'immagine {$type} per: " . $series->title, 'error');
                return;
            }

            // 2. Crea il record ImageFile
            $image = ImageFile::create($imageData);
            
            // 3. Collega l'immagine alla serie
            $series->imageFiles()->attach($image->image_id, ['type' => $type]);
            
            $this->log("Immagine {$type} salvata con successo per: " . $series->title);
        } catch (Exception $e) {
            $this->log("Errore nel salvataggio dell'immagine {$type}: " . $e->getMessage(), 'error');
        }
    }

    protected function saveSeriesTrailers($series, $videos, $episode)
    {
        $this->log("Salvataggio trailer per serie TV: " . $series->title);
        
        foreach ($videos as $video) {
            try {
                if ($video['type'] === 'Trailer' && $video['site'] === 'YouTube') {
                    $trailerUrl = "https://www.youtube.com/watch?v=" . $video['key'];
                    
                    // 1. Crea il trailer
                    $trailer = Trailer::create([
                        'title' => $series->title . ' - Trailer',
                        'description' => $video['name'],
                        'url' => $trailerUrl,
                        'type' => 'trailer'
                    ]);
                    
                    // 2. Crea il video file
                    $videoFile = VideoFile::create([
                        'title' => $series->title . ' - Trailer',
                        'url' => $trailerUrl,
                        'size' => 0, // Size not available from YouTube
                        'duration' => 0, // Duration not available from YouTube
                        'type' => 'trailer'
                    ]);
                    
                    // 3. Collega il trailer alla serie e il video file all'episodio
                    $series->trailers()->attach($trailer->trailer_id);
                    if ($episode) {
                        $episode->videoFiles()->attach($videoFile->video_file_id, ['type' => 'trailer']);
                    }
                    
                    $this->log("Trailer e video file salvati con successo: " . $video['name']);
                    break; // Prendiamo solo il primo trailer
                }
            } catch (\Exception $e) {
                $this->log("Errore salvataggio trailer/video: " . $e->getMessage(), 'error');
            }
        }
    }

    protected function saveSeriesCast($series, $cast)
    {
        $this->log("Salvataggio cast per serie TV: " . $series->title);
        
        foreach ($cast as $actor) {
            try {
                // 1. Crea o trova la persona
                $person = Person::firstOrCreate(
                    ['tmdb_id' => $actor['id']],
                    [
                        'name' => $actor['name'],
                        'biography' => '',
                        'birthday' => null,
                        'deathday' => null
                    ]
                );
                
                // 2. Collega la persona alla serie con il character name
                $series->persons()->attach($person->person_id, [
                    'role' => 'actor',
                    'character_name' => $actor['character'] ?? null
                ]);
                
                // 3. Salva l'immagine della persona se non esiste già
                if (!empty($actor['profile_path'])) {
                    $this->savePersonImage($person, $actor['profile_path'], $actor['name']);
                }
            } catch (\Exception $e) {
                $this->log("Errore salvataggio attore: " . $e->getMessage(), 'error');
            }
        }
    }

    protected function savePersonImage($person, $imagePath, $name)
    {
        $this->log("Salvataggio immagine per attore: " . $name);
        
        try {
            // 1. Scarica e salva l'immagine
            $imageData = $this->downloadAndSaveImage($imagePath, 'persons', $name);
            if (!$imageData) {
                $this->log("Impossibile scaricare l'immagine per l'attore: " . $name);
                return;
            }

            // 2. Crea il record ImageFile
            $image = ImageFile::create($imageData);
            
            // 3. Collega l'immagine alla persona
            $person->imageFiles()->attach($image->image_id, ['type' => 'persons']);
            
            $this->log("Immagine salvata con successo per attore: " . $name);
        } catch (\Exception $e) {
            $this->log("Errore salvataggio immagine attore: " . $e->getMessage(), 'error');
        }
    }

    protected function importSeason($series, $seasonData)
    {
        $this->log("Importazione stagione {$seasonData['season_number']} per: " . $series->title);
        
        try {
            // Ottieni i dettagli completi della stagione da TMDB
            $response = $this->client->get("tv/{$series->tmdb_id}/season/{$seasonData['season_number']}", [
                'query' => [
                    'api_key' => $this->apiKey,
                    'language' => 'en-US',
                    'append_to_response' => 'images'
                ]
            ]);
            
            $seasonDetails = json_decode($response->getBody(), true);
            $this->log("Dettagli stagione ricevuti", 'info', ['season' => $seasonData['season_number']]);

            // 1. Crea la stagione
            $year = null;
            if (!empty($seasonDetails['air_date'])) {
                $year = (int)substr($seasonDetails['air_date'], 0, 4);
            }

            $season = Season::create([
                'tv_series_id' => $series->tv_series_id,
                'season_number' => $seasonData['season_number'],
                'name' => $seasonDetails['name'],
                'overview' => $seasonDetails['overview'],
                'air_date' => $seasonDetails['air_date'],
                'year' => $year,
                'total_episodes' => count($seasonDetails['episodes']),
                'premiere_date' => $seasonDetails['air_date']
            ]);

            // 2. Salva il poster della stagione se disponibile
            if (!empty($seasonDetails['poster_path'])) {
                $this->saveSeasonImage($season, $seasonDetails['poster_path'], 'poster', $seasonDetails['name']);
            }

            // 3. Importa gli episodi della stagione
            if (!empty($seasonDetails['episodes'])) {
                foreach ($seasonDetails['episodes'] as $episodeData) {
                    try {
                        $this->importEpisode($season, $episodeData);
                    } catch (\Exception $e) {
                        $this->log("Errore nell'importazione dell'episodio {$episodeData['episode_number']}: " . $e->getMessage(), 'error');
                    }
                }
            }
            
            $this->log("Stagione {$seasonData['season_number']} importata con successo");
            return $season;
        } catch (Exception $e) {
            $this->log("Errore nell'importazione della stagione {$seasonData['season_number']}: " . $e->getMessage(), 'error');
            throw $e;
        }
    }

    protected function importEpisode($season, $episodeData)
    {
        try {
            $this->log("Importazione episodio {$episodeData['episode_number']} per stagione {$season->season_number}");
            
            // Verifica se l'episodio esiste
            $episodeResponse = $this->client->get("tv/{$season->tvSeries->tmdb_id}/season/{$season->season_number}/episode/{$episodeData['episode_number']}", [
                'query' => [
                    'api_key' => $this->apiKey,
                    'language' => 'en-US'
                ]
            ]);
            
            $episodeDetails = json_decode($episodeResponse->getBody(), true);
            
            // Limita la lunghezza del titolo se necessario
            $title = $episodeData['name'] ?? 'Untitled Episode';
            if (strlen($title) > 490) { // Lasciamo un margine di sicurezza
                $title = substr($title, 0, 487) . '...';
            }
            
            // Create episode with basic data
            $episode = Episode::create([
                'season_id' => $season->season_id,
                'title' => $title,
                'description' => $episodeData['overview'] ?? 'No description available',
                'episode_number' => $episodeData['episode_number'],
                'status' => 'published',
                'air_date' => $episodeData['air_date'] ?? null,
                'tmdb_id' => $episodeData['id']
            ]);
            
            // Save episode image if available
            if (!empty($episodeData['still_path'])) {
                $this->saveEpisodeImage($episode, $episodeData['still_path'], 'still', $episodeData['name']);
            }
            
            $this->log("Episodio {$episodeData['episode_number']} importato con successo");
            return $episode;
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            if ($e->getResponse()->getStatusCode() === 404) {
                $this->log("Episodio {$episodeData['episode_number']} non trovato su TMDB, salto...");
                return null;
            }
            throw $e;
        } catch (\Exception $e) {
            $this->log("Errore nell'importazione dell'episodio {$episodeData['episode_number']}: " . $e->getMessage(), 'error');
            throw $e;
        }
    }

    protected function saveSeasonImage($season, $imagePath, $type, $title)
    {
        $this->log("Salvataggio immagine {$type} per stagione {$season->season_number}");
        
        try {
            // 1. Scarica e salva l'immagine
            $imageData = $this->downloadAndSaveImage($imagePath, $type, $title);
            if (!$imageData) {
                $this->log("Impossibile scaricare l'immagine {$type} per stagione {$season->season_number}", 'error');
                return;
            }

            // 2. Crea il record dell'immagine
            $image = ImageFile::create([
                'url' => $imageData['url'],
                'file_name' => basename($imageData['url']),
                'size' => $imageData['size'],
                'width' => $imageData['width'],
                'height' => $imageData['height']
            ]);

            // 3. Collega l'immagine alla stagione
            $season->imageFiles()->attach($image->image_id, ['type' => $type]);
            
            $this->log("Immagine {$type} salvata con successo per stagione {$season->season_number}");
        } catch (Exception $e) {
            $this->log("Errore nel salvataggio dell'immagine {$type} per stagione: " . $e->getMessage(), 'error');
        }
    }

    protected function saveEpisodeImage($episode, $imagePath, $type, $title)
    {
        $this->log("Salvataggio immagine {$type} per episodio {$episode->episode_number}");
        
        try {
            // 1. Scarica e salva l'immagine
            $imageData = $this->downloadAndSaveImage($imagePath, $type, $title);
            if (!$imageData) {
                $this->log("Impossibile scaricare l'immagine {$type} per episodio {$episode->episode_number}", 'error');
                return;
            }

            // 2. Crea il record dell'immagine
            $image = ImageFile::create([
                'url' => $imageData['url'],
                'file_name' => basename($imageData['url']),
                'size' => $imageData['size'],
                'width' => $imageData['width'],
                'height' => $imageData['height']
            ]);

            // 3. Collega l'immagine all'episodio con il tipo
            $episode->imageFiles()->attach($image->image_id, ['type' => $type]);
            
            $this->log("Immagine {$type} salvata con successo per episodio {$episode->episode_number}");
        } catch (\Exception $e) {
            $this->log("Errore nel salvataggio dell'immagine {$type} per episodio: " . $e->getMessage(), 'error');
            $this->log($e->getTraceAsString(), 'error');
        }
    }

    protected function mapStatus($tmdbStatus)
    {
        $statusMap = [
            'Returning Series' => 'ongoing',
            'Ended' => 'ended',
            'Canceled' => 'canceled'
        ];
        
        return $statusMap[$tmdbStatus] ?? 'unknown';
    }

    protected function mapGenreToCategory($genres)
    {
        $this->log("Mapping genres: " . json_encode($genres));
        
        if (empty($genres)) {
            $this->log("No genres found, using default category 1 (Action & Adventure)");
            return 1; // Action & Adventure come default
        }

        // Prendi solo il primo genere
        $genre = $genres[0];
        $genreId = $genre['id'];
        
        $categoryId = $this->genreMap[$genreId] ?? 1;
        $this->log("Mapped genre {$genreId} to category {$categoryId}");
        
        return $categoryId;
    }

    protected function downloadAndSaveImage($path, $type, $title = null)
    {
        try {
            if (empty($path)) {
                $this->log("Path dell'immagine vuoto", 'error');
                return null;
            }

            // Valida il tipo di immagine
            if (!in_array($type, ['poster', 'backdrop', 'still', 'persons'])) {
                $this->log("Tipo di immagine non valido: " . $type, 'error');
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
            $this->log("Download immagine da: " . $tmdbUrl);

            // Genera nome file unico
            $filename = Str::slug($title ?? 'image') . '-' . Str::random(10) . '.jpg';
            $relativePath = "images/{$type}/" . $filename;
            $fullPath = storage_path('app/public/' . $relativePath);

            // Crea la directory se non esiste
            $directory = dirname($fullPath);
            if (!file_exists($directory)) {
                if (!mkdir($directory, 0755, true)) {
                    $this->log("Impossibile creare la directory di storage: " . $directory, 'error');
                }
            }

            // Scarica l'immagine
            $imageContent = @file_get_contents($tmdbUrl);
            if ($imageContent === false) {
                $this->log("Impossibile scaricare l'immagine da: " . $tmdbUrl, 'error');
                return null;
            }

            // Salva l'immagine
            if (!file_put_contents($fullPath, $imageContent)) {
                $this->log("Impossibile salvare l'immagine in: " . $fullPath, 'error');
                return null;
            }

            // Ottieni dimensioni immagine
            $imageSize = @getimagesize($fullPath);
            if ($imageSize === false) {
                $this->log("Impossibile ottenere dimensioni immagine: " . $fullPath, 'error');
                return null;
            }

            $fileSize = filesize($fullPath);
            $this->log("Immagine salvata con successo: {$relativePath} ({$fileSize} bytes)");

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
            $this->log("Errore durante il download dell'immagine: " . $e->getMessage(), 'error');
            $this->log($e->getTraceAsString(), 'error');
            return null;
        }
    }

    protected function log($message, $level = 'info', $context = [])
    {
        switch ($level) {
            case 'error':
                Log::channel('tmdb')->error($message, $context);
                break;
            case 'warning':
                Log::channel('tmdb')->warning($message, $context);
                break;
            case 'info':
            default:
                Log::channel('tmdb')->info($message, $context);
                break;
        }
    }
}
