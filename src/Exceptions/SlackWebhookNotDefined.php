<?php

namespace Chronostep\Chronoslack\Exceptions;

use Throwable;

/**
 * Class SlackWebhookNotDefined
 */
class SlackWebhookNotDefined extends \Exception
{
    /**
     * SlackWebhookNotDefined constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        $message = 'Slack webhook url must be registered.',
        $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
