<?php

return [
    'debug' => true,
    'thumbs' => [
        'driver' => 'im', // imagick is faster than GD and supports more image formats
        'bin' => '/usr/bin/convert',

    ],

];