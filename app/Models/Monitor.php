<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\UptimeMonitor\Models\Enums\UptimeStatus;
use Spatie\UptimeMonitor\Models\Traits\SupportsUptimeCheck;
use App\Helpers\StatusCode;

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

		if ($status_code = StatusCode::validate($reason)) {
			$log->code = $status_code;
		} else {
			$log->reason = $reason;
		}

		$log->save();

		// Run parent function to send notifications if needed
		$this->parentUptimeCheckFailed($reason);
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

	/**
	 * Get short version of URL with some unnecessary parameters stripped out.
	 *
	 * @return string|null
	 */
	public function getShortUrl(): ?string
	{
		$parts = parse_url($this->url);

		if ($parts) {
			return str_replace('.', '.<wbr>', join('', array_filter([$parts['host'] ?? null, $parts['path'] ?? null, isset( $parts['query'] ) ? '?' . $parts['query'] : null])));
		}

		return null;
	}

	/**
	 * Get full version of URL for display.
	 *
	 * @return string
	 */
	public function getFullUrl(): string
	{
		return str_replace('.', '.<wbr>', $this->url);
	}

	/**
	 * Get uptime status as ID for icons etc.
	 *
	 * @return string
	 */
	public function getUptimeStatusId(): string
	{
		return str_replace(' ', '-', $this->uptime_status);
	}
}
