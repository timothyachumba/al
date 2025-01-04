<?php

return [
    'debug' => true,
    'thumbs' => [
        'driver' => 'im', // imagick is faster than GD and supports more image formats
        'bin' => '/usr/bin/convert',

    ],

    // https://getkirby.com/docs/cookbook/development-deployment/using-mailhog-for-email-testing
    'email' => [
        'transport' => [
            'type' => 'smtp',
            'host' => 'localhost',
            'port' => 2424, // 1025
            'security' => false
        ]
    ],
];
