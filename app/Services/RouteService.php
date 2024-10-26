<?php

namespace App\Services;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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

    public function getNearbyDrivers($pickupLatitude, $pickupLongitude, $radius = 1000)
    {
        // $drivers = DB::table('users')
        //             ->select('id', 'name', 'phone', 'email', 'location','taxi_id')
        //             ->selectRaw("
        //                 (6371000 * acos(
        //                     cos(radians(?)) * cos(radians(CAST(SUBSTRING_INDEX(location, ',', 1) AS DECIMAL(10, 6)))) *
        //                     cos(radians(CAST(SUBSTRING_INDEX(location, ',', -1) AS DECIMAL(10, 6))) - radians(?)) +
        //                     sin(radians(?)) * sin(radians(CAST(SUBSTRING_INDEX(location, ',', 1) AS DECIMAL(10, 6))))
        //                 )) AS distance", [$pickupLatitude, $pickupLongitude, $pickupLatitude])
        //             ->where('role', 'driver')
        //             ->havingRaw('distance <= ?', [$radius])
        //             ->orderBy('distance')
        //             ->get();

        $drivers = DB::table('users')
                    ->select('users.id', 'users.name', 'users.phone', 'users.email', 'users.location', 'users.taxi_id', 'taxis.type', 'vehicle_types.map_icon')
                    ->selectRaw("
                        (6371000 * acos(
                            cos(radians(?)) * cos(radians(CAST(SUBSTRING_INDEX(users.location, ',', 1) AS DECIMAL(10, 6)))) *
                            cos(radians(CAST(SUBSTRING_INDEX(users.location, ',', -1) AS DECIMAL(10, 6))) - radians(?)) +
                            sin(radians(?)) * sin(radians(CAST(SUBSTRING_INDEX(users.location, ',', 1) AS DECIMAL(10, 6))))
                        )) AS distance", [$pickupLatitude, $pickupLongitude, $pickupLatitude])
                    ->where('users.role', 'driver')
                    ->join('taxis', 'users.taxi_id', '=', 'taxis.id')
                    ->join('vehicle_types', 'taxis.type', '=', 'vehicle_types.id')
                    ->havingRaw('distance <= ?', [$radius])
                    ->orderBy('distance')
                    ->get();

        return $drivers;

    }
}
