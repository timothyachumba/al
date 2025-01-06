<?php

declare(strict_types=1);

if (! class_exists('Bnomei\Janitor')) {
    require_once __DIR__.'/../plugins/kirby3-janitor/classes/Janitor.php';
}

use Bnomei\Janitor;
use Kirby\CLI\CLI;
use Kirby\Cms\User;
use Kirby\Toolkit\A;

return [
    'description' => 'Newsletter Test',
    'args' => [
        'to' => [
            'longPrefix' => 'to',
            'description' => 'To E-mail address',
            'castTo' => 'string',
        ],
    ] + Janitor::ARGS,
    'command' => static function (CLI $cli): void {
        $to = $cli->arg('to');

        // from, subject, body[text,html], transport
        $emailData = page($cli->arg('page'))->toEmailData();

        $cli->out('Sending email to <'.$to.'> ...');

        if ($subject = A::get($emailData, 'subject')) {
            $emailData['subject'] = '[TEST] '.$subject;
        }

        $success = false;
        try {
            $message = $to;
            $success = $cli->kirby()->email(
                array_merge($emailData, [
                    'to' => $to,
                    'from' => new User(option('akukolabs.newsletter.sender')),
                ]),
            )->isSent();
        } catch (Exception $exception) {
            $message = $exception->getMessage();
        }

        $success ? $cli->success('Successfully sent Test E-Mail.') : $cli->error($message);

        janitor()->data($cli->arg('command'), [
            'status' => $success ? 200 : 500,
            'message' => $message,
        ]);
    },
];
