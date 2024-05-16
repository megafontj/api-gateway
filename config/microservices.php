<?php

return [
    'users_auth' => [
        'base_uri' => env('USERS_AUTH_HOST') . '/api/'
    ],
    'accounts' => [
        'base_uri' => env('ACCOUNTS_AUTH_HOST') . '/api/',
    ],
    'tweets' => [
        'base_uri' => env('TWEETS_AUTH_HOST') . '/api/',
    ]
];
