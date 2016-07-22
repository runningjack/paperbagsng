<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */


        // This is the default guard used, not need to declare
        // another guard here
        'defaults' => [
            'guard' => 'user',
            'passwords' => 'user',
        ],

        // Here we must to declare the guards, if we created the App\Admin
        // class as first step, we don't need to create a custom guard
        'guards' => [
            'user' => [
                'driver' => 'session',
                'provider' => 'user',
            ],
            'customer' => [
                'driver' => 'session',
                'provider' => 'customer',
            ],
        ],
        // In this example we are using only 'eloquent' driver
        'providers' => [
            'user' => [
                'driver' => 'eloquent',
                'model' => 'paperbagsng\User',
            ],
            'customer' => [
                'driver' => 'eloquent',
                'model' => 'paperbagsng\Customer',
            ],
        ],
        'passwords' => [
            'user' => [
                'provider' => 'user',
                'email' => 'auth.emails.password',
                'table' => 'password_resets',
                'expire' => 3600,
            ],
            'customer' => [
                'provider' => 'customer',
                'email' => 'auth.emails.password',
                'table' => 'password_resets',
                'expire' => 60,
            ]
        ]
    ];