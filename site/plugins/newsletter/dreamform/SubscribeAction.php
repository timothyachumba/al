<?php

use Spatie\MailcoachSdk\Mailcoach;
use tobimori\DreamForm\Actions\Action;

class SubscribeAction extends Action
{
    public static function blueprint(): array
    {
        return [
            'title' => 'Newsletter Subscribe',
            // 'preview' => 'fields',
            'icon' => 'anchor',
            'fields' => []
        ];
    }

    public function run(): void
    {
        try {
            $mailcoach = new Mailcoach(env('MAILCOACH_API_KEY'), env("MAILCOACH_API_ENDPOINT"));
            $subscriber = $mailcoach->createSubscriber(env('MAILCOACH_LIST_AKUKOLABS'), [
                'email' => (string) $this->submission()->valueFor('email'),
            ]);
            /* TODO: get tags to work
            $tags = [
                (string) $this->submission()->valueFor('project'),
            ];
            $tags = array_filter($tags, fn($i) => !empty($i));
            $subscriber->addTags($tags);
            */
        } catch (Throwable $e) {
            $this->cancel($e->getMessage());
        }
    }

    public static function type(): string
    {
        return 'newsletter_subscribe';
    }
}
