<?php

class perfilController extends BaseController {


		public function __construct()
	{
		$this->beforeFilter('auth');		
			
	}



	function index()
	{
		$usuario=Auth::user();
		$login=$usuario->email;
		$perfil=$usuario->role()->first()->name;
		$empleado=$usuario->employee()->first();
		try {
			$fecha= explode("-", $empleado->date_birth);
			$fecha=$fecha[2].'-'.$fecha[1].'-'.$fecha[0];
			}
			catch(Exception $e)
			{
				$fecha="";
			}
		$nombre=$empleado->first_name;
		return View::make('ventanas.perfil', array('menu' => '2','nombre'=>$nombre,'login'=>$login,'perfil'=>$perfil,'empleado'=>$empleado,'fecha'=>$fecha,'menuIzq'=>'1'));

	}

	function indexCurriculum()
	{
		$usuario=Auth::user();
		$login=$usuario->email;
		$perfil=$usuario->role()->first()->name;
		$empleado=$usuario->employee()->first();
		$nombre=$empleado->first_name;
		try {
			$fecha= explode("-", $empleado->date_birth);
			$fecha=$fecha[2].'-'.$fecha[1].'-'.$fecha[0];
			}
			catch(Exception $e)
			{
				$fecha="";
			}
		return View::make('ventanas.perfil', array('menu' => '2','nombre'=>$nombre,'login'=>$login,'perfil'=>$perfil,'empleado'=>$empleado,'fecha'=>$fecha,'menuIzq'=>'3'));

	}


	function indexDatosPersonales()
	{
		$usuario=Auth::user();
		$login=$usuario->email;
		$perfil=$usuario->role()->first()->name;
		$empleado=$usuario->employee()->first();
		$nombre=$empleado->first_name;
		try {
			$fecha= explode("-", $empleado->date_birth);
			$fecha=$fecha[2].'-'.$fecha[1].'-'.$fecha[0];
			}
			catch(Exception $e)
			{
				$fecha="";
			}
		return View::make('ventanas.perfil', array('menu' => '2','nombre'=>$nombre,'login'=>$login,'perfil'=>$perfil,'empleado'=>$empleado,'fecha'=>$fecha,'menuIzq'=>'2'));

	}

	public function passwordEdit()
	{
		$usuario=Auth::user();
		$login=$usuario->email;
		$empleado=$usuario->employee()->first();
		$nombre=$empleado->first_name;
		try {
			$fecha= explode("-", $empleado->date_birth);
			$fecha=$fecha[2].'-'.$fecha[1].'-'.$fecha[0];
			}
			catch(Exception $e)
			{
				$fecha="";
			}
		return View::make('users/changePass', array('menu' => '2','nombre'=>$nombre,'empleado'=>$empleado,'login'=>$login,'menuIzq'=>'1','fecha'=>$fecha));
	}
	public function passwordUpdate()
	{
			$user=Auth::user();
			if(Hash::check(Input::get('current_password'),$user->password))
			{
				$rules= array(
					'new_password' =>'confirmed|min:8',
					'new_password_confirmation'=>'same:new_password'
					);

				$validator=Validator::make(Input::all(),$rules);

				if(!$validator->fails())
				{
					if(Input::has('new_password')&& Input::get('new_password')!=='')
					{
						$user->password=Hash::make(Input::get('new_password'));
					}

					try
					{
						$user->save();
						return Redirect::to('/perfil')->with('message','Se ha modificado correctamente la contraseña');

					}
					catch(Exception $e)
					{
						return Redirect::to('/perfil/changePassword')->with('message','Se produjo un error');

					}
				}
				else
				{
					return  Redirect::to('/perfil/changePassword')->withErrors($validator);
				}
			}
			else{

					return Redirect::to('/perfil/changePassword')->with('message','Contraseña Actual incorrecta');
				}

		}



			public function storeCurriculum()
	{
		//
		$rules=array('curriculum'=>'required|mimes:pdf');
		$validator=Validator::make(Input::all(),$rules);

		if(!$validator->fails())
			{
				
			try
				{

					$usuario=Auth::user();
					$empleado=$usuario->employee()->first();
					$empleado->deleteArchivo();
					$empleado->subir(Input::file('curriculum'));
					$affectedRows = Employee::where('user_id', '=', $empleado->user_id)->update(array('curriculum' => $empleado->curriculum));
					return Redirect::to('/perfil/curriculum');

				}

			catch (Exception $e) {
				return Redirect::to('/perfil/curriculum')->with('error',$e->getMessage())->withInput();

			}


			}
			else
			{
				return Redirect::to('/perfil/curriculum')->with('error','Formato de archivo incorrecto')->withInput()->withErrors($validator);
			}


		

	}


		
}