<?php

use Kirby\Toolkit\Str;

Kirby::plugin('akukolabs/newsletter', [
    'options' => [
        'cache' => true, // used for flagging published newsletters
        'sender' => [
            'email' => 'info@akukolabs.com',
            'name' => 'Akuko Labs',
        ],
    ],
    'pageMethods' => [
        'toEmailData' => function() {
            return [
                'subject' => $this->subject()->or($this->title())->value(),
                'body' => [
                    'html' => snippet('newsletter.html', [
                        'preview' => Str::unhtml($this->newsletter_preview()->value()),
                        // 'campaign' => $this->slug(),
                        'site' => [
                            'title' => site()->title()->html()->value(),
                        ],
                        'title' => $this->title()->html(),
                        'blocks' => $this->blocks()->toBlocks(),
                    ], true),
                ],
                'transport' => kirby()->system()->isLocal() ? null : postmark()->transport(),
            ];
        },
    ],
    'commands' => [
        'newsletter:extract' => require __DIR__ . '/commands/extract.php',
        'newsletter:test' => require __DIR__ . '/commands/test.php',
        'newsletter:publish' => require __DIR__ . '/commands/publish.php',
    ],
]);
