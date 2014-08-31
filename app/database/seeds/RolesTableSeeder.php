<?php

class RolesTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('roles')->delete();

		$roles1 = array('name'=> "admin",'description'=> "Administrado de red");
		$roles2 = array('name'=> "gerente",'description'=> "Lideres de Proyecto");
		$roles3 = array('name'=> "empleado",'description'=> "Personal Contratado");
		// Uncomment the below to run the seeder
		 DB::table('roles')->insert($roles1);
		 DB::table('roles')->insert($roles2);
		 DB::table('roles')->insert($roles3);
	}

}
