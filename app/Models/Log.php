<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\UptimeMonitor\Models\Enums\UptimeStatus;

class Log extends Model
{
    use HasFactory;

	/**
	 * @var bool Disable default timestamps.
	 */
	public $timestamps = false;

	/**
	 * @var string[]
	 */
	public $casts = [
		'date' => 'datetime',
	];

	/**
	 * Set relationship with Monitor model.
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function monitor()
	{
		return $this->belongsTo(Monitor::class);
	}

	/**
	 * Get display message.
	 *
	 * @return string|null
	 */
	public function getMessage() {
		if( $this->event === UptimeStatus::UP) {
			return 'Site has recovered';
		} elseif( $this->event === UptimeStatus::DOWN ) {
			$message = 'Site did not respond.';

			if( $this->code ) {
				$message .= sprintf( ' (Error code: %d)', $this->code );
			}

			return $message;
		}

		return null;
	}
}
