<?php
use tobimori\DreamForm\Support\Menu;
return [
    'debug' => false,

    'akukolabs.newsletter.sender' => [
        'email' => 'info@akukolabs.com', // TODO: @timothy set email matching the one in Buttondown
        'name' => 'Akuko Labs'
    ],
    'akukolabs.newsletter.buttondown.apiKey' => 'f9af7813-e430-4da6-b85c-2bb3d160dabd',

    'thumbs' => [
        'presets' => [
            'nl-cols-12' => ['width' => 576*2, 'format' => 'jpeg'],
            'nl-cols-9' => ['width' => 428*2, 'format' => 'jpeg'],
            'nl-cols-8' => ['width' => 379*2, 'format' => 'jpeg'],
            'nl-cols-6' => ['width' => 280*2, 'format' => 'jpeg'],
            'nl-cols-4' => ['width' => 181*2, 'format' => 'jpeg'],
            'nl-cols-3' => ['width' => 132*2, 'format' => 'jpeg'],
        ]
    ],

    'bnomei.dotenv.dir' => fn () => realpath(kirby()->roots()->base()),

    'tobimori.seo.lang' => 'en_GB',
    'tobimori.seo.canonicalBase' => 'https://akukolabs.com',
    'tobimori.seo.robots' => [
        'active' => true,
        'content' => [
            '*' => [
                'Allow' => ['/'],
                'Disallow' => ['/kirby', '/panel', '/content']
            ]
        ]
    ],

    // Custom menu to show forms in the panel sidebar
    'panel.menu' => fn () => [
        'site' => Menu::site(),
        'forms' => Menu::forms(),
        'users',
        'system',
        // [...]
    ],

    'tobimori.dreamform' => [
        // encryption secret for htmx attributes
        'secret' => fn () => env('DREAMFORM_SECRET')
    ],
    'tobimori.dreamform.actions.buttondown.apiKey' => 'f9af7813-e430-4da6-b85c-2bb3d160dabd',

    'tobimori.dreamform.mode' => 'htmx',


    'cache' => [
        'pages' => [
            'active' => false, // partial caches are good enough for now
        ],
    ],

    'session' => [
        'cookieName' => 'session', // hide that we are using kirby in removing the kirby prefix
    ],

    'medienbaecker.autoresize.maxWidth' => 3840, // 4k
    'medienbaecker.autoresize.maxHeight' => 3840, // 4k square

    'moritzebeling.kirby-favicon' => [
        'favicon' => [
            'png' => 'dist/assets/favicon/favicon.png', // required
            'ico' => 'dist/assets/favicon/favicon.ico', // fallback to favicon.png
            'svg' => 'dist/assets/favicon/favicon.svg',
            'sizes' => [ 32, 96, 16, 180 ],
        ],
        'app' => [
            'icon' => 'dist/assets/favicon/app-icon.png', // fallback to favicon.png
            'sizes' => [ 180, 167, 152 ]
        ],
        'mask' => 'dist/assets/favicon/mask.svg', // fallback to favicon.svg
        'color' => false,

        // for minimal html output
        'minimalist' => false,

        // the following will ony be show when 'extended' is set to true
        'extended' => false,

        'manifest' => [
            'icon' => 'dist/assets/favicon/android-icon.png', // fallback to favicon.png
            'background_color' => '#ffffff',
            'sizes' => [
                36 => 0.75,
                48 => 1.0,
                72 => 1.5,
                96 => 2.0,
                144 => 3.0,
                192 => 4.0,
                512 => false
            ],
            // other entries can be added here
        ],
        'browserconfig' => [
            'icon' => 'dist/assets/favicon/ms-tile.png', // fallback to favicon.png
            'sizes' => [ 70, 150, 310 ]
        ],
    ]
];
