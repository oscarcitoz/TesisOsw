<?php

class CustomersTableSeeder extends Seeder {

	public function run()
	{
		// Uncomment the below to wipe the table clean before populating
		DB::table('customers')->delete();

		$consultora = array('name'=> "Consultora Integral L.D.T.,C.A",'rif'=> "j-26398242-0",
			'email'=> "consultoraintegralldt.c.a@gmail.com",'phone'=> "02124904689",
			'locality'=> "Caracas, Edo Miranda Municipio Sucre. Urb El Llanito",
			'logo'=>'logo/LOGO.png',
			'phone_contact'=> "04143105040",'person_contact'=> "04143105040");
			// Uncomment the below to run the seeder
		 DB::table('customers')->insert($consultora);

		$types1 = array('name'=> "Jose",'rif'=> "bastante caro",'email'=> "bastante caro",'phone'=> "bastante caro",'locality'=> "bastante caro",'logo'=> "bastante caro",'phone_contact'=> "bastante caro",'person_contact'=> "bastante caro");
		$types2 = array('name'=> "Rafael",'rif'=> "bastante caro",'email'=> "bastante caro",'phone'=> "bastante caro",'locality'=> "bastante caro",'logo'=> "bastante caro",'phone_contact'=> "bastante caro",'person_contact'=> "bastante caro");
		$types3 = array('name'=> "Medina",'rif'=> "bastante caro",'email'=> "bastante caro",'phone'=> "bastante caro",'locality'=> "bastante caro",'logo'=> "bastante caro",'phone_contact'=> "bastante caro",'person_contact'=> "bastante caro");
		// Uncomment the below to run the seeder



		 
		 DB::table('customers')->insert($types1);
		 DB::table('customers')->insert($types2);
		 DB::table('customers')->insert($types3);
	}

}
