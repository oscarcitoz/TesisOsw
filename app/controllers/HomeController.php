<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/


		public function login()
	{

		return View::make('home.login');

	}


	public function logout(){

		Auth::logout();
		return Redirect::to('/');

	}
	public function authenticate(){

		//create validation rules
		$rules=array('email'=>'required|email','password'=>'required|min:8');
			$validator= Validator::make(Input::all(),$rules);
			if(! $validator->fails()){

				if(Auth::attempt(array('email'=>Input::get('email'),'password'=>Input::get('password'))))
				{
					return Redirect::intended('/');

				}

				else
				{
					//Redirect to login form with error message
					return Redirect::to('/login')->with('message','Olvido su clave?')->withInput();

				}

			}

			else
				{
					//Redirect to login form with error message
					return Redirect::to('/login')->with('message','Llene los campos Por favor')->withInput()->withErrors($validator);

				}
	}



		public function proyecto()
	{
		$usuario=Auth::user();
		$nombre=$usuario->employee()->first()->first_name;
		return View::make('ventanas.proyecto', array('menu' => '3','nombre'=>$nombre,));
	}

		public function consultora()
	{
		$usuario=Auth::user();
		$nombre=$usuario->employee()->first()->first_name;
		return View::make('ventanas.miConsultora', array('menu' => '1','nombre'=>$nombre,));
	}


}
