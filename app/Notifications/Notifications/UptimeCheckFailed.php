<?php

namespace App\Notifications\Notifications;

use App\Notifications\Notifiable;
use NotificationChannels\Pushover\PushoverMessage;
use Spatie\UptimeMonitor\Notifications\Notifications\UptimeCheckFailed as UptimeCheckFailedSource;

/**
 * Notification sent out when a site is discovered to be down.
 */
class UptimeCheckFailed extends UptimeCheckFailedSource {

	/**
	 * Get the Pushover representation of the notification.
	 *
	 * @param Notifiable $notifiable
	 * @return PushoverMessage
	 */
	public function toPushover(Notifiable $notifiable): PushoverMessage
	{
		return PushoverMessage::create($this->getMonitor()->uptime_check_failure_reason)
		                      ->title($this->getMessageText())
		                      ->highPriority()
		                      ->url(route('viewSites'), 'Visit Uptime Monitor');
	}

}
