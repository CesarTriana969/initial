<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        $client = new Client();
        $response = $client->request('POST', 'https://sandbox.dev.clover.com/v3/merchants/' . env('CLOVER_MERCHANT_ID') . '/payments', [
            'headers' => [
                'Authorization' => 'Bearer c9cd43fd-1c9e-f4e2-eca9-3eb817818e13' ,
                'Content-Type' => 'application/json',
            ],
            $json = [
                'amount' => 1000, 
                'currency' => 'USD',
                'card' => [
                    'number' => '4111111111111111',
                    'exp_month' => '12',
                    'exp_year' => '2023',
                    'cvv' => '123',
                    'cardholder_name' => 'John Doe',
                ],
            ]
        ]);

        return $response->getBody();
    }

    public function handleCloverResponse(Request $request)
    {
        $accessToken = $request->input('access_token');
        $code = $request->input('code');
        return $request;
        if ($code) {
            $client = new Client();
            try {
                $response = $client->post('https://api.clover.com/oauth/token', [
                    'form_params' => [
                        'client_id' => env('CLOVER_CLIENT_ID'),
                        'client_secret' => env('CLOVER_CLIENT_SECRET'),
                        'code' => $code,
                        'grant_type' => 'authorization_code',
                        'redirect_uri' => route('clover.response')
                    ]
                ]);

                $body = json_decode((string) $response->getBody(), true);
                $access_token = $body['access_token'];
               
                return redirect()->route('success');
            } catch (\GuzzleHttp\Exception\GuzzleException $e) {
                return response()->json($e);
                return redirect()->route('error');
            }
        } else {
            return 'nada';
            return redirect()->route('error');
        }
    }

}
