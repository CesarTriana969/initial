<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'microsoft' => [
        'domain' => env('MICROSOFT_DOMAIN'),
        'app_id' => env('MICROSOFT_APP_ID'),
        'client_secret' => env('MICROSOFT_SECRET'),
        'client_id' => env('MICROSOFT_CLIENT'),
        'scope' => env('MICROSOFT_SCOPE'),
        'grant_type' => env('MICROSOFT_GRANT_TYPE'),
        'endpoint' => env('MICROSOFT_ENDPOINT'),
        'attendant' => env('MICROSOFT_ATTENDANT_ACCOUNT'),
    ],
    'clover' => [
        'base_uri_token' => env('CLOVER_BASE_URI_TOKEN', 'https://token-sandbox.dev.clover.com/v1/tokens'),
        'base_uri_scl' => env('CLOVER_BASE_URI_SCL', 'https://scl-sandbox.dev.clover.com/v1/charges'),
        'public_key' => env('CLOVER_PUBLIC_KEY'),
        'private_key' => env('CLOVER_PRIVATE_KEY'),
    ],
];
