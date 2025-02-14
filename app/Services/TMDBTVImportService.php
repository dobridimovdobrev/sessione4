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
use Exception;

class TMDBTVImportService
{
    protected $client;
    protected $apiKey;
    protected $imageBaseUrl = 'https://image.tmdb.org/t/p/';

    // Mappa dei generi TMDB alle nostre categorie
    protected $genreMap = [
        10759 => 1,  // Action
        35 => 2,     // Comedy
        12 => 3,     // Adventure
        53 => 4,     // Thriller
        80 => 5,     // Crime
        18 => 6,     // Drama
        99 => 7,     // Documentary
        10749 => 8,  // Romance
        10768 => 9,  // War & Politics
        37 => 10,    // Western
        10765 => 11, // Fantasy
        10751 => 12, // Family
        27 => 13,    // Horror
        16 => 14     // Animation
    ];

    public function __construct()
    {
        $this->apiKey = config('services.tmdb.api_key');
        $this->client = new Client([
            'base_uri' => 'https://api.themoviedb.org/3/',
            'timeout' => 10.0,
        ]);
    }

    public function importTVSeriesByCategory($categoryId, $count = 1, $progressCallback = null)
    {
        $series = [];
        $page = 1;
        $genreId = array_search($categoryId, $this->genreMap);

        if (!$genreId) {
            throw new Exception("Categoria non trovata: " . $categoryId);
        }

        while (count($series) < $count) {
            $response = $this->client->get('discover/tv', [
                'query' => [
                    'api_key' => $this->apiKey,
                    'with_genres' => $genreId,
                    'page' => $page,
                    'language' => 'en-US'
                ]
            ]);

            $data = json_decode($response->getBody(), true);
            
            foreach ($data['results'] as $seriesData) {
                if (count($series) >= $count) break;
                
                try {
                    if ($progressCallback) {
                        $progressCallback(count($series) + 1, $count, "Importazione: " . $seriesData['name']);
                    }
                    
                    $tvSeries = $this->importTVSeries($seriesData['id']);
                    if ($tvSeries) {
                        $series[] = $tvSeries;
                    }
                } catch (Exception $e) {
                    Log::error("Errore durante l'importazione della serie {$seriesData['name']}: " . $e->getMessage());
                    continue;
                }
            }

            if ($data['page'] >= $data['total_pages']) break;
            $page++;
        }

        return $series;
    }

    public function importTVSeries($tmdbId)
    {
        try {
            // Controlla se la serie TV esiste già
            $existingTVSeries = TvSerie::where('tmdb_id', $tmdbId)->first();
            if ($existingTVSeries) {
                Log::info("Serie TV già esistente nel database: " . $existingTVSeries->title);
                return $existingTVSeries;
            }

            Log::info("=== Inizio importazione serie TV ID: " . $tmdbId . " ===");

            // Ottieni i dettagli della serie
            $response = $this->client->get("tv/{$tmdbId}", [
                'query' => [
                    'api_key' => $this->apiKey,
                    'append_to_response' => 'videos,credits',
                    'language' => 'en-US'
                ]
            ]);
            
            $seriesData = json_decode($response->getBody(), true);
            Log::info("Serie TV trovata: " . $seriesData['name']);
            
            // Crea la serie TV
            $tvSeries = TvSerie::create([
                'title' => $seriesData['name'],
                'slug' => Str::slug($seriesData['name']),
                'description' => $seriesData['overview'],
                'year' => substr($seriesData['first_air_date'], 0, 4),
                'imdb_rating' => $seriesData['vote_average'],
                'total_seasons' => $seriesData['number_of_seasons'],
                'status' => 'published',
                'category_id' => $this->mapGenreToCategory($seriesData['genres']),
                'tmdb_id' => $tmdbId  // Aggiungiamo l'ID di TMDB
            ]);
            
            Log::info("Serie TV creata nel database con ID: " . $tvSeries->tv_series_id);

            // Gestisci le immagini
            if (!empty($seriesData['poster_path'])) {
                $posterImage = $this->downloadAndSaveImage($seriesData['poster_path'], 'poster', $seriesData['name']);
                if ($posterImage) {
                    $image = ImageFile::create($posterImage);
                    $tvSeries->imageFiles()->attach($image->image_id, ['type' => 'poster']);
                    Log::info("Poster salvato per: " . $tvSeries->title);
                }
            }

            if (!empty($seriesData['backdrop_path'])) {
                $backdropImage = $this->downloadAndSaveImage($seriesData['backdrop_path'], 'backdrop', $seriesData['name']);
                if ($backdropImage) {
                    $image = ImageFile::create($backdropImage);
                    $tvSeries->imageFiles()->attach($image->image_id, ['type' => 'backdrop']);
                    Log::info("Backdrop salvato per: " . $tvSeries->title);
                }
            }

            // Gestisci i trailer
            if (isset($seriesData['videos']['results'])) {
                foreach ($seriesData['videos']['results'] as $video) {
                    if ($video['type'] === 'Trailer' && $video['site'] === 'YouTube') {
                        $trailerUrl = "https://www.youtube.com/watch?v=" . $video['key'];
                        
                        // Crea il trailer
                        $trailer = Trailer::create([
                            'title' => $seriesData['name'] . ' - Trailer',
                            'url' => $trailerUrl
                        ]);
                        $tvSeries->trailers()->attach($trailer->trailer_id);
                        Log::info("Trailer salvato per: " . $tvSeries->title);
                        break;
                    }
                }
            }

            // Gestisci gli attori (massimo 5)
            if (isset($seriesData['credits']['cast'])) {
                $cast = array_slice($seriesData['credits']['cast'], 0, 5);
                Log::info("Importo " . count($cast) . " attori per: " . $tvSeries->title);
                
                foreach ($cast as $actor) {
                    // Crea o trova la persona usando tmdb_id
                    $person = Person::firstOrCreate(
                        ['tmdb_id' => $actor['id']],
                        [
                            'name' => $actor['name'],
                            'tmdb_id' => $actor['id']
                        ]
                    );
                    
                    // Collega la persona alla serie
                    $tvSeries->persons()->attach($person->person_id, ['role' => 'actor']);

                    // Scarica e salva l'immagine della persona solo se non ne ha già una
                    if (!$person->images()->exists() && !empty($actor['profile_path'])) {
                        $personImage = $this->downloadAndSaveImage($actor['profile_path'], 'person', $actor['name']);
                        if ($personImage) {
                            $image = ImageFile::create($personImage);
                            $person->images()->attach($image->image_id);
                            Log::info("Immagine salvata per attore: " . $actor['name']);
                        }
                    }
                }
            }

            // Importa le stagioni
            for ($seasonNumber = 1; $seasonNumber <= $seriesData['number_of_seasons']; $seasonNumber++) {
                $this->importSeason($tvSeries, $seasonNumber, $tmdbId);
            }

            Log::info("=== Importazione completata per: " . $tvSeries->title . " ===\n");
            return $tvSeries;
            
        } catch (Exception $e) {
            Log::error("Errore durante l'importazione della serie TV: " . $e->getMessage());
            Log::error($e->getTraceAsString());
            throw $e;
        }
    }

    protected function importSeason($tvSeries, $seasonNumber, $tmdbId)
    {
        try {
            Log::info("Importazione stagione {$seasonNumber} per {$tvSeries->title}");

            // Ottieni i dettagli della stagione
            $response = $this->client->get("tv/{$tmdbId}/season/{$seasonNumber}", [
                'query' => [
                    'api_key' => $this->apiKey,
                    'language' => 'en-US'
                ]
            ]);
            
            $seasonData = json_decode($response->getBody(), true);
            Log::info("Dati stagione ricevuti:", [
                'poster_path' => $seasonData['poster_path'] ?? 'non presente',
                'season_number' => $seasonNumber
            ]);
            
            // Crea la stagione
            $season = Season::create([
                'tv_series_id' => $tvSeries->tv_series_id,
                'season_number' => $seasonNumber,
                'total_episodes' => count($seasonData['episodes']),
                'year' => substr($seasonData['air_date'], 0, 4),
                'premiere_date' => $seasonData['air_date']
            ]);
            
            Log::info("Stagione creata con ID: " . $season->season_id);

            // Gestisci le immagini della stagione
            if (!empty($seasonData['poster_path'])) {
                $posterImage = $this->downloadAndSaveImage($seasonData['poster_path'], 'poster', "{$tvSeries->title} Season {$seasonNumber}");
                if ($posterImage) {
                    $image = ImageFile::create($posterImage);
                    $season->imageFiles()->attach($image->image_id, ['type' => 'poster']);
                    Log::info("Poster salvato per la stagione");
                }
            }

            // Importa gli episodi
            foreach ($seasonData['episodes'] as $episodeData) {
                $this->importEpisode($season, $episodeData);
            }

            return $season;
        } catch (Exception $e) {
            Log::error("Errore durante l'importazione della stagione {$seasonNumber}: " . $e->getMessage());
            throw $e;
        }
    }

    protected function importEpisode($season, $episodeData)
    {
        try {
            Log::info("Importazione episodio {$episodeData['episode_number']} della stagione {$season->season_number}");

            // Crea l'episodio
            $episode = Episode::create([
                'season_id' => $season->season_id,
                'title' => $episodeData['name'],
                'slug' => Str::slug($episodeData['name']),
                'description' => $episodeData['overview'],
                'episode_number' => $episodeData['episode_number'],
                'duration' => $episodeData['runtime'],
                'status' => 'published'
            ]);
            
            Log::info("Episodio creato con ID: " . $episode->episode_id);

            // Gestisci le immagini dell'episodio
            Log::info("Dati episodio ricevuti:", [
                'still_path' => $episodeData['still_path'] ?? 'non presente',
                'episode_number' => $episodeData['episode_number']
            ]);
            if (!empty($episodeData['still_path'])) {
                $stillImage = $this->downloadAndSaveImage($episodeData['still_path'], 'still', $episodeData['name']);
                if ($stillImage) {
                    $image = ImageFile::create($stillImage);
                    $episode->imageFiles()->attach($image->image_id, ['type' => 'still']);
                    Log::info("Immagine salvata per l'episodio");
                }
            }

            return $episode;
        } catch (Exception $e) {
            Log::error("Errore durante l'importazione dell'episodio: " . $e->getMessage());
            throw $e;
        }
    }

    protected function downloadAndSaveImage($path, $type, $title)
    {
        try {
            if (empty($path)) {
                return null;
            }

            Log::info("Inizio download immagine: " . $path);

            // Usa w500 per poster e w1280 per backdrop, w185 per person
            $size = match($type) {
                'poster' => 'w500',
                'backdrop' => 'w1280',
                'person' => 'w185',
                'still' => 'w300',
                default => 'original'
            };
            
            $url = $this->imageBaseUrl . $size . $path;
            
            // Genera un nome file unico con sottocartella per tipo
            $filename = Str::slug($title) . '-' . Str::random(10) . '.jpg';
            
            // Usa la cartella persons per le immagini delle persone
            $type = $type === 'person' ? 'persons' : $type;
            $fullPath = 'images/' . $type . '/' . $filename;
            
            Log::info("Download da URL: " . $url);
            
            // Scarica l'immagine
            $imageContent = file_get_contents($url);
            if ($imageContent === false) {
                throw new Exception("Impossibile scaricare l'immagine da: " . $url);
            }
            
            // Crea la directory se non esiste
            $directory = storage_path('app/public/images/' . $type);
            if (!file_exists($directory)) {
                mkdir($directory, 0755, true);
            }
            
            // Salva l'immagine
            Storage::disk('public')->put($fullPath, $imageContent);
            Log::info("Immagine salvata in: " . $fullPath);

            // Ottieni le dimensioni dell'immagine
            $imageSize = getimagesize(storage_path('app/public/' . $fullPath));
            
            // Costruisci l'URL assoluto
            $absoluteUrl = 'https://api.dobridobrev.com/storage/' . $fullPath;
            
            Log::info("URL assoluto generato: " . $absoluteUrl);

            return [
                'url' => $absoluteUrl,
                'title' => $title,
                'description' => match($type) {
                    'poster' => 'TV Series poster for ' . $title,
                    'backdrop' => 'TV Series backdrop for ' . $title,
                    'persons' => 'Profile photo of ' . $title,
                    'still' => 'Episode still for ' . $title,
                    default => 'Image of ' . $title
                },
                'format' => 'jpg',
                'size' => Storage::disk('public')->size($fullPath),
                'width' => $imageSize[0],
                'height' => $imageSize[1]
            ];

        } catch (Exception $e) {
            Log::error("Errore durante il download dell'immagine: " . $e->getMessage());
            Log::error($e->getTraceAsString());
            return null;
        }
    }

    protected function mapGenreToCategory($genres)
    {
        foreach ($genres as $genre) {
            if (isset($this->genreMap[$genre['id']])) {
                return $this->genreMap[$genre['id']];
            }
        }
        return 1; // Default to Action if no match found
    }
}
