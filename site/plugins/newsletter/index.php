<?php

use Kirby\Toolkit\Str;
use Spatie\MailcoachSdk\Mailcoach;
use tobimori\DreamForm\DreamForm;

@include_once __DIR__ . '/dreamform/SubscribeAction.php';
DreamForm::register(SubscribeAction::class);

Kirby::plugin('akukolabs/newsletter', [
    'options' => [
        'sender' => [
            'email' => 'timothy@akukolabs.com',
            'name' => 'Akuko Labs',
        ],
    ],
    'commands' => [
        'newsletter:test' => require __DIR__ . '/commands/test.php',
        'newsletter:publish' => require __DIR__ . '/commands/publish.php',
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
                        'unsubscribeLink' => '{{ unsubscribeUrl }}',
                        'socials' => site()->socials()->toStructure(),
                        'bgcolor' => $this->bgcolor()->value(),
                        'contact' => $this->parent()->contact()->ktr(),
                    ], true),
                ],
                // 'transport' => kirby()->system()->isLocal() ? null : postmark()->transport(),
            ];
        },
        'campaign' => function(?array $emailData = null): \Spatie\MailcoachSdk\Resources\Campaign {
            if (empty($emailData)) {
                $emailData = $this->toEmailData();
            }

            $mailcoach = new Mailcoach(env('MAILCOACH_API_KEY'), env("MAILCOACH_API_ENDPOINT"));
            $campaigns = $mailcoach->campaigns();
            $found = null;

            do {
                /** @var \Spatie\MailcoachSdk\Resources\Campaign $campaign */
                foreach ($campaigns as $campaign) {
                    if ($campaign->name === $this->title()->value()) {
                        $found = $campaign;
                    }
                }
            } while ($campaigns = $campaigns->next());

            if (!$found) {
                // https://www.mailcoach.app/api-documentation/endpoints/campaigns/#content-update-a-campaign
                $found = $mailcoach->createCampaign([
                    'name' => $this->title()->value(),
                    'subject' => $emailData['subject'],
                    'email_list_uuid' => env('MAILCOACH_LIST_AKUKOLABS'),
                ]);
            }

            $found->subject = $emailData['subject']; // TODO: make sure this works
            $found->html = $emailData['body']['html'];
            $found->save();

            return $found;
        }
    ],
]);
