<?php

/**
 * Class EmployeeController
 *
 * @author Mike Gordo <m.gordo@cityads.ru>
 */
class EmployeeController extends BaseController
{
	/**
	 * Return a list of employees
	 */
	public function indexAction()
	{
		$employees = Employee::where('active', true)->get();

		return Response::json([
			$employees
		], 200);
	}

	/**
	 * Create a new employee
	 */
	public function storeAction()
	{
		$data = Input::all();

		if (empty($data))
			return Response::json(['error' => 'Запрос пустой'], 400);

		$validation = Validator::make($data, Employee::$rules);

		if (!$validation->passes())
			return Response::json(['error' => $validation->messages()], 400);

		if (array_key_exists('department', $data)) {
			$data['department_id'] = is_numeric($data['department']) ? (int)$data['department'] : $data['department'];
			unset($data['department']);
		}
		if (array_key_exists('specialty', $data)) {
			$data['specialty_id'] = is_numeric($data['specialty']) ? (int)$data['specialty'] : $data['specialty'];
			unset($data['specialty']);
		}
		if (array_key_exists('group', $data)) {
			$data['group_id'] = is_numeric($data['group']) ? (int)$data['group'] : $data['group'];
			unset($data['group']);
		}

		/**
		 * Если вместо (int) department, (int) group, (int) specialty с клиента
		 * приходит текст (и такого нет в базе), значит нужно добавить соответствующую запись,
		 * присвоить ее данному сотруднику и вернуть его обратно.
		 */
		if (array_key_exists('department_id', $data) && !is_null($data['department_id']) && !is_numeric($data['department_id']) && strlen($data['department_id']) > 0) {
			$data['department_id'] = $this->createDepartmentIfNecessary($data['department_id']);
		}
		if (array_key_exists('specialty_id', $data) && !is_null($data['specialty_id']) && !is_numeric($data['specialty_id']) && strlen($data['specialty_id']) > 0) {
			$data['specialty_id'] = $this->createSpecialtyIfNecessary($data['specialty_id']);
		}
		if (array_key_exists('group_id', $data) && !is_null($data['group_id']) && !is_numeric($data['group_id']) && strlen($data['group_id']) > 0) {
			$data['group_id'] = $this->createGroupIfNecessary($data['group_id']);
		}

		$employee = Employee::create($data);

		$employee->department = is_null($employee->department) ? null : $employee->department->toJson();
		$employee->group      = is_null($employee->group) ? null : $employee->group->toJson();
		$employee->specialty  = is_null($employee->specialty) ? null : $employee->specialty->toJson();

		return Response::json([
			$employee
		], 200);
	}

	/**
	 * Get a single employee
	 *
	 * @param $id
	 */
	public function showAction($id)
	{
		$employee = Employee::find($id);

		if (!$employee)
			return Response::json(['error' => "Запись id {$id} не найдена"], 400);

		$employee->department = is_null($employee->department) ? null : $employee->department->toJson();
		$employee->group      = is_null($employee->group) ? null : $employee->group->toJson();
		$employee->specialty  = is_null($employee->specialty) ? null : $employee->specialty->toJson();

		return Response::json([
			$employee
		], 200);
	}

	/**
	 * Update the employee
	 *
	 * @param $id
	 */
	public function updateAction($id)
	{
		$employee = Employee::find($id);

		if (!$employee)
			return Response::json(['error' => "Запись id {$id} не найдена"], 400);

		$data = Input::all();

		if (empty($data))
			return Response::json(['error' => 'Запрос пустой'], 400);

		$validation = Validator::make($data, Employee::$rules);

		if (!$validation->passes())
			return Response::json(['error' => $validation->messages()], 400);

		if (array_key_exists('department', $data)) {
			$data['department_id'] = is_numeric($data['department']) ? (int)$data['department'] : $data['department'];
			unset($data['department']);
		}
		if (array_key_exists('specialty', $data)) {
			$data['specialty_id'] = is_numeric($data['specialty']) ? (int)$data['specialty'] : $data['specialty'];
			unset($data['specialty']);
		}
		if (array_key_exists('group', $data)) {
			$data['group_id'] = is_numeric($data['group']) ? (int)$data['group'] : $data['group'];
			unset($data['group']);
		}

		if (array_key_exists('department_id', $data) && !is_null($data['department_id']) && !is_numeric($data['department_id']) && strlen($data['department_id']) > 0) {
			$data['department_id'] = $this->createDepartmentIfNecessary($data['department_id']);
		}
		if (array_key_exists('specialty_id', $data) && !is_null($data['specialty_id']) && !is_numeric($data['specialty_id']) && strlen($data['specialty_id']) > 0) {
			$data['specialty_id'] = $this->createSpecialtyIfNecessary($data['specialty_id']);
		}
		if (array_key_exists('group_id', $data) && !is_null($data['group_id']) && !is_numeric($data['group_id']) && strlen($data['group_id']) > 0) {
			$data['group_id'] = $this->createGroupIfNecessary($data['group_id']);
		}

		$employee->update($data);
		$employee->save();

		$employee->department = is_null($employee->department) ? null : $employee->department->toJson();
		$employee->group      = is_null($employee->group) ? null : $employee->group->toJson();
		$employee->specialty  = is_null($employee->specialty) ? null : $employee->specialty->toJson();

		return Response::json([
			$employee
		], 200);
	}

	/**
	 * Fire this guy
	 *
	 * @param $id
	 */
	public function deleteAction($id)
	{
		$employee = Employee::find($id);

		if (!$employee)
			return Response::json(['error' => "Запись id {$id} не найдена"], 400);

		DB::table('employee')->where('id', $id)->delete();

		return Response::json(null, 200);
	}

	/**
	 * Если вместо (int) department, (int) group, (int) specialty с клиента
	 * приходит текст (и такого нет в базе), значит нужно добавить соответствующую запись,
	 * присвоить ее данному сотруднику и вернуть его обратно.
	 *
	 * @param $name
	 *
	 * @return null
	 */
	private function createDepartmentIfNecessary($name)
	{
		$department = Department::where('name', trim($name))->take(1)->get();

		if (!$department->count()) {
			// add a department
			$validation = Validator::make(['name' => trim($name)], Department::$rules);
			if ($validation->passes()) {
				$department = Department::create(['name' => trim($name)]);

				return $department->id;
			} else {
				// unable to create a department
				return null;
			}
		} else {
			return $department->first()->id;
		}
	}

	private function createSpecialtyIfNecessary($name)
	{
		$specialty = Specialty::where('name', trim($name))->take(1)->get();

		if (!$specialty->count()) {
			// add a specialty
			$validation = Validator::make(['name' => trim($name)], Specialty::$rules);
			if ($validation->passes()) {
				$specialty = Specialty::create(['name' => trim($name)]);

				return $specialty->id;
			} else {
				// unable to create
				return null;
			}
		} else {
			return $specialty->first()->id;
		}
	}

	private function createGroupIfNecessary($name)
	{
		$group = Group::where('name', trim($name))->take(1)->get();

		if (!$group->count()) {
			// add a specialty
			$validation = Validator::make(['name' => trim($name)], Group::$rules);
			if ($validation->passes()) {
				$group = Group::create(['name' => trim($name)]);

				return $group->id;
			} else {
				// unable to create
				return null;
			}
		} else {
			return $group->first()->id;
		}
	}

}