<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\UptimeMonitor\Models\Enums\UptimeStatus;
use Spatie\UptimeMonitor\Models\Traits\SupportsUptimeCheck;

class Monitor extends \Spatie\UptimeMonitor\Models\Monitor
{
	use SupportsUptimeCheck {
		uptimeCheckFailed as parentUptimeCheckFailed;
		uptimeCheckSucceeded as parentUptimeCheckSucceeded;
	}

	/**
	 * Overwrite function from trait to log the check.
	 *
	 * @param string $reason
	 * @return void
	 */
	public function uptimeCheckFailed(string $reason): void
	{
		// Long the failed uptime check
		$log = new Log();
		$log->monitor()->associate($this);
		$log->event = UptimeStatus::DOWN;
		$log->reason = $reason;
		$log->code = $this->getStatusCodeFromReason($reason);
		$log->save();

		// Run parent function to send notifications if needed
		$this->parentUptimeCheckFailed($reason);
	}

	/**
	 * Extract status code from failure message.
	 *
	 * @param string $reason
	 * @return int|null
	 */
	private function getStatusCodeFromReason(string $reason): ?int
	{
		preg_match('/resulted in a `(\d{3}) .*` response/', $reason, $matches);

		if (isset($matches[1])) {
			return (int) $matches[1];
		}

		return null;
	}

	/**
	 * Overwrite function from trait to log the check.
	 *
	 * @return void
	 */
	public function uptimeCheckSucceeded(): void
	{
		// Long the successful uptime check if previously failing
		if (!is_null($this->uptime_check_failed_event_fired_on_date)) {
			$log = new Log();
			$log->monitor()->associate($this);
			$log->event = UptimeStatus::UP;
			$log->save();
		}

		// Run parent function to send notifications if needed
		$this->parentUptimeCheckSucceeded();
	}

	/**
	 * Define relationship with Log model.
	 *
	 * @return HasMany
	 */
	public function logs(): HasMany
	{
		return $this->hasMany(Log::class);
	}
}
