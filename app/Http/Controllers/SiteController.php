<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Spatie\UptimeMonitor\Models\Monitor;

/**
 * Controller for handling all of the site functions.
 *
 * @package App\Http\Controllers
 */
class SiteController extends Controller
{
	/**
	 * Register auth middleware.
	 */
	public function __construct() {
		$this->middleware('auth.basic');
	}

    /**
     * Display a listing of uptime monitors.
     *
     * @return View
     */
    public function index()
    {
        return view('index', [
        	'sites' => Monitor::all(),
		]);
    }

    /**
     * Show the form for creating a new site monitor.
     *
     * @return View
     */
    public function create()
    {
    	return view('edit', [
    		'site' => new Monitor(),
		]);
	}

	/**
	 * Store a newly created site monitor in database.
	 *
	 * @param Request $request
	 * @return Redirector
	 */
    public function store(Request $request)
    {
		return $this->storeOrUpdate($request);
	}

    /**
     * Show the form for editing the specified site monitor.
     *
     * @param Monitor $site
     * @return View
     */
    public function edit(Monitor $site)
    {
    	return view('edit', compact('site'));
	}

    /**
     * Update the specified site monitor in storage.
     *
     * @param Request $request
     * @param Monitor $site
     * @return Redirector
     */
    public function update(Request $request, Monitor $site)
    {
    	return $this->storeOrUpdate($request, $site);
	}

	/**
	 * Create or update the specified site in storage.
	 *
	 * @param Request $request
	 * @param Monitor|null $site Specified site, null if creating a new site.
	 * @return Redirector Redirect back to home page.
	 */
    public function storeOrUpdate(Request $request, Monitor $site = null)
	{
		$validator = Validator::make($request->all(), [
			'url' => 'required|unique:monitors|max:1000|url',
		]);

		if ($validator->fails()) {
			$request->session()->flash('error', "Errors occurred while saving the site.");

			return redirect(url()->previous())
				->withErrors($validator)
				->withInput();
		}

		if (!$site) {
			$site = new Monitor();
		}

		$site->url = request('url');
		$site->save();

		$request->session()->flash('success', "Site \"{$site->url}\" saved successfully.");

		return redirect(route('viewSites'));
	}

	/**
	 * Remove the specified site monitor from storage.
	 *
	 * @param Monitor $site
	 * @return Redirector
	 * @throws \Exception
	 */
    public function destroy(Monitor $site)
    {
    	$site->delete();

		request()->session()->flash('success', "Site \"{$site->url}\" deleted successfully.");

		return redirect(route('viewSites'));
	}

	/**
	 * Toggle whether the site monitor is updated or disabled.
	 *
	 * @param Monitor $site
	 * @return Redirector
	 */
	public function toggle(Monitor $site)
	{
		$site->uptime_check_enabled = !$site->uptime_check_enabled;
		$site->save();

		return redirect(route('viewSites'));
	}
}
