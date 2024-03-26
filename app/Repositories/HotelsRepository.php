<?php

namespace App\Repositories;

use GuzzleHttp\Client;
use Illuminate\Support\Collection;

class HotelsRepository
{

    public function fetchHotels(): Collection
    {
        $client = new Client();
        $response = $client->request('GET', env('URL_TO_JSON_ENDPOINT'), [
            'verify' => false,
        ]);

        $hotels = ((array)json_decode($response->getBody()->getContents())) ['hotels'];
        return collect($hotels);
    }

}
