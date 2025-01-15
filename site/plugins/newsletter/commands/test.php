<?php

declare(strict_types=1);

if (! class_exists('Bnomei\Janitor')) {
    require_once __DIR__.'/../plugins/kirby3-janitor/classes/Janitor.php';
}

use Bnomei\Janitor;
use Kirby\CLI\CLI;
use Kirby\Cms\User;
use Kirby\Toolkit\A;
use Spatie\MailcoachSdk\Mailcoach;

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
        $page = page($cli->arg('page'));
        $cli->out('Sending email to <'.$to.'> ...');

        $success = false;
        try {
            $message = $to;
            if ($page->campaign()?->sendTest($to)) {
                $success = true;
            }
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
