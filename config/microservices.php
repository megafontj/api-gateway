<?php

return [
    'users_auth' => [
        'base_uri' => env('USERS_AUTH_SERVICE_HOST') . '/api/'
    ],
    'accounts' => [
        'base_uri' => env('ACCOUNTS_SERVICE_HOST') . '/api/',
    ],
    'tweets' => [
        'base_uri' => env('TWEETS_SERVICE_HOST') . '/api/',
    ]
];
