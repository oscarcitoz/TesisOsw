<?php

class customersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		
		$types1 = array('name'=> "Jose",'rif'=> "bastante caro",'email'=> "bastante caro",'phone'=> "bastante caro",'locality'=> "bastante caro",'logo'=> "bastante caro",'phone_contact'=> "bastante caro",'person_contact'=> "bastante caro");
		$types2 = array('name'=> "Rafael",'rif'=> "bastante caro",'email'=> "bastante caro",'phone'=> "bastante caro",'locality'=> "bastante caro",'logo'=> "bastante caro",'phone_contact'=> "bastante caro",'person_contact'=> "bastante caro");
		$types3 = array('name'=> "Medina",'rif'=> "bastante caro",'email'=> "bastante caro",'phone'=> "bastante caro",'locality'=> "bastante caro",'logo'=> "bastante caro",'phone_contact'=> "bastante caro",'person_contact'=> "bastante caro");
		// Uncomment the below to run the seeder


		 DB::table('customers')->delete();
		 
		 DB::table('customers')->insert($types1);
		 DB::table('customers')->insert($types2);
		 DB::table('customers')->insert($types3);


		
		
		
		
		
		
		
	}

}
