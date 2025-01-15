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
            'required' => false,
        ],
    ] + Janitor::ARGS,
    'command' => static function (CLI $cli): void {
        $to = $cli->arg('to');
        $page = page($cli->arg('page'));
        $cli->out('Sending email to <'.$to.'> ...');

        $success = false;
        try {
            $campaign = $page->campaign();
            if ($campaign && $campaign->sentAt === null && $campaign->send()) {
                $success = true;
            } else {
                $message = 'Could not send. Either not found or already sent.';
            }
        } catch (Exception $exception) {
            $message = $exception->getMessage();
        }

        $success ? $cli->success('Successfully sent published Newsletter.') : $cli->error($message);

        janitor()->data($cli->arg('command'), [
            'status' => $success ? 200 : 500,
            'message' => $message,
            'backgroundColor' => $success ? 'var(--color-positive)' : 'var(--color-negative-light)',
            'icon' => $success ? 'check' : 'alert',
        ]);
    },
];
