<?php

class ProjectTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating

		  		$types_id = DB::table('types_projects')
                                        ->select('id')
                                        ->where('name', 'caro')
                                        ->first()
                                        ->id;
                
                $customer_id = DB::table('customers')
                                        ->select('id')
                                        ->where('name', 'Jose')
                                        ->first()
                                        ->id;
                $User_id = DB::table('users')
                                    ->select('id')
                                    ->where('email', 'mamaOswaldo@hotmail.com')
                                    ->first()
                                    ->id;
                $now = date('Y-m-d H:i:s');


		DB::table('projects')->delete();

		$usuario1 = array('types_project_id'=> $types_id,'user_id'=> $User_id,'customer_id'=> $customer_id,'description'=>" la descripcion del proyecto",'status'=>"Propuesta", 'amount_contract'=> 454.65465, 'document_budget'=> "aqui esta el documento", 'name'=> "Proyecto numero 6", 'locality'=> "en tu casa marico", 'date_create' => $now,'date_end' => $now,);

		$usuario2 = array('types_project_id'=> $types_id,'user_id'=> $User_id,'customer_id'=> $customer_id,'description'=>" la descripcion del proyecto",'status'=>"Ejecucion", 'amount_contract'=> 45465465, 'document_budget'=> "aqui esta el documento", 'name'=> "Proyecto numero 2", 'locality'=> "en tu casa marico", 'date_create' => $now,'date_end' => $now,);

		$usuario3 = array('types_project_id'=> $types_id,'user_id'=> $User_id,'customer_id'=> $customer_id,'description'=>" la descripcion del proyecto",'status'=>"Parado", 'amount_contract'=> 45465465, 'document_budget'=> "aqui esta el documento", 'name'=> "Proyecto numero 3", 'locality'=> "en tu casa marico", 'date_create' => $now,'date_end' => $now,);

		$usuario4 = array('types_project_id'=> $types_id,'user_id'=> $User_id,'customer_id'=> $customer_id,'description'=>" la descripcion del proyecto",'status'=>"Acostado", 'amount_contract'=> 45465465, 'document_budget'=> "aqui esta el documento", 'name'=> "Proyecto numero 4", 'locality'=> "en tu casa marico", 'date_create' => $now,'date_end' => $now,);

		$usuario5 = array('types_project_id'=> $types_id,'user_id'=> $User_id,'customer_id'=> $customer_id,'description'=>" la descripcion del proyecto",'status'=>"En tu ano", 'amount_contract'=> 45465465, 'document_budget'=> "aqui esta el documento", 'name'=> "Proyecto numero 5", 'locality'=> "en tu casa marico", 'date_create' => $now,'date_end' => $now,);

		$usuario6 = array('types_project_id'=> $types_id,'user_id'=> $User_id,'customer_id'=> $customer_id,'description'=>" la descripcion del proyecto",'status'=>"ya no se", 'amount_contract'=> 45465465, 'document_budget'=> "aqui esta el documento", 'name'=> "Proyecto numero 1", 'locality'=> "en tu casa marico", 'date_create' => $now,'date_end' => $now,);

		
		// Uncomment the below to run the seeder
		
	 DB::table('projects')->insert($usuario1);
	  DB::table('projects')->insert($usuario2);
	   DB::table('projects')->insert($usuario3);
	   DB::table('projects')->insert($usuario4);
	  DB::table('projects')->insert($usuario5);
	   DB::table('projects')->insert($usuario6);

	}

}
