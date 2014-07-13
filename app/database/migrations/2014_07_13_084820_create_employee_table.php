<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employee', function (Blueprint $table) {
			$table->increments('id');
			$table->string('firstName', '50');
			$table->string('lastName', '50');
			$table->string('photo', '100')->nullable();

			$table->integer('department_id')->unsigned()->nullable();
			$table->integer('group_id')->unsigned()->nullable();
			$table->integer('specialty_id')->unsigned()->nullable();

			$table->integer('cx')->nullable();
			$table->integer('cy')->nullable();
			$table->integer('cz')->nullable();

			$table->text('short')->nullable();
			$table->text('info')->nullable();

			$table->string('email', '100')->nullable();
			$table->string('phone', '32')->nullable();
			$table->string('mobile', '32')->nullable();
			$table->string('redmine', '100')->nullable();

			$table->boolean('active')->default(1);
			$table->timestamps();

			$table->foreign('department_id')->references('id')->on('department');
			$table->foreign('group_id')->references('id')->on('group');
			$table->foreign('specialty_id')->references('id')->on('specialty');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('employee');
	}

}
