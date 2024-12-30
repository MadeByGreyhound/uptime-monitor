<?php

namespace App\Helpers;

/**
 * Class for centrally managing valid status codes and their messages.
 *
 * @url https://github.com/MattIPv4/status-codes/blob/master/codes.json
 */
class StatusCode
{
	/**
	 * @var string[]
	 */
	protected static array $codes = [
		100 => "Continue",
		101 => "Switching Protocols",
		102 => "Processing",
		103 => "Early Hints",
		200 => "OK",
		201 => "Created",
		202 => "Accepted",
		203 => "Non-Authoritative Information",
		204 => "No Content",
		205 => "Reset Content",
		206 => "Partial Content",
		207 => "Multi-Status",
		208 => "Already Reported",
		218 => "This is fine (Apache Web Server)",
		226 => "IM Used",
		300 => "Multiple Choices",
		301 => "Moved Permanently",
		302 => "Found",
		303 => "See Other",
		304 => "Not Modified",
		306 => "Switch Proxy",
		307 => "Temporary Redirect",
		308 => "Resume Incomplete",
		400 => "Bad Request",
		401 => "Unauthorized",
		402 => "Payment Required",
		403 => "Forbidden",
		404 => "Not Found",
		405 => "Method Not Allowed",
		406 => "Not Acceptable",
		407 => "Proxy Authentication Required",
		408 => "Request Timeout",
		409 => "Conflict",
		410 => "Gone",
		411 => "Length Required",
		412 => "Precondition Failed",
		413 => "Request Entity Too Large",
		414 => "Request-URI Too Long",
		415 => "Unsupported Media Type",
		416 => "Requested Range Not Satisfiable",
		417 => "Expectation Failed",
		418 => "I'm a teapot",
		419 => "Page Expired (Laravel Framework)",
		420 => "Method Failure (Spring Framework)",
		421 => "Misdirected Request",
		422 => "Unprocessable Entity",
		423 => "Locked",
		424 => "Failed Dependency",
		426 => "Upgrade Required",
		428 => "Precondition Required",
		429 => "Too Many Requests",
		431 => "Request Header Fields Too Large",
		440 => "Login Time-out",
		444 => "Connection Closed Without Response",
		449 => "Retry With",
		450 => "Blocked by Windows Parental Controls",
		451 => "Unavailable For Legal Reasons",
		494 => "Request Header Too Large",
		495 => "SSL Certificate Error",
		496 => "SSL Certificate Required",
		497 => "HTTP Request Sent to HTTPS Port",
		498 => "Invalid Token (Esri)",
		499 => "Client Closed Request",
		500 => "Internal Server Error",
		501 => "Not Implemented",
		502 => "Bad Gateway",
		503 => "Service Unavailable",
		504 => "Gateway Timeout",
		505 => "HTTP Version Not Supported",
		506 => "Variant Also Negotiates",
		507 => "Insufficient Storage",
		508 => "Loop Detected",
		509 => "Bandwidth Limit Exceeded",
		510 => "Not Extended",
		511 => "Network Authentication Required",
		520 => "Unknown Error",
		521 => "Web Server Is Down",
		522 => "Connection Timed Out",
		523 => "Origin Is Unreachable",
		524 => "A Timeout Occurred",
		525 => "SSL Handshake Failed",
		526 => "Invalid SSL Certificate",
		527 => "Railgun Listener to Origin Error",
		530 => "Origin DNS Error",
		598 => "Network Read Timeout Error",
	];

	/**
	 * Check if status code is valid, exists, and return cleaned code as integer.
	 *
	 * @param mixed $code
	 * @return int|null
	 */
	public static function validate(mixed $code): ?int
	{
		return is_numeric($code) && isset(self::$codes[(int) $code]) ? (int)$code : null;
	}

	/**
	 * Get message for code.
	 *
	 * @param mixed $code
	 * @return string|null
	 */
	public static function getMessage(mixed $code): ?string
	{
		$code = self::validate($code);

		return $code ? self::$codes[$code] : null;
	}

	/**
	 * Get code and message together in a string.
	 *
	 * @param mixed $code
	 * @return string|null
	 */
	public static function getStatusCodeWithMessage(mixed $code): ?string
	{
		$message = self::getMessage($code);

		return $message ? "$code ($message)" : null;
	}
}
