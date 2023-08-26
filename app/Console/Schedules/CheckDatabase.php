<?php
/**
 * Scheduled task responsible for checking database connection.
 */

namespace App\Console\Schedules;

use App\Notifications\DatabaseFailure;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class CheckDatabase
{

	/**
	 * Schedule database check.
	 *
	 * @param Schedule $schedule
	 * @return void
	 */
	function schedule(Schedule $schedule): void
	{
		$schedule->call([$this, 'checkDatabase'])->name('checkDatabase')->daily();
	}

	/**
	 * Check if the database server is available, send error notification if not.
	 * Save notification time to config file.
	 *
	 * @return void
	 */
	public function checkDatabase(): void
	{
		try {
			DB::select('SELECT COUNT(*) FROM monitors');
			$this->setConfig(null, null);
		} catch (QueryException $exception) {
			$now = Carbon::now();
			$config = $this->getConfig();
			$yesterday = Carbon::now()->subDay();

			if (!$config->lastNotification || $config->lastNotification->isBefore($yesterday)) {
				Notification::route('mail', env('UPTIME_MONITOR_EMAIL'))
					->route('pushover', (new \App\Notifications\Notifiable)->routeNotificationForPushover())
					->notify(new DatabaseFailure($exception));

				$this->setConfig($config->firstOccurrence ?: $now, $now);
			}
		}
	}

	/**
	 * Retrieve database check config.
	 *
	 * @return object
	 */
	protected function getConfig(): object
	{
		return (object)array_map(function ($item) {
			return $item ? Carbon::createFromFormat(Carbon::ATOM, $item) : null;
		}, array_merge([
			'firstOccurrence' => null,
			'lastNotification' => null,
		], json_decode(Storage::get('database-error.json'), true) ?? []));
	}

	/**
	 * Set database check config.
	 *
	 * @param Carbon|null $firstOccurrence First occurrence of database error.
	 * @param Carbon|null $lastNotification Last time the notification was sent.
	 * @return void
	 */
	protected function setConfig(?Carbon $firstOccurrence, ?Carbon $lastNotification): void
	{
		Storage::put('database-error.json', json_encode([
			'firstOccurrence' => $firstOccurrence?->toAtomString(),
			'lastNotification' => $lastNotification?->toAtomString(),
		]));
	}
}
