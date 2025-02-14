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
            // Controlla se il film esiste già
            $existingMovie = Movie::where('tmdb_id', $tmdbId)->first();
            if ($existingMovie) {
                Log::info("Film già esistente nel database: " . $existingMovie->title);
                return $existingMovie;
            }

            Log::info("=== Inizio importazione film ID: " . $tmdbId . " ===");

            // Ottieni i dettagli del film
            $response = $this->client->get("movie/{$tmdbId}", [
                'query' => [
                    'api_key' => $this->apiKey,
                    'append_to_response' => 'videos,credits',
                    'language' => 'en-US'
                ]
            ]);
            
            $movieData = json_decode($response->getBody(), true);
            Log::info("Film trovato: " . $movieData['title']);
            
            // Crea il film
            $baseSlug = Str::slug($movieData['title']);
            $slug = $baseSlug;
            $counter = 1;
            
            // Verifica se esiste già uno slug simile e aggiungi un numero se necessario
            while (Movie::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }
            
            $movie = Movie::create([
                'title' => $movieData['title'],
                'slug' => $slug,
                'description' => $movieData['overview'],
                'year' => substr($movieData['release_date'], 0, 4),
                'duration' => $movieData['runtime'],
                'imdb_rating' => $movieData['vote_average'],
                'status' => 'published',
                'category_id' => $this->mapGenreToCategory($movieData['genres']),
                'premiere_date' => $movieData['release_date'],
                'tmdb_id' => $tmdbId  // Aggiungiamo l'ID di TMDB
            ]);
            
            Log::info("Film creato nel database con ID: " . $movie->movie_id);

            // Gestisci le immagini
            if (!empty($movieData['poster_path'])) {
                $posterImage = $this->downloadAndSaveImage($movieData['poster_path'], 'poster', $movieData['title']);
                if ($posterImage) {
                    $image = ImageFile::create($posterImage);
                    $movie->imageFiles()->attach($image->image_id, ['type' => 'poster']);
                    Log::info("Poster salvato per: " . $movie->title);
                }
            }

            if (!empty($movieData['backdrop_path'])) {
                $backdropImage = $this->downloadAndSaveImage($movieData['backdrop_path'], 'backdrop', $movieData['title']);
                if ($backdropImage) {
                    $image = ImageFile::create($backdropImage);
                    $movie->imageFiles()->attach($image->image_id, ['type' => 'backdrop']);
                    Log::info("Backdrop salvato per: " . $movie->title);
                }
            }

            // Gestisci i trailer
            if (isset($movieData['videos']['results'])) {
                foreach ($movieData['videos']['results'] as $video) {
                    if ($video['type'] === 'Trailer' && $video['site'] === 'YouTube') {
                        $trailerUrl = "https://www.youtube.com/watch?v=" . $video['key'];
                        
                        // Crea il trailer
                        $trailer = Trailer::create([
                            'title' => $movieData['title'] . ' - Trailer',
                            'url' => $trailerUrl
                        ]);
                        $movie->trailers()->attach($trailer->trailer_id);
                        
                        // Crea il video file
                        $videoFile = VideoFile::create([
                            'url' => $trailerUrl,
                            'title' => $movieData['title'] . ' - Trailer',
                            'format' => 'mp4',
                            'resolution' => '1080p'
                        ]);
                        $movie->videoFiles()->attach($videoFile->video_file_id);
                        Log::info("Trailer salvato per: " . $movie->title);
                        break;
                    }
                }
            }

            // Gestisci gli attori (massimo 5)
            if (isset($movieData['credits']['cast'])) {
                $cast = array_slice($movieData['credits']['cast'], 0, 5);
                Log::info("Importo " . count($cast) . " attori per: " . $movie->title);
                
                foreach ($cast as $actor) {
                    // Crea o trova la persona usando tmdb_id
                    $person = Person::firstOrCreate(
                        ['tmdb_id' => $actor['id']],
                        [
                            'name' => $actor['name'],
                            'tmdb_id' => $actor['id']
                        ]
                    );
                    
                    // Collega la persona al film
                    $movie->persons()->attach($person->person_id, ['role' => 'actor']);

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

            Log::info("=== Importazione completata per: " . $movie->title . " ===\n");
            return $movie;
            
        } catch (Exception $e) {
            Log::error("Errore durante l'importazione del film: " . $e->getMessage());
            Log::error($e->getTraceAsString());
            throw $e;
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
            $absoluteUrl = 'https://api.dobridobrev.com/public/storage/' . $fullPath;
            
            Log::info("URL assoluto generato: " . $absoluteUrl);

            return [
                'url' => $absoluteUrl,
                'title' => $title,
                'description' => match($type) {
                    'poster' => 'Movie poster for ' . $title,
                    'backdrop' => 'Movie backdrop for ' . $title,
                    'persons' => 'Profile photo of ' . $title,
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
}
