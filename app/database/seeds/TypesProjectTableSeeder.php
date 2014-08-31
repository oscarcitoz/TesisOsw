<?php

class TypesProjectTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		
		$types1 = array('name'=> "Ambientales",'description'=> "Proyectos Ambientales");
		$types2 = array('name'=> "Arquitectonicos",'description'=> "Proyectos Arquitectonicos");
		$types3 = array('name'=> "Ingenieria",'description'=> "Proyectos de Ingenieria");
		$types4 = array('name'=> "Urbanos",'description'=> "Proyectos Urbanos");
		$types5 = array('name'=> "Geotecnicos",'description'=> "Proyectos Geotecnicos");
		$types6 = array('name'=> "Ordenamiento Territorial",'description'=> "Proyectos Ordenamiento territorial");
		// Uncomment the below to run the seeder

		DB::table('types_projects')->delete();
		
		 DB::table('types_projects')->insert($types1);
		 DB::table('types_projects')->insert($types2);
		 DB::table('types_projects')->insert($types3);
		 DB::table('types_projects')->insert($types4);
		 DB::table('types_projects')->insert($types5);
		 DB::table('types_projects')->insert($types6);
	}

}
