<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'paypal' => [
    	'client_id' => 'ARE_lzAurs7MGeh7QuYnd0qkZiUkI_63msjo-Um1_o7bVVabV3T689fE-RF-Qomd5_hEGJulY5A1blzT',
    	'secret' => 'EJ6ireJSPnzZko-oKuC-03Nu6PAi_5PtMUBXE0lYSkIHzDYhulMrVgS5N9wectYpj3qY6PDiVK-Yt7YN'
    ],

];
