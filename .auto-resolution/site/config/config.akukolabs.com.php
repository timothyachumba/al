<?php

return [
    'debug' => false,
    'cache' => [
        'pages' => [
            'active' => true, // partial caches are good enough for now
        ],
    ],
    'thumbs' => [
        'driver' => 'im', // imagick is faster than GD and supports more image formats
        'bin' => '/usr/bin/convert',

    ],


];
