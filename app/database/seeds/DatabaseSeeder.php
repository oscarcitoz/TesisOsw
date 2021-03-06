<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		
		$this->call('RolesTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('EmployeeTableSeeder');
		$this->call('customersTableSeeder');
		$this->call('TypesProjectTableSeeder');
		$this->call('TypesActivityTableSeeder');
		
	}

}
