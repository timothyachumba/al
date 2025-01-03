<?php

use Kirby\Cms\Response;
use Kirby\Http\Remote;
use Kirby\Toolkit\Str;
use Kirby\Toolkit\V;

Kirby::plugin('akukolabs/newsletter', [
    'options' => [
        'cache' => true, // used for flagging published newsletters
        'sender' => [
            'email' => 'info@akukolabs.com',
            'name' => 'Akuko Labs',
        ],
        'magic-email-address' => 'newsletters@mg.buttondown.email',
        'buttondown' => ['api-key' => null],
    ],
    'routes' => [
        [
            'pattern' => 'newsletter/unsubscribe/(:any)',
            'method' => 'DELETE',
            'action' => function ($email) {
                $email = strip_tags(urldecode($email));

                return Response::json([], site()->unsubscribe($email) ? 200 : 400);
            }
        ],
        [
            'pattern' => 'newsletter/unsubscribe/(:any)/(:any)',
            'action' => function ($email, $token) {
                $email = strip_tags(urldecode($email));
                $token = strip_tags($token);

                if (sha1($email.__DIR__) === $token) {
                    if (site()->unsubscribe($email)) {
                        die('Unsubscribed');
                        // go(page('home')->url().'?newsletter=unsubscribed');
                    }
                }

                go('home');
            }
        ],
    ],
    'siteMethods' => [
        'unsubscribeLink' => function(?string $email = null) {
            if (empty($email)) {
                return site()->url() . '/newsletter/unsubscribe';
            }

            return site()->url() . '/newsletter/unsubscribe/' . urlencode($email) . '/' . sha1($email.__DIR__);
        },
        'unsubscribe' => function($email): bool {
            $BUTTONDOWN_API_KEY = option('akukolabs.newsletter.buttondown.api-key');
            if (empty($BUTTONDOWN_API_KEY) || !V::email($email)) {
                return false;
            }

            $response = Remote::delete("https://api.buttondown.com/v1/subscribers/$email", [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => "Token $BUTTONDOWN_API_KEY"
                ],
            ]);

            return $response->code() === 200;
        },
    ],
    'pageMethods' => [
        'toEmailData' => function() {
            return [
                'subject' => $this->subject()->or($this->title())->value(),
                'body' => [
                    'html' => snippet('newsletter.html', [
                        'preview' => Str::unhtml($this->newsletter_preview()->value()),
                        'site' => [
                            'title' => site()->title()->html()->value(),
                        ],
                        'title' => $this->title()->html()->value(),
                        'blocks' => $this->blocks()->toBlocks(),
                        'unsubscribeLink' => site()->unsubscribeLink(),
                        'socials' => site()->socials()->toStructure()->toArray(function($item) {
                            return [
                                'name' => $item->title()->value(),
                                'url' => url($item->url()->value()),
                                'icon' => $item->icon()->toFile()?->url(),
                            ];
                        }),
                    ], true),
                ],
                // 'transport' => kirby()->system()->isLocal() ? null : postmark()->transport(),
            ];
        },
    ],
    'commands' => [
        'newsletter:test' => require __DIR__ . '/commands/test.php',
        'newsletter:publish' => require __DIR__ . '/commands/publish.php',
    ],
]);
