<?php

namespace App\Services;

use GuzzleHttp\Client;

class RouteService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.openrouteservice.org',
            'timeout'  => 10.0,
        ]);
    }

    public function getRoute($start, $end)
    {
        $apiKey = env('ORS_API_KEY');
        $response = $this->client->post('/v2/directions/driving-car', [
            'headers' => [
                'Authorization' => $apiKey,
                'Content-Type'  => 'application/json',
            ],
            'json' => [
                'coordinates' => [[$start['lng'], $start['lat']], [$end['lng'], $end['lat']]],
                'instructions' => true,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
