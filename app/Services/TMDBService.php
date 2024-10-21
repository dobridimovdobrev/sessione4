<?php
namespace App\Services;

use GuzzleHttp\Client;

class TMDBService
{
    protected $client;
    protected $apiKey;
    
    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.tmdb.api_key');  // Make sure to store your TMDB API key in `config/services.php`
    }

    // Import Movies
    public function getMovies($page = 1)
    {
        $response = $this->client->get('https://api.themoviedb.org/3/discover/movie', [
            'query' => [
                'api_key' => $this->apiKey,
                'page' => $page
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    // Import TV Series
    public function getTvSeries($page = 1)
    {
        $response = $this->client->get('https://api.themoviedb.org/3/discover/tv', [
            'query' => [
                'api_key' => $this->apiKey,
                'page' => $page
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    // Import Specific TV Series Seasons
    public function getTvSeasons($tvSeriesId, $seasonNumber)
    {
        $response = $this->client->get("https://api.themoviedb.org/3/tv/{$tvSeriesId}/season/{$seasonNumber}", [
            'query' => [
                'api_key' => $this->apiKey
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    // Import Episodes for a Specific Season
    public function getSeasonEpisodes($tvSeriesId, $seasonNumber)
    {
        $response = $this->client->get("https://api.themoviedb.org/3/tv/{$tvSeriesId}/season/{$seasonNumber}", [
            'query' => [
                'api_key' => $this->apiKey
            ]
        ]);

        return json_decode($response->getBody(), true);
    }

    // Import Persons (Actors)
    public function getPerson($personId)
    {
        $response = $this->client->get("https://api.themoviedb.org/3/person/{$personId}", [
            'query' => [
                'api_key' => $this->apiKey
            ]
        ]);

        return json_decode($response->getBody(), true);
    }
}
