<?php

namespace App\UptimeResponseCheckers;

use App\Helpers\StatusCode;
use Psr\Http\Message\ResponseInterface;
use Spatie\UptimeMonitor\Helpers\ConsoleOutput;
use Spatie\UptimeMonitor\Models\Monitor;
use Spatie\UptimeMonitor\Helpers\UptimeResponseCheckers\UptimeResponseChecker;

class CheckStatusCode implements UptimeResponseChecker
{
	/**
	 * Check if the response status code is 200, log console error.
	 *
	 * @param ResponseInterface $response
	 * @param Monitor $monitor
	 * @return bool
	 */
	public function isValidResponse(ResponseInterface $response, Monitor $monitor): bool
	{
		$message = StatusCode::getStatusCodeWithMessage($response->getStatusCode());
		$output = "Response code for {$monitor->url} is {$message}";

		if (200 === $response->getStatusCode()) {
			ConsoleOutput::info($output);

			return true;
		} else {
			ConsoleOutput::error($output);

			return false;
		}
	}

	/**
	 * Return response code as the failure reason.
	 *
	 * @param ResponseInterface $response
	 * @param Monitor $monitor
	 * @return string
	 */
	public function getFailureReason(ResponseInterface $response, Monitor $monitor): string
	{
		return $response->getStatusCode();
	}
}
