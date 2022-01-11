<?php

namespace Chronostep\Chronoslack\Facades;

use Illuminate\Support\Facades\Facade;
use Chronostep\Chronolog\Services\SlackLogging;

class SlackLog extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return SlackLogging::class;
    }
}
