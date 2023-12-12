<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class OpenWeatherMapService
{
    private $client;
    private $apiKey;

    public function __construct(HttpClientInterface $client, string $apiKey = 'acca7f148bfba703a2b03ab80db2b356')
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    public function getWeatherForCity(string $city): array
    {
        $response = $this->client->request('GET', 'http://api.openweathermap.org/data/2.5/weather', [
            'query' => [
                'q' => $city,
                'appid' => $this->apiKey,
                'units' => 'metric',
            ],
        ]);

        return $response->toArray();
    }
}