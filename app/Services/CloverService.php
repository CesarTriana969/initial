<?php

namespace App\Services;

use GuzzleHttp\Client;

class CloverService
{
    protected $client;
    protected $publicKey;
    protected $privateKey;

    public function __construct()
    {
        $this->client = new Client(['base_uri' => config('services.clover.base_uri')]);
        $this->publicKey = config('services.clover.public_key');
        $this->privateKey = config('services.clover.private_key');
    }

    public function createCharge($amount, $token)
    {
        $response = $this->client->post('v3/charges', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->privateKey,
                'Accept'        => 'application/json',
            ],
            'json' => [
                'amount' => $amount,
                'source' => $token,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}