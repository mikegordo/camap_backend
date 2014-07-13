<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Employee extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'employee';

	/**
	 * Validation rules
	 */
	public static $rules = [
		'firstName' => 'required|min:2',
		'lastName'  => 'required|min:2',
		'cx'        => 'integer',
		'cy'        => 'integer',
		'cz'        => 'integer',
		'email'     => 'email',
	];

	protected $guarded = ['id'];

	/**
	 * Related department
	 */
	public function department()
	{
		return $this->belongsTo('Department');
	}

	/**
	 * Related group
	 */
	public function group()
	{
		return $this->belongsTo('Group');
	}

	/**
	 * Related specialty
	 */
	public function specialty()
	{
		return $this->belongsTo('Specialty');
	}

}
