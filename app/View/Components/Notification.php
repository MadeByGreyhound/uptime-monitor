<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Notification extends Component
{
    /**
     * Get any errors in session and pass them to the view.
     *
     * @return View
     */
    public function render()
    {
    	$session = session();
    	$types = ['success', 'error'];

    	foreach ($types as $type) {
    		if( $session->has($type) ) {
    			return view('components.notification', [
    				'type' => $type,
					'message' => $session->get($type),
				]);
			}
		}

    	return null;
    }
}
