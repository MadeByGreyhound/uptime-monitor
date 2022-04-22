<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
	/**
	 * Display login form.
	 *
	 * @return View
	 */
	public function displayLogin(): View
	{
		return view('login', [
			'title' => 'Login'
		]);
	}

	/**
	 * Process login POST request.
	 *
	 * @param Request $request
	 * @return RedirectResponse Redirect to dashboard or back to login page.
	 */
	public function doLogin(Request $request): RedirectResponse
	{
		$validator = Validator::make($request->all(), [
			'login' => ['required'],
			'password' => ['required'],
		]);

		if ($validator->passes()) {
			$authResult = Auth::attempt([
				$this->isEmail($request->get('login')) ? 'email' : 'name' => $request->get('login'),
				'password' => $request->get('password'),
			]);

			if ($authResult) {
				$request->session()->regenerate();

				return redirect(route('viewSites'));
			}
		}

		$request->session()->flash('error', 'Please check your username and password are correct.');

		return redirect(route('login'))->onlyInput('login');
	}

	/**
	 * Process logout.
	 *
	 * @param Request $request
	 * @return RedirectResponse Redirect back to login page.
	 */
	public function doLogout(Request $request): RedirectResponse
	{
		Auth::logout();

		$request->session()->invalidate();
		$request->session()->regenerateToken();

		return redirect(route('login'));
	}

	/**
	 * Check if supplied string is an email or username.
	 *
	 * @param string $login Email or username.
	 * @return bool True if string is email, false if string is username.
	 */
	public function isEmail(string $login): bool
	{
		return Validator::make(compact('login'), [
			'login' => ['required', 'email'],
		])->passes();
	}
}
