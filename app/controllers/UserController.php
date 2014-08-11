<?php

class UserController extends BaseController 
{

		public function __construct()
	{
		$this->beforeFilter('auth');		
		//$this->beforeFilter('admin',array('only'=>array('create','destroy')));
		//$this->beforeFilter('adminGerente',array('only'=>array('admin_gerente')));
				

	}



	public function index(){

	}

	public function create(){

		print 'entro';
	}

	public function store(){

	
		
	}

	public function admin_gerente(){

		print 'entro';
		
	}



	public function show($id)
	{
		

	}

	public function edit(){

		$usuario=Auth::user();
		$login=$usuario->email;
		$perfil=$usuario->role()->first()->name;
		$empleado=$usuario->employee()->first();
		$nombre=$empleado->first_name;
		return View::make('users.edit', array('menu' => '2','nombre'=>$nombre,'login'=>$login,'perfil'=>$perfil,'empleado'=>$empleado,'menuIzq'=>'2'));

	
	}

	public function update()
	{
		$usuario=Auth::user();
				$rules= array(
					'nombre' =>'required',
					'apellido' =>'required',
					'cedula' =>'required',
					'telefonoLocal' =>'required',
					'telefonoCel' =>'required',
					'direccion' =>'required',
					'estadoCivil' =>'required',
					'nacimiento' =>'required|date_format:d/m/Y',
					'sexo' =>'required',
					'profesion' =>'required',
					'especialidad' =>'required',
					'curriculum'=>'mimes:pdf',
					'photo'=>'image',
					);

				$validator=Validator::make(Input::all(),$rules);

				if(!$validator->fails())
				{
					$empleado=$usuario->employee()->first();
					if(Input::file('curriculum')!= "")
					{
						$empleado->deleteArchivo();
						$empleado->subir(Input::file('curriculum'));
					}

					if(Input::file('photo')!= "")
					{
						$empleado->deletePhoto();
						$empleado->subirFoto(Input::file('photo'));
					}

					try
					{
					$affectedRows = Employee::where('user_id', '=', $usuario->id)->update(
						array('first_name' => Input::get('nombre'),
							'last_name' => Input::get('apellido'),
							'ident_card' => Input::get('cedula'),
							'phone_local' => Input::get('telefonoLocal'),
							'phone_cel' => Input::get('telefonoCel'),
							'address' => Input::get('direccion'),
							'civil_status' => Input::get('estadoCivil'),
							'date_birth' => Input::get('nacimiento'),
							'sex' => Input::get('sexo'),
							'profession' => Input::get('profesion'),
							'specialty' => Input::get('especialidad'),
							'curriculum' => $empleado->curriculum,
							'photo' => $empleado->photo,));
					
						return Redirect::to('/perfil/datosPersonales')->with('messagePersonal','Se modificaron los datos correctamente');

					}
					catch(Exception $e)
					{
						return Redirect::to('/perfil/datosPersonales/modificar')->with('messageEdit','Se produjo un error');

					}
				}
				else
				{
					return Redirect::to('perfil/datosPersonales/modificar')->withErrors($validator);
				}

	}


	public function destroy($id){

	}



}