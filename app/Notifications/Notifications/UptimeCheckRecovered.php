<?php

namespace App\Notifications\Notifications;

use App\Notifications\Notifiable;
use NotificationChannels\Pushover\PushoverMessage;
use Spatie\UptimeMonitor\Notifications\Notifications\UptimeCheckRecovered as UptimeCheckRecoveredSource;

/**
 * Notification sent out when a site recovers.
 */
class UptimeCheckRecovered extends UptimeCheckRecoveredSource {

	/**
	 * Get the Pushover representation of the notification.
	 *
	 * @param Notifiable $notifiable
	 * @return PushoverMessage
	 */
	public function toPushover(Notifiable $notifiable): PushoverMessage
	{
		return PushoverMessage::create($this->getMessageText())
		                      ->highPriority()
		                      ->url(route('viewSites'), 'Visit Uptime Monitor');
	}

}
