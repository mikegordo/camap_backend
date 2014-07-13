<?php

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		/**
		 * Insert default user
		 */
		$password = Hash::make('12345');
		DB::table('users')->insert(
			[
				'email'      => 'm.gordo@cityads.ru',
				'password'   => $password,
				'created_at' => date('Y-m-d H:i:s')
			]
		);

		/**
		 * Create departments
		 */
		DB::table('department')->insert(
			[
				'id'         => 1,
				'name'       => 'Администрация',
				'created_at' => date('Y-m-d H:i:s')
			]
		);
		DB::table('department')->insert(
			[
				'id'         => 2,
				'name'       => 'Департамент по операциям и финансам',
				'created_at' => date('Y-m-d H:i:s')
			]
		);
		DB::table('department')->insert(
			[
				'id'         => 3,
				'name'       => 'Департамент продаж',
				'created_at' => date('Y-m-d H:i:s')
			]
		);
		DB::table('department')->insert(
			[
				'id'         => 4,
				'name'       => 'Департамент аккаунтинга',
				'created_at' => date('Y-m-d H:i:s')
			]
		);
		DB::table('department')->insert(
			[
				'id'         => 5,
				'name'       => 'Департамент партнерских отношений',
				'created_at' => date('Y-m-d H:i:s')
			]
		);
		DB::table('department')->insert(
			[
				'id'         => 6,
				'name'       => 'Арт департамент',
				'created_at' => date('Y-m-d H:i:s')
			]
		);
		DB::table('department')->insert(
			[
				'id'         => 7,
				'name'       => 'Департамент производства',
				'created_at' => date('Y-m-d H:i:s')
			]
		);
		DB::table('department')->insert(
			[
				'id'         => 8,
				'name'       => 'Департамент IT',
				'created_at' => date('Y-m-d H:i:s')
			]
		);
		DB::table('department')->insert(
			[
				'id'         => 9,
				'name'       => 'Проектный департамент',
				'created_at' => date('Y-m-d H:i:s')
			]
		);

		/**
		 * Create a default group
		 */
		DB::table('group')->insert(
			[
				'id'         => 1,
				'name'       => 'Отдел разработки',
				'created_at' => date('Y-m-d H:i:s')
			]
		);

		/**
		 * Create a default speciality
		 */
		DB::table('specialty')->insert(
			[
				'id'         => 1,
				'name'       => 'Разработчик web-интерфейсов',
				'created_at' => date('Y-m-d H:i:s')
			]
		);
		DB::table('specialty')->insert(
			[
				'id'         => 2,
				'name'       => 'Программист PHP',
				'created_at' => date('Y-m-d H:i:s')
			]
		);

		/**
		 * Create Artem Fitiskin
		 */
		DB::table('employee')->insert(
			[
				'firstName'     => 'Артём',
				'lastName'      => 'Фитискин',
				'email'         => 'a.fitiskin@cityads.ru',
				'department_id' => 8,
				'group_id'      => 1,
				'specialty_id'  => 1,
				'created_at'    => date('Y-m-d H:i:s'),
				'cx'            => 770,
				'cy'            => 65,
				'cz'            => 0
			]
		);

		/**
		 * Create Mike Gordo
		 */
		DB::table('employee')->insert(
			[
				'firstName'     => 'Михаил',
				'lastName'      => 'Гордо',
				'email'         => 'm.gordo@cityads.ru',
				'department_id' => 8,
				'group_id'      => 1,
				'created_at'    => date('Y-m-d H:i:s'),
				'cx'            => 800,
				'cy'            => 65,
				'cz'            => 0
			]
		);

	}

}
