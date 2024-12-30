<?php

namespace App\Models;

use App\Helpers\StatusCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
	public function getMessage()
	{
		return Monitor::getMessage($this->event, StatusCode::validate($this->code), $this->reason);
	}
}
