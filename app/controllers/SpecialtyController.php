<?php

/**
 * Class SpecialityController
 *
 * @author Mike Gordo <m.gordo@cityads.ru>
 */
class SpecialtyController extends BaseController
{
	protected $layout = 'layout.specialties';

	/**
	 * Display all specialties
	 */
	public function indexAction()
	{
		$specialties = Specialty::all();

		return View::make('specialty.index', ['specialties' => $specialties]);
	}

	/**
	 * Display a page to create a new specialty
	 */
	public function createAction()
	{
		$specialty = new Specialty();

		return View::make('specialty.create', ['specialty' => $specialty]);
	}

	/**
	 * Create a new specialty
	 */
	public function storeAction()
	{
		$validation = Validator::make(Input::all(), Specialty::$rules);

		if (!$validation->passes()) {
			return Redirect::route('specialties.create')
				->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.');
		}

		/**
		 * Check name duplicates
		 */
		if (count(Specialty::where('name', Input::get('name'))->get())) {
			return Redirect::route('specialties.create')
				->withInput()
				->with('message', 'This specialty already exists.');
		}

		$specialty = Specialty::create(Input::all());

		return Redirect::route('specialties.show', $specialty->id);
	}

	/**
	 * Display one specialty
	 *
	 * @param $id
	 */
	public function showAction($id)
	{
		$specialty = Specialty::find($id);

		if (is_null($specialty))
			return Redirect::route('specialties.index')
				->with('error', 'Incorrect specialty id');

		return View::make('specialty.show', ['specialty' => $specialty]);

	}

	/**
	 * Display a page where we can edit the specialty
	 *
	 * @param $id
	 */
	public function editAction($id)
	{
		$specialty = Specialty::find($id);

		if (is_null($specialty))
			return Redirect::route('specialties.index')
				->with('error', 'Incorrect specialty id');

		return View::make('specialty.edit', ['specialty' => $specialty]);
	}

	/**
	 * Update the specialty
	 *
	 * @param $id
	 */
	public function updateAction($id)
	{
		$specialty  = Specialty::find($id);
		$validation = Validator::make(Input::all(), Specialty::$rules);

		if (!$validation->passes()) {
			return Redirect::route('specialties.edit', $id)
				->withInput()
				->withErrors($validation)
				->with('message', 'There were validation errors.');
		}

		/**
		 * Check name duplicates
		 */
		if (count(Specialty::where('name', Input::get('name'))->
			where('id', '!=', $id)->get())
		) {
			return Redirect::route('specialties.edit', $id)
				->withInput()
				->with('message', 'This specialty already exists.');
		}

		$specialty->update(Input::all());
		$specialty->save();
		return Redirect::route('specialties.show', $id);
	}

	/**
	 * Delete the specialty
	 *
	 * @param $id
	 */
	public function deleteAction($id)
	{
		$specialty = Specialty::find($id);

		if (is_null($specialty))
			return Redirect::route('specialties.index')
				->with('error', 'Incorrect specialty id');

		/**
		 * Check if in use
		 */
		if (count(Employee::where('specialty_id', $id)->get())
		) {
			return Redirect::route('specialties.index')
				->with('error', 'Unable to delete. There are employees with this specialty');
		}

		DB::table('specialty')->where('id', $id)->delete();
		return Redirect::route('specialties.index');
	}
}