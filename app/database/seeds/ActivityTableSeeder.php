<?php

class ActivityTableSeeder extends Seeder {

	public function run()
	{

		$types_id = DB::table('types_activities')
                                        ->select('id')
                                        ->where('name', 'caro')
                                        ->first()
                                        ->id;
		$User_id = DB::table('users')
                                    ->select('id')
                                    ->where('email', 'mamaOswaldo@hotmail.com')
                                    ->first()
                                    ->id;
		$projects_id1 = DB::table('projects')
                                        ->select('id')
                                        ->where('name', 'Proyecto numero 1')
                                        ->first()
                                        ->id;
		$now = date('Y-m-d H:i:s');

		// Uncomment the below to wipe the table clean before populating
		
		$types1 = array('types_activitie_id'=> $types_id,"project_id" => $projects_id1, "user_id" => $User_id, "description" => "primera actividad", "status" => 1, "date_create" => $now , "date_proposal" => $now, "date_end" => $now);
		$types2 = array('types_activitie_id'=> $types_id,"project_id" => $projects_id1, "user_id" => $User_id, "description" => "primera actividad", "status" => 1, "date_create" => $now , "date_proposal" => $now, "date_end" => $now);
		$types3 = array('types_activitie_id'=> $types_id,"project_id" => $projects_id1, "user_id" => $User_id, "description" => "primera actividad", "status" => 1, "date_create" => $now , "date_proposal" => $now, "date_end" => $now);
		$types4 = array('types_activitie_id'=> $types_id,"project_id" => $projects_id1, "user_id" => $User_id, "description" => "primera actividad", "status" => 1, "date_create" => $now , "date_proposal" => $now, "date_end" => $now);
		$types5 = array('types_activitie_id'=> $types_id,"project_id" => $projects_id1, "user_id" => $User_id, "description" => "primera actividad", "status" => 1, "date_create" => $now , "date_proposal" => $now, "date_end" => $now);
		$types6 = array('types_activitie_id'=> $types_id,"project_id" => $projects_id1, "user_id" => $User_id, "description" => "primera actividad", "status" => 1, "date_create" => $now , "date_proposal" => $now, "date_end" => $now);
		// Uncomment the below to run the seeder


		 DB::table('activities')->delete();
		 
		 DB::table('activities')->insert($types1);
		 DB::table('activities')->insert($types2);
		 DB::table('activities')->insert($types3);
		 DB::table('activities')->insert($types4);
		 DB::table('activities')->insert($types2);
		 DB::table('activities')->insert($types6);		
		
	}

}
