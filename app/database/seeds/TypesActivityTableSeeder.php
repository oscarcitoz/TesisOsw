<?php

class TypesActivityTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		
		$types1 = array('name'=> "Inspeccion",'description'=> "Visita a Lugares");
		$types2 = array('name'=> "Informe",'description'=> "Elaboracion de documento");
		$types3 = array('name'=> "Levantamiento Topografico",'description'=> "Lavantamiento de información");
		$types4 = array('name'=> "Estudio",'description'=> "Analisis de Casos");
		$types5 = array('name'=> "Avaluos",'description'=> "Cotizaciones");
		$types6 = array('name'=> "Encuesta",'description'=> "Estadisticas");
		$types7 = array('name'=> "Instalaciones",'description'=> "Obras");
		// Uncomment the below to run the seeder

		DB::table('types_activities')->delete();
		
		 DB::table('types_activities')->insert($types1);
		 DB::table('types_activities')->insert($types2);
		 DB::table('types_activities')->insert($types3);
		 DB::table('types_activities')->insert($types4);
		 DB::table('types_activities')->insert($types5);
		 DB::table('types_activities')->insert($types6);
	}

}
