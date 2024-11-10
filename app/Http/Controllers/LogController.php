<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Monitor;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LogController extends Controller
{
	/**
	 * Display a listing of all logs.
	 *
	 * @return View
	 */
	public function index()
	{
		return view('logs', [
			'logs' => Log::orderBy('date', 'desc')->get(),
			'title' => 'All Logged Events',
			'showUrl' => true,
		]);
	}

	/**
	 * Display a listing of logs for selected site.
	 *
	 * @return View
	 */
	public function site(Request $request, int $monitor_id)
	{
		$monitor = Monitor::findOrFail($monitor_id);

		return view('logs', [
			'logs' => Log::where('monitor_id', $monitor->id)->orderBy('date', 'desc')->get(),
			'title' => sprintf( 'Logged Events for %s', $monitor->getShortUrl() ),
			'showUrl' => false,
		]);
	}
}
