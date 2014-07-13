<?php

/**
 * Class AjaxController
 *
 * @author Mike Gordo <m.gordo@cityads.ru>
 */
class AjaxController extends BaseController
{
	/**
	 * Returns set of groups
	 */
	public function groupsAction()
	{
		$groups = Group::all();

		return Response::json([
			$groups
		], 200);
	}

	/**
	 * Returns a single group
	 *
	 * @param $id
	 */
	public function groupAction($id)
	{
		$group = Group::find($id);

		if (!$group)
			return Response::json(['error' => "Запись id {$id} не найдена"], 400);

		return Response::json([
			$group
		], 200);
	}

	/**
	 * Returns set of departments
	 */
	public function departmentsAction()
	{
		$departments = Department::all();

		return Response::json([
			$departments
		], 200);
	}

	/**
	 * Returns a single department
	 *
	 * @param $id
	 */
	public function departmentAction($id)
	{
		$department = Department::find($id);

		if (!$department)
			return Response::json(['error' => "Запись id {$id} не найдена"], 400);

		return Response::json([
			$department
		], 200);
	}

	/**
	 * Returns set of specialties
	 */
	public function specialtiesAction()
	{
		$specialties = Specialty::all();

		return Response::json([
			$specialties
		], 200);
	}

	/**
	 * Returns a single specialty
	 *
	 * @param $id
	 */
	public function specialtyAction($id)
	{
		$specialty = Specialty::find($id);

		if (!$specialty)
			return Response::json(['error' => "Запись id {$id} не найдена"], 400);

		return Response::json([
			$specialty
		], 200);
	}

	/**
	 * Searching
	 */
	public function searchAction()
	{
		$search = trim(Input::get('search'));

		if (!strlen($search))
			return Response::json(['error' => "Ожидается поисковая строка 'search'"], 400);

		$employees = Employee::where('active', true)
			->where(function($query) use ($search)
			{
				$query->where('firstName', 'like', "%{$search}%")
					->orWhere('lastName', 'like', "%{$search}%");
			})
			->get();

		return Response::json([
			$employees
		], 200);
	}

	/**
	 * @param $id
	 */
	public function getByGroupAction($id)
	{
		$group = Group::find($id);

		if (!$group)
			return Response::json(['error' => "Запись id {$id} не найдена"], 400);

		$return = array();

		foreach ($group->employees as $employee)
			if ($employee->active)
				$return[] = $employee;

		return Response::json([
			$return
		], 200);
	}

	/**
	 * @param $id
	 */
	public function getByDepartmentAction($id)
	{
		$department = Department::find($id);

		if (!$department)
			return Response::json(['error' => "Запись id {$id} не найдена"], 400);

		$return = array();

		foreach ($department->employees as $employee)
			if ($employee->active)
				$return[] = $employee;

		return Response::json([
			$return
		], 200);
	}

	/**
	 * @param $id
	 */
	public function getBySpecialtyAction($id)
	{
		$specialty = Specialty::find($id);

		if (!$specialty)
			return Response::json(['error' => "Запись id {$id} не найдена"], 400);

		$return = array();

		foreach ($specialty->employees as $employee)
			if ($employee->active)
				$return[] = $employee;

		return Response::json([
			$return
		], 200);
	}

}