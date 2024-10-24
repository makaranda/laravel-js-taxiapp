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

    // New reverseGeocode method
    public function reverseGeocode($latitude, $longitude)
    {
        $apiKey = env('ORS_API_KEY');

        // Send GET request to ORS reverse geocoding endpoint
        $response = $this->client->get('/geocode/reverse', [
            'headers' => [
                'Authorization' => $apiKey,
                'Content-Type'  => 'application/json',
            ],
            'query' => [
                'point.lat' => $latitude,
                'point.lon' => $longitude,
            ],
        ]);

        // Parse the response
        $data = json_decode($response->getBody()->getContents(), true);

        // Return the first found address or null if not found
        if (!empty($data['features'])) {
            return $data['features'][0]['properties']['label'];
        }

        return null;
    }
}
