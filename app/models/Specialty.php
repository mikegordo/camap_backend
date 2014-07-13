<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Specialty extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'specialty';

	/**
	 * Validation rules
	 */
	public static $rules = [
		'name' => 'required|min:2',
	];

	protected $guarded = ['id'];

	/**
	 * Specialty one-to-many Employees
	 *
	 * @return mixed
	 */
	public function employees()
	{
		return $this->hasMany('Employee');
	}

}
