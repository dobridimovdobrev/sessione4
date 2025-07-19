<?php

namespace App\Services;
use GuzzleHttp\Client;

class YOUTUBEService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.youtube.api_key');  // Ottieni la chiave API dalla configurazione
    }

    public function youtubeChannel()
    {
        $allVideos = [];  // Array per contenere tutti i video
        $pageToken = null;  // Inizializza il pageToken come null

        do {
            // Costruisci la query per l'API di YouTube
            $query = [
                'channelId' => 'UCTEo17hxk2FnmAkTsQ0dcOg',
                'key' => $this->apiKey,  // Inserisci la chiave API
                'part' => 'snippet',  // Richiedi i dettagli del video
                'order' => 'date',  // Ordina per data
                'maxResults' => 50,  // Numero massimo di video per pagina
                'type' => 'video',  // Cerca solo video
            ];

            // Se c'è un pageToken, aggiungilo alla query
            if ($pageToken) {
                $query['pageToken'] = $pageToken;
            }

            // Richiedi i video all'API di YouTube
            $result = $this->client->get('https://www.googleapis.com/youtube/v3/search', [
                'query' => $query
            ]);

            // Decodifica la risposta JSON
            $data = json_decode($result->getBody(), true);

            // Unisci i video ottenuti da questa pagina all'array principale
            $allVideos = array_merge($allVideos, $data['items']);

            // Verifica se esiste un token per la pagina successiva
            $pageToken = isset($data['nextPageToken']) ? $data['nextPageToken'] : null;

        } while ($pageToken);  // Continua finché c'è un nextPageToken
        
        // Restituisci tutti i video trovati
        return $allVideos;
    }
}
