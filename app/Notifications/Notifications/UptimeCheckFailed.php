<?php

namespace App\Notifications\Notifications;

use App\Models\Monitor;
use App\Notifications\Notifiable;
use NotificationChannels\Pushover\PushoverMessage;
use Spatie\UptimeMonitor\Notifications\Notifications\UptimeCheckFailed as UptimeCheckFailedSource;

/**
 * Notification sent out when a site is discovered to be down.
 */
class UptimeCheckFailed extends UptimeCheckFailedSource
{

	/**
	 * Get the Pushover representation of the notification.
	 *
	 * @param Notifiable $notifiable
	 * @return PushoverMessage
	 */
	public function toPushover(Notifiable $notifiable): PushoverMessage
	{
		$monitor = $this->getMonitor();
		$code_or_reason = $monitor->uptime_check_failure_reason;

		return PushoverMessage::create(Monitor::getMessage($monitor->uptime_status, $code_or_reason, $code_or_reason))
			->title($this->getMessageText())
			->highPriority()
			->url(route('viewSites'), 'Visit Uptime Monitor');
	}

}
