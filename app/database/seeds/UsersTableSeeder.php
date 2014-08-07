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
                
                $user_role = DB::table('roles')
                                        ->select('id')
                                        ->where('name', 'gerente')
                                        ->first()
                                        ->id;
                
                $mod_role  = DB::table('roles')
                                        ->select('id')
                                        ->where('name', 'empleado')
                                        ->first()
                                        ->id;
                        

                                        $now = date('Y-m-d H:i:s');


		DB::table('users')->delete();

		$pass= Hash::make("20151526");

		$usuario1 = array('role_id'=> $admin_role,'email'=> "mamaOswaldo@hotmail.com",'password'=>$pass,'status'=>1,'flag'=>1, 'created_at' => $now,'updated_at' => $now,);
		$usuario2 = array('role_id'=> $user_role,'email'=> "oswaldo@hotmail.com",'password'=>$pass,'status'=>1,'flag'=>1,'created_at' => $now,'updated_at' => $now,);
		$usuario3 = array('role_id'=> $mod_role,'email'=> "mariaGabriela@hotmail.com",'password'=>$pass,'status'=>1,'flag'=>1,'created_at' => $now,'updated_at' => $now,);
		
		// Uncomment the below to run the seeder
		
	 DB::table('users')->insert($usuario1);
	  DB::table('users')->insert($usuario2);
	   DB::table('users')->insert($usuario3);

	}

}
