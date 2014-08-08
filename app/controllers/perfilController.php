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
		$nombre=$usuario->employee()->first()->first_name;

		return View::make('ventanas.perfil', array('menu' => '2','nombre'=>$nombre,'login'=>$login,'perfil'=>$perfil,));

	}

	public function passwordEdit()
	{
		$usuario=Auth::user();
		$nombre=$usuario->employee()->first()->first_name;
		return View::make('users/changePass', array('menu' => '2','nombre'=>$nombre,));
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

		function exportar()
		{
			$exportar=Input::get('exportar');
			echo $exportar;
			return View::make('users/reporte', array('exportar' => $exportar,));
		}
		
}