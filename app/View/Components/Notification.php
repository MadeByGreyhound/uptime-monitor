<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Notification extends Component
{
	/**
	 * @var string|null Type of the notification found in session, if any.
	 */
	public ?string $type = null;

	/**
	 * Find the first notification type present in session.
	 *
	 * @return void
	 */
	public function __construct()
	{
		foreach (['success', 'error'] as $type) {
			if (session()->has($type)) {
				$this->type = $type;
				break;
			}
		}
	}

	public function shouldRender(): bool
	{
		return !is_null($this->type);
	}

    /**
     * Pass the notification in session to the view.
     *
     * @return View
     */
    public function render()
    {
    	return view('components.notification', [
    		'type' => $this->type,
			'message' => session()->get($this->type),
		]);
    }
}
