<?php

namespace Chronostep\Chronoslack;

use Illuminate\Support\ServiceProvider;
use Chronostep\Chronolog\Services\SlackLogging;

class SlackLogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/slack.php' => config_path('slack.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/slack.php',
            'slack'
        );

        $this->app->singleton(SlackLogging::class);
    }
}
