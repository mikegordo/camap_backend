<?php

/**
 * Class AdminController
 *
 * @author Mike Gordo <m.gordo@cityads.ru>
 */
class AdminController extends BaseController
{
	public function defaultAction()
	{
		/**
		 * На какой роут мы редидектим при входе в админку
		 */
		return Redirect::route('users.index');
	}

}
