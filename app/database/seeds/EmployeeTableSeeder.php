<?php

class EmployeeTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('employees')->delete();

		$User_id = DB::table('users')
                                    ->select('id')
                                    ->where('email', 'mamaOswaldo@hotmail.com')
                                    ->first()
                                    ->id;

	$roles1 = array('user_id'=> $User_id,'first_name'=>'MAMA','last_name'=>'Oswaldo','ident_card'=>'56456456');

	DB::table('employees')->insert($roles1);

	}

}
