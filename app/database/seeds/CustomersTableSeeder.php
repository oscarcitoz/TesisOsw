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
	}

}
