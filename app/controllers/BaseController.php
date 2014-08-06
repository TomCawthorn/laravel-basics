<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}


	/**
	 * If user is logged in, get the user.
	 *
	 * @return void
	 */
	if (Sentry::check()) 
	{
		$user = Sentry::getUser();
	}


}
