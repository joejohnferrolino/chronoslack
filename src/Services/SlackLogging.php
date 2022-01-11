<?php

namespace Chronostep\Chronoslack\Services;

use Illuminate\Support\Facades\Notification;
use Chronostep\Chronolog\Exceptions\SlackWebhookNotDefined;
use Chronostep\Chronolog\Notifications\SlackLogNotification;

class SlackLogging
{
    /**
     * Slack error message
     *
     * @param $message
     */
    public function error(string $message)
    {
        if (config('slack.log')) {
            $this->log($message);
        }
    }

    /**
     * Slack error enabled
     */
    public function isErrorEnabled(): bool
    {
        return config('slack.log', true)
    }

    /**
     * Log the message to the slack channel.
     *
     * @param $message
     *
     * @throws SlackWebhookNotDefined
     */
    protected function log($message)
    {
        if (!config('slack.webhook-url')) {
            throw new SlackWebhookNotDefined;
        }

        Notification::route('slack', config('slack.webhook-url'))
            ->notify(new SlackLogNotification($message));
    }
}
