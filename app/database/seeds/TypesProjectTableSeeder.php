<?php

class TypesProjectTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		
		$types1 = array('name'=> "caro",'description'=> "bastante caro");
		$types2 = array('name'=> "simple",'description'=> "moderado");
		$types3 = array('name'=> "barato",'description'=> "2 por 1");
		// Uncomment the below to run the seeder

		DB::table('types_projects')->delete();
		
		 DB::table('types_projects')->insert($types1);
		 DB::table('types_projects')->insert($types2);
		 DB::table('types_projects')->insert($types3);
	}

}
