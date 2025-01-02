<?php

declare(strict_types=1);

if (! class_exists('Bnomei\Janitor')) {
    require_once __DIR__.'/../plugins/kirby3-janitor/classes/Janitor.php';
}

use Bnomei\Janitor;
use Kirby\CLI\CLI;
use Kirby\Cms\User;

return [
    'description' => 'Newsletter Publish',
    'args' => [
        'to' => [
            'longPrefix' => 'to',
            'description' => 'To E-mail address',
            'castTo' => 'string',
        ],
    ] + Janitor::ARGS,
    'command' => static function (CLI $cli): void {
        $to = $cli->arg('to');
        $success = false;

        // only send once per email/listid
        $key = md5('newsletter-published-'.$to.'-'.page($cli->arg('page'))?->uuid()->id());
        $hasBeenSent = kirby()->cache('akukolabs.newsletter')->get($key);
        if ($hasBeenSent) {
            $message = "$hasBeenSent <$to>";
        } else {
            // from, subject, body[text,html], transport
            $emailData = page($cli->arg('page'))->toEmailData();

            $cli->out('Publishing Newsletter to <'.$to.'> ...');

            try {
                $message = $to;
                $success = $cli->kirby()->email(
                    array_merge($emailData, [
                        'to' => $to,
                        'from' => new User(option('akukolabs.newsletter.sender')),
                    ]),
                )->isSent();
                if ($success) {
                    kirby()->cache('akukolabs.newsletter')->set($key, date('c'));
                }
            } catch (Exception $exception) {
                $message = $exception->getMessage();
            }

            $success ? $cli->success('Successfully sent published Newsletter.') : $cli->error($message);
        }

        janitor()->data($cli->arg('command'), [
            'status' => $success ? 200 : 500,
            'message' => $message,
            'backgroundColor' => $success ? 'var(--color-positive)' : 'var(--color-negative-light)',
            'icon' => $success ? 'check' : 'alert',
        ]);
    },
];
