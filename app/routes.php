<?php

Route::pattern('id', '[0-9]+');
Route::get('/', [
		'as'   => 'base',
		'uses' => 'HomeController@defaultAction'
	]
);

/**
 * Administering
 */
Route::when('admin/*', 'auth');
Route::get('admin', [
		'as'     => 'admin',
		'before' => 'auth',
		'uses'   => 'AdminController@defaultAction'
	]
);

/**
 * Administering users
 */
Route::get('admin/users', [
		'as'   => 'users.index',
		'uses' => 'UserController@indexAction'
	]
);
Route::get('admin/users/create', [
		'as'   => 'users.create',
		'uses' => 'UserController@createAction'
	]
);
Route::post('admin/users', [
		'as'     => 'users.store',
		'before' => 'csrf',
		'uses'   => 'UserController@storeAction'
	]
);
Route::get('admin/users/{id}', [
		'as'   => 'users.show',
		'uses' => 'UserController@showAction'
	]
);
Route::get('admin/users/{id}/edit', [
		'as'   => 'users.edit',
		'uses' => 'UserController@editAction'
	]
);
Route::put('admin/users/{id}', [
		'as'     => 'users.update',
		'before' => 'csrf',
		'uses'   => 'UserController@updateAction'
	]
);
Route::delete('admin/users/{id}', [
		'as'   => 'users.destroy',
		'uses' => 'UserController@deleteAction'
	]
);

/**
 * Departments
 */
Route::get('admin/departments', [
		'as'   => 'departments.index',
		'uses' => 'DepartmentController@indexAction'
	]
);
Route::get('admin/departments/create', [
		'as'   => 'departments.create',
		'uses' => 'DepartmentController@createAction'
	]
);
Route::post('admin/departments', [
		'as'     => 'departments.store',
		'before' => 'csrf',
		'uses'   => 'DepartmentController@storeAction'
	]
);
Route::get('admin/departments/{id}', [
		'as'   => 'departments.show',
		'uses' => 'DepartmentController@showAction'
	]
);
Route::get('admin/departments/{id}/edit', [
		'as'   => 'departments.edit',
		'uses' => 'DepartmentController@editAction'
	]
);
Route::put('admin/departments/{id}', [
		'as'     => 'departments.update',
		'before' => 'csrf',
		'uses'   => 'DepartmentController@updateAction'
	]
);
Route::delete('admin/departments/{id}', [
		'as'   => 'departments.destroy',
		'uses' => 'DepartmentController@deleteAction'
	]
);

/**
 * Groups
 */
Route::get('admin/groups', [
		'as'   => 'groups.index',
		'uses' => 'GroupController@indexAction'
	]
);
Route::get('admin/groups/create', [
		'as'   => 'groups.create',
		'uses' => 'GroupController@createAction'
	]
);
Route::post('admin/groups', [
		'as'     => 'groups.store',
		'before' => 'csrf',
		'uses'   => 'GroupController@storeAction'
	]
);
Route::get('admin/groups/{id}', [
		'as'   => 'groups.show',
		'uses' => 'GroupController@showAction'
	]
);
Route::get('admin/groups/{id}/edit', [
		'as'   => 'groups.edit',
		'uses' => 'GroupController@editAction'
	]
);
Route::put('admin/groups/{id}', [
		'as'     => 'groups.update',
		'before' => 'csrf',
		'uses'   => 'GroupController@updateAction'
	]
);
Route::delete('admin/groups/{id}', [
		'as'   => 'groups.destroy',
		'uses' => 'GroupController@deleteAction'
	]
);

/**
 * specialties
 */
Route::get('admin/specialties', [
		'as'   => 'specialties.index',
		'uses' => 'SpecialtyController@indexAction'
	]
);
Route::get('admin/specialties/create', [
		'as'   => 'specialties.create',
		'uses' => 'SpecialtyController@createAction'
	]
);
Route::post('admin/specialties', [
		'as'     => 'specialties.store',
		'before' => 'csrf',
		'uses'   => 'SpecialtyController@storeAction'
	]
);
Route::get('admin/specialties/{id}', [
		'as'   => 'specialties.show',
		'uses' => 'SpecialtyController@showAction'
	]
);
Route::get('admin/specialties/{id}/edit', [
		'as'   => 'specialties.edit',
		'uses' => 'SpecialtyController@editAction'
	]
);
Route::put('admin/specialties/{id}', [
		'as'     => 'specialties.update',
		'before' => 'csrf',
		'uses'   => 'SpecialtyController@updateAction'
	]
);
Route::delete('admin/specialties/{id}', [
		'as'   => 'specialties.destroy',
		'uses' => 'SpecialtyController@deleteAction'
	]
);

/**
 * Employees
 */
Route::get('admin/employees', [
		'as'   => 'employees.index',
		'uses' => 'EmployeeController@indexAction'
	]
);
Route::post('admin/employees', [
		'as'     => 'employees.store',
		'before' => 'csrf',
		'uses'   => 'EmployeeController@storeAction'
	]
);
Route::get('admin/employees/{id}', [
		'as'   => 'employees.show',
		'uses' => 'EmployeeController@showAction'
	]
);
Route::put('admin/employees/{id}', [
		'as'     => 'employees.update',
		'before' => 'csrf',
		'uses'   => 'EmployeeController@updateAction'
	]
);
Route::delete('admin/employees/{id}', [
		'as'   => 'employees.destroy',
		'uses' => 'EmployeeController@deleteAction'
	]
);

/**
 * Json - works without authorization
 */
Route::get('ajax/employees', [
		'as'   => 'ajax.employees.index',
		'uses' => 'EmployeeController@indexAction'
	]
);
Route::get('ajax/employees/{id}', [
		'as'   => 'ajax.employees.show',
		'uses' => 'EmployeeController@showAction'
	]
);
Route::any('ajax/employees/search', [
		'as'   => 'ajax.employees.search',
		'uses' => 'AjaxController@searchAction'
	]
);
Route::get('ajax/employees/groups/{id}', [
		'as'   => 'ajax.employees.groups',
		'uses' => 'AjaxController@getByGroupAction'
	]
);
Route::get('ajax/employees/departments/{id}', [
		'as'   => 'ajax.employees.departments',
		'uses' => 'AjaxController@getByDepartmentAction'
	]
);
Route::get('ajax/employees/specialties/{id}', [
		'as'   => 'ajax.employees.specialties',
		'uses' => 'AjaxController@getBySpecialtyAction'
	]
);
Route::get('ajax/groups', [
		'as'   => 'ajax.groups.index',
		'uses' => 'AjaxController@groupsAction'
	]
);
Route::get('ajax/groups/{id}', [
		'as'   => 'ajax.groups.show',
		'uses' => 'AjaxController@groupAction'
	]
);
Route::get('ajax/departments', [
		'as'   => 'ajax.departments.index',
		'uses' => 'AjaxController@departmentsAction'
	]
);
Route::get('ajax/departments/{id}', [
		'as'   => 'ajax.departments.show',
		'uses' => 'AjaxController@departmentAction'
	]
);
Route::get('ajax/specialties', [
		'as'   => 'ajax.specialties.index',
		'uses' => 'AjaxController@specialtiesAction'
	]
);
Route::get('ajax/specialties/{id}', [
		'as'   => 'ajax.specialties.show',
		'uses' => 'AjaxController@specialtyAction'
	]
);

/**
 * Authentication
 */
Route::get('/login', [
		'as'   => 'login.get',
		'uses' => 'SecurityController@loginAction'
	]
);
Route::post('/login', [
		'as'     => 'login.post',
		'before' => 'csrf',
		'uses'   => 'SecurityController@loginAttempt'
	]
);
Route::get('/logout', [
		'as'   => 'logout',
		'uses' => 'SecurityController@logoutAction'
	]
);