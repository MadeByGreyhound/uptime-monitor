<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Database\QueryException;
use Illuminate\Support\HtmlString;
use NotificationChannels\Pushover\PushoverChannel;
use NotificationChannels\Pushover\PushoverMessage;

class DatabaseFailure extends Notification
{
	use Queueable;

	/**
	 * @var QueryException Database error which triggered the notification.
	 */
	private QueryException $exception;

	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct(QueryException $exception)
	{
		$this->exception = $exception;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param mixed $notifiable
	 * @return array
	 */
	public function via(mixed $notifiable): array
	{
		return ['mail', PushoverChannel::class];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param mixed $notifiable
	 * @return MailMessage
	 */
	public function toMail(mixed $notifiable): MailMessage
	{
		return (new MailMessage)
			->error()
			->subject('Uptime Monitor database failure')
			->greeting('Hello!')
			->line('A database failure occurred in Uptime Monitor. The error was:')
			->line(new HtmlString('<p><code>' . $this->exception->getMessage() . '</code></p>'));
	}

	/**
	 * Get the Pushover representation of the notification.
	 *
	 * @param mixed $notifiable
	 * @return PushoverMessage
	 */
	public function toPushover(mixed $notifiable): PushoverMessage
	{
		return PushoverMessage::create($this->exception->getMessage())
			->title('A database failure occurred in Uptime Monitor.')
			->highPriority();
	}
}
