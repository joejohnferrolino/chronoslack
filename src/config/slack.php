<?php
return [
    /**
     * The URL for the webhook.  For instructions on setting up webhook functionality see:
     * https://my.slack.com/services/new/incoming-webhook/
     */
    'webhook-url' => env('LOG_SLACK_WEBHOOK_URL'),

    /**
     * The name for the logger to use.
     */
    'name' => env('LOG_SLACK_NAME', 'Example Log'),

    /**
     * Setting true/false to enable and disable the log.
     */
    'log' => env('LOG_SLACK_LOG', false),

    /**
     * The channel to send log messages.
     */
    'channel' => env('LOG_SLACK_CHANNEL'),
];
