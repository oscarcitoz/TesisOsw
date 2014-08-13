<?php

class ProjectUserTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('project_user')->delete();

		$projects_id1 = DB::table('projects')
                                        ->select('id')
                                        ->where('name', 'Proyecto numero 1')
                                        ->first()
                                        ->id;

		$projects_id2 = DB::table('projects')
                                        ->select('id')
                                        ->where('name', 'Proyecto numero 2')
                                        ->first()
                                        ->id;

        $projects_id3 = DB::table('projects')
                                        ->select('id')
                                        ->where('name', 'Proyecto numero 3')
                                        ->first()
                                        ->id;

        $projects_id4 = DB::table('projects')
                                        ->select('id')
                                        ->where('name', 'Proyecto numero 4')
                                        ->first()
                                        ->id;

        $projects_id5 = DB::table('projects')
                                        ->select('id')
                                        ->where('name', 'Proyecto numero 5')
                                        ->first()
                                        ->id;

        $projects_id6 = DB::table('projects')
                                        ->select('id')
                                        ->where('name', 'Proyecto numero 6')
                                        ->first()
                                        ->id;

		$User_id = DB::table('users')
                                    ->select('id')
                                    ->where('email', 'mamaOswaldo@hotmail.com')
                                    ->first()
                                    ->id;

        $now = date('Y-m-d H:i:s');


		$roles1 = array('project_id'=> $projects_id1,'user_id'=> $User_id,'date_create'=> $now);
		$roles2 = array('project_id'=> $projects_id2,'user_id'=> $User_id,'date_create'=> $now);
		$roles3 = array('project_id'=> $projects_id3,'user_id'=> $User_id,'date_create'=> $now);
        $roles4 = array('project_id'=> $projects_id4,'user_id'=> $User_id,'date_create'=> $now);
        $roles5 = array('project_id'=> $projects_id5,'user_id'=> $User_id,'date_create'=> $now);
        $roles6 = array('project_id'=> $projects_id6,'user_id'=> $User_id,'date_create'=> $now);
		// Uncomment the below to run the seeder
		 DB::table('project_user')->insert($roles1);
		 DB::table('project_user')->insert($roles2);
		 DB::table('project_user')->insert($roles3);
         DB::table('project_user')->insert($roles4);
         DB::table('project_user')->insert($roles5);
         DB::table('project_user')->insert($roles6);
	}

}

