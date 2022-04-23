<?php

namespace App\Notifications;

use NotificationChannels\Pushover\PushoverReceiver;
use Spatie\UptimeMonitor\Notifications\Notifiable as NotifiableSource;

class Notifiable extends NotifiableSource
{
	/**
	 * @return PushoverReceiver|null
	 */
    public function routeNotificationForPushover(): ?PushoverReceiver
    {
		$user_token = config('services.pushover.user_token');
		$app_token = config('services.pushover.app_token');

	    return $user_token && $app_token ? PushoverReceiver::withUserKey($user_token)
	                           ->withApplicationToken($app_token) : null;
    }
}
