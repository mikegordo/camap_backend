<?php

/**
 * Class UserController
 *
 * @author Mike Gordo <m.gordo@cityads.ru>
 */
class UserController extends BaseController
{
	protected $layout = 'layout.users';

	/**
	 * Display all users
	 */
	public function indexAction()
	{
		$users = User::all();

		return View::make('admin.index', ['users' => $users]);
	}

	/**
	 * Display a page to create a new user
	 */
	public function createAction()
	{
		$user = new User();

		return View::make('admin.create', ['user' => $user]);
	}

	/**
	 * Create a new user
	 */
	public function storeAction()
	{
		$rules = array_merge(User::$rules, ['name' => 'required']);

		$validation = Validator::make(Input::all(), $rules);

		if (!$validation->passes()) {
			return Redirect::route('users.create')
				->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.');
		}

		/**
		 * Check email duplicates
		 */
		if (count(User::where('email', strtolower(Input::get('email')))->get())) {
			return Redirect::route('users.create')
				->withInput()
				->with('message', 'This email is already taken.');
		}

		$user             = Input::all();
		$user['password'] = Hash::make(Input::get('password'));
		$user['blocked']  = Input::get('blocked') ? true : false;
		$user['email']    = strtolower(Input::get('email'));
		$user             = User::create($user);

		return Redirect::route('users.show', $user->id);
	}

	/**
	 * Display a single user
	 *
	 * @param $id
	 */
	public function showAction($id)
	{
		$user = User::find($id);

		if (is_null($user))
			return Redirect::route('users.index')
				->with('error', 'Incorrect user id');

		return View::make('admin.show', ['user' => $user]);
	}

	/**
	 * Display a page where we can edit a user
	 *
	 * @param $id
	 */
	public function editAction($id)
	{
		$user = User::find($id);

		if (is_null($user))
			return Redirect::route('users.index')
				->with('error', 'Incorrect user id');

		return View::make('admin.edit', ['user' => $user]);
	}

	/**
	 * Update user
	 *
	 * @param $id
	 */
	public function updateAction($id)
	{
		$user  = User::find($id);
		$rules = array_merge(User::$rules, ['name' => 'required']);

		if (!(trim(Input::get('password'))))
			unset($rules['password']); // she does not want to update her password

		$validation = Validator::make(Input::all(), $rules);

		if (!$validation->passes()) {
			return Redirect::route('users.edit', $id)
				->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.');
		}

		/**
		 * Check email duplicates
		 */
		if (count(User::where('email', strtolower(Input::get('email')))->
			where('id', '!=', $id)->get())
		) {
			return Redirect::route('users.edit', $id)
				->withInput()
				->with('message', 'This email is already taken.');
		}

		/**
		 * Check if stupid user blocks the whole application
		 */
		if (Input::get('blocked')) {
			if (!count(User::where('blocked', false)->where('id', '!=', $id)->get())
			) {
				return Redirect::route('users.edit', $id)
					->withInput()
					->with('message', 'There must be at least one active user!');
			}
		}

		$data = Input::all();
		if (!trim(Input::get('password')))
			unset ($data['password']);

		$user->update($data);
		$user->blocked = Input::get('blocked') ? true : false;
		$user->email   = strtolower(Input::get('email'));

		if (trim(Input::get('password')))
			$user->password = Hash::make(Input::get('password'));

		$user->save();
		return Redirect::route('users.show', $id);
	}

	/**
	 * Delete a user
	 *
	 * @param $id
	 */
	public function deleteAction($id)
	{
		$user = User::find($id);

		if (is_null($user))
			return Redirect::route('users.index')
				->with('error', 'Incorrect user id');

		/**
		 * Check if stupid user blocks the whole application
		 */
		if (!count(User::where('blocked', false)->where('id', '!=', $id)->get())
		) {
			return Redirect::route('users.edit', $id)
				->withInput()
				->with('message', 'There must be at least one active user!');
		}

		DB::table('users')->where('id', $id)->delete();
		return Redirect::route('users.index');
	}

}