# Slack Logging Notification
This package will be sent logging notification on slack.

## Source
||URL|
|---|---|
|Packagist| https://packagist.org/packages/chronostep/chronoslack|
|Github| https://github.com/ChronoDevs/chronoslack|

## Installation Procedure
### Install Composer Package
```
composer require chronostep/chronoslack
```

### Configuration
You'll need to register the configuration in the environment. The file will be `.env`.
In this file you will need to provide the webhook url.  I recommend reading [Slack Incoming Webhooks](https://my.slack.com/services/new/incoming-webhook/) for more information on how to setup the webhook.

```
LOG_SLACK_WEBHOOK_URL=
LOG_SLACK_NAME=
LOG_SLACK_LOG=
LOG_SLACK_CHANNEL=
```

# Example Usage

```php
$error = ['status' => 404, 'message' => 'Not found!'];

SlackLog::error($error);

// Use logging guard if not specify `LOG_SLACK_LOG` in the environment.
if (SlackLog::isErrorEnabled()) {
    SlackLog::error($error);
}
```
