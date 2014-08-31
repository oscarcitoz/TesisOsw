<?php

class EmployeeTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('employees')->delete();

		$User_id = DB::table('users')
                                    ->select('id')
                                    ->where('email', 'consultoraintegral.ldt.c.a@gmail.com')
                                    ->first()
                                    ->id;

	$roles1 = array('user_id'=> $User_id,'first_name'=>'Administrador','last_name'=>'Red','ident_card'=>'0000');

	DB::table('employees')->insert($roles1);

	}

}
