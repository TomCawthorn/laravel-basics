<?php
class ViewHelpers 
{




	/**
	 * Logic for finding user logged in status. Returns true
	 * if logged in.
	 *
	 * @return bool
	 */
	static public function is_logged_in()
	{
		if (Sentry::check()) {
			return true;
		} else {
			return false;
		}
	}












}