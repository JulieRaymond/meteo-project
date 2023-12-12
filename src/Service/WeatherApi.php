<?php
// src/Service/WeatherService.php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class WeatherService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getWeatherByCity(string $city): array
    {
        $response = $this->client->request('GET', 'https://api.openweathermap.org/data/2.5/weather', [
            'query' => [
                'q' => $city,
                'appid' => 'acca7f148bfba703a2b03ab80db2b356',
                'units' => 'metric',
            ],
        ]);

        return $response->toArray();
    }
}
