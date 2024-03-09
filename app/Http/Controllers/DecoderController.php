<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class DecoderController extends Controller
{

  public function index()
  {
    return view('principal.decoder.index');
  }

  public function decodeDetails($vin)
  {
    $decodeVin = $this->decode($vin);

    return view('principal.decoder-details.index', compact('decodeVin'));
  }

  private function decode($vin)

  {
    $apiKey = '2f14671007mshc43eb0649ca7087p1b35f1jsnb98f633cbf85';

    $client = new Client();

    try {
      $response = $client->request('GET', "https://vindecoder.p.rapidapi.com/decode_vin?vin=$vin", [
        'headers' => [
          'X-RapidAPI-Host' => 'vindecoder.p.rapidapi.com',
          'X-RapidAPI-Key' => $apiKey,
        ],
      ]);

      return json_decode($response->getBody(), true);

    } catch (\Exception $e) {

      // return ['error' => $e->getMessage()];
      return view('principal.alerts.not-found');
    }
  }
}
