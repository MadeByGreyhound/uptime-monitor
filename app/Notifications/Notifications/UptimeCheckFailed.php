<?php

namespace App\Notifications\Notifications;

use App\Helpers\StatusCode;
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

		if( StatusCode::validate($monitor->uptime_check_failure_reason) ) {
			$code_or_reason = $monitor->uptime_check_failure_reason;
		} elseif( str_contains( $monitor->uptime_check_failure_reason, 'cURL error 28' ) ) {
			$code_or_reason = 524;
		} else {
			$code_or_reason = null;
		}

		return PushoverMessage::create(Monitor::getMessage($monitor->uptime_status, $code_or_reason, $code_or_reason))
			->title($this->getMessageText())
			->highPriority()
			->url(route('viewSites'), 'Visit Uptime Monitor');
	}

}
