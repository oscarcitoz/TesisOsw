<?php

class UsersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating

		  $admin_role = DB::table('roles')
                                        ->select('id')
                                        ->where('name', 'admin')
                                        ->first()
                                        ->id;
                        

                                        $now = date('Y-m-d H:i:s');


		DB::table('users')->delete();

		$pass= Hash::make("123456789");

		$usuario1 = array('role_id'=> $admin_role,'email'=> "consultoraintegral.ldt.c.a@gmail.com",'password'=>$pass,'status'=>1,'flag'=>0, 'created_at' => $now,'updated_at' => $now,);
		
		
		// Uncomment the below to run the seeder
		
	 DB::table('users')->insert($usuario1);


	}

}
