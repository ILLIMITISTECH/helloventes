<?php
return [
  
    'driver' => env('MAIL_DRIVER'),

    'host' => env('MAILJET_APIKEY'),

    'host' => env('in-v3.mailjet.com'),

    'encryption' => env('MAIL_ENCRYPTION', 'tls'),

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'info@illimitis.com'),
        'name' => env('MAIL_FROM_NAME', 'Byfeeding'),
    ],

    'username' => env('MAIL_USERNAME'),

    'password' => env('MAIL_PASSWORD'),

    'mailers' => [

        'mailjet' => [
            'transport' => 'mailjet',
        ]
    ]
];
