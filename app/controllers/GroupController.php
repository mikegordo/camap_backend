<?php

/**
 * Class GroupController
 *
 * @author Mike Gordo <m.gordo@cityads.ru>
 */
class GroupController extends BaseController
{
	protected $layout = 'layout.groups';

	/**
	 * Display all groups
	 */
	public function indexAction()
	{
		$groups = Group::all();

		return View::make('group.index', ['groups' => $groups]);
	}

	/**
	 * Display a page to create a new group
	 */
	public function createAction()
	{
		$group = new Group();

		return View::make('group.create', ['group' => $group]);
	}

	/**
	 * Create a new group
	 */
	public function storeAction()
	{
		$validation = Validator::make(Input::all(), Group::$rules);

		if (!$validation->passes()) {
			return Redirect::route('groups.create')
				->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.');
		}

		/**
		 * Check name duplicates
		 */
		if (count(Group::where('name', Input::get('name'))->get())) {
			return Redirect::route('groups.create')
				->withInput()
				->with('message', 'This group already exists.');
		}

		$group = Group::create(Input::all());

		return Redirect::route('groups.show', $group->id);
	}

	/**
	 * Display one group
	 *
	 * @param $id
	 */
	public function showAction($id)
	{
		$group = Group::find($id);

		if (is_null($group))
			return Redirect::route('groups.index')
				->with('error', 'Incorrect group id');

		return View::make('group.show', ['group' => $group]);

	}

	/**
	 * Display a page where we can edit the group
	 *
	 * @param $id
	 */
	public function editAction($id)
	{
		$group = Group::find($id);

		if (is_null($group))
			return Redirect::route('groups.index')
				->with('error', 'Incorrect group id');

		return View::make('group.edit', ['group' => $group]);
	}

	/**
	 * Update the group
	 *
	 * @param $id
	 */
	public function updateAction($id)
	{
		$group  = Group::find($id);
		$validation = Validator::make(Input::all(), Group::$rules);

		if (!$validation->passes()) {
			return Redirect::route('groups.edit', $id)
				->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.');
		}

		/**
		 * Check name duplicates
		 */
		if (count(Group::where('name', Input::get('name'))->
			where('id', '!=', $id)->get())
		) {
			return Redirect::route('groups.edit', $id)
				->withInput()
				->with('message', 'This groups already exists.');
		}

		$group->update(Input::all());
		$group->save();
		return Redirect::route('groups.show', $id);
	}

	/**
	 * Delete the group
	 *
	 * @param $id
	 */
	public function deleteAction($id)
	{
		$group = Group::find($id);

		if (is_null($group))
			return Redirect::route('groups.index')
				->with('error', 'Incorrect group id');

		/**
		 * Check if in use
		 */
		if (count(Employee::where('group_id', $id)->get())
		) {
			return Redirect::route('groups.index')
				->with('error', 'Unable to delete. This group has employees');
		}

		DB::table('group')->where('id', $id)->delete();
		return Redirect::route('groups.index');
	}
}