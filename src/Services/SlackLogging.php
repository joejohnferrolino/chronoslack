<?php

namespace Chronostep\Chronoslack\Services;

use Illuminate\Support\Facades\Notification;
use Chronostep\Chronoslack\Exceptions\SlackWebhookNotDefined;
use Chronostep\Chronoslack\Notifications\SlackLogNotification;

class SlackLogging
{
    /**
     * Slack error message
     *
     * @param $errors
     */
    public function error($errors)
    {
        if (config('slack.log')) {
            $this->log($errors);
        }
    }

    /**
     * Slack error enabled
     */
    public function isErrorEnabled(): bool
    {
        return config('slack.log', true);
    }

    /**
     * Log the message to the slack channel.
     *
     * @param $errors
     *
     * @throws SlackWebhookNotDefined
     */
    protected function log($errors)
    {
        if (!config('slack.webhook-url')) {
            throw new SlackWebhookNotDefined;
        }

        //* Request Body
        $requestBody = '';
        foreach (request()->all() as $k => $v) {
            if (strpos($k, 'password') !== false) {
                $v = '********';
            }
            if (is_array($v)) {
                $v = json_encode($v);
            }
            $requestBody .= $k . '=' . $v . '&' . "\n";
        }

        //* Request Server
        $server = request()->server();
        foreach ($server as $k => $v) {
            if (strpos($v, 'password') !== false) {
                $v = preg_replace('/(password)=([^&]+)/', '${1}=********', $v);
                $server[$k] = $v;
            }
        }

        $slackMessage = [
            'Status'    => $errors['status'],
            'Message'   => $errors['message'],
            'Access ID' => $server['UNIQUE_ID'],
            'Method'    => $server['REQUEST_METHOD'],
            'Endpoint'  => $server['REQUEST_URI'],
            'Query'     => str_replace("\n", "", $requestBody)
        ];

        Notification::route('slack', config('slack.webhook-url'))
            ->notify(new SlackLogNotification(self::format4Slack($slackMessage))
        );
    }

    /**
     * Format Slack Message
     */
    private static function format4Slack($arr)
    {
        $str = "";
        foreach ($arr as $key => $val) {
            $str .= "$key: $val\n";
        }

        return $str;
    }
}
