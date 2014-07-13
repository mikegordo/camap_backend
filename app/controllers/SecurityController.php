<?php

/**
 * Class SecurityController
 * Responsible for logging in and out
 *
 * @author Mike Gordo <m.gordo@cityads.ru>
 */
class SecurityController extends BaseController
{
	protected $layout = 'layout.security';

	/**
	 * Open login page
	 */
	public function loginAction()
	{
		return View::make('security.login');
	}

	/**
	 * Trying to log in
	 */
	public function loginAttempt()
	{
		if (!Request::isMethod('post')) {
			return Redirect::route('login.get');
		}

		$email = Input::get('email', null);
		$passw = Input::get('password', null);

		$validation = Validator::make(Input::all(), User::$rules);
		if (!$validation->passes()) {
			return Redirect::route('login.get')
				->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.');
		}

		if (Auth::attempt(['email' => strtolower($email), 'password' => $passw, 'blocked' => false])) {
			return Redirect::intended('admin');
		} else {
			return Redirect::route('login.get')
				->withInput()
				->withErrors($validation)
				->with('message', 'Authentication error.');
		}
	}

	/**
	 * Log out
	 */
	public function logoutAction()
	{
		Auth::logout();

		return Redirect::route('base');
	}

}