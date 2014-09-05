<?php

class UserController extends BaseController 
{

		public function __construct()
	{
		$this->beforeFilter('auth');		
		$this->beforeFilter('admin',array('only'=>array('store','actualizaStatus')));
		//$this->beforeFilter('adminGerente',array('only'=>array('admin_gerente')));
				

	}



	public function index(){

	}

	public function create(){

		
	}


	public function buscarNombre2(){
			$nombre="";
			$empleados="";
			if((isset($_GET['term'])))
			{
				$var=$_GET['term'];
				$var = trim($var);
				$pos = strrpos($var, " ");
				if ($pos === false) { 
					
				$nombre=$var;
				$empleados=DB::table('employees')->join('users', 'employees.user_id', '=', 'users.id')->where('employees.first_name', 'LIKE', '%'.$nombre.'%')->where('users.status', '=', 1)->get();
				
				}
				else { 

					$lista=explode(" ",$var);
				
					$empleados=DB::table('employees')->join('users', 'employees.user_id', '=', 'users.id')->where(function ($query) use ($lista) {
				    $query->where('employees.first_name', 'LIKE', '%'.$lista[0].'%')
				    	->where('employees.last_name', 'LIKE', '%'.$lista[1].'%')
							->where('users.status', '=', 1);})->get();
				
				}
				
				return $empleados;
			}

			
	}



		public function buscarNombre(){
			$nombre="";
			$empleados="";
			if((isset($_GET['term'])))
			{
				$var=$_GET['term'];
				$var = trim($var);
				$pos = strrpos($var, " ");
				if ($pos === false) { 
					
				$nombre=$var;
				if(Auth::user()->role->name=='admin'){
				$empleados=Employee::where('first_name', 'LIKE', '%'.$nombre.'%')->get()->toJson();
				}
				else 
				{
				$empleados=DB::table('employees')->join('users', 'employees.user_id', '=', 'users.id')->where('employees.first_name', 'LIKE', '%'.$nombre.'%')->where('users.status', '=', 1)->get();
				}
				}
				else { 

					$lista=explode(" ",$var);
				if(Auth::user()->role->name=='admin'){
					$empleados=Employee::where(function ($query) use ($lista) {
				    $query->where('first_name', 'LIKE', '%'.$lista[0].'%')
				    	->where('last_name', 'LIKE', '%'.$lista[1].'%');})->get()->toJson();
				}
				else 
				{
					$empleados=DB::table('employees')->join('users', 'employees.user_id', '=', 'users.id')->where(function ($query) use ($lista) {
				    $query->where('employees.first_name', 'LIKE', '%'.$lista[0].'%')
				    	->where('employees.last_name', 'LIKE', '%'.$lista[1].'%')
							->where('users.status', '=', 1);})->get();
				}
				}
				
				return $empleados;
			}

			
	}

		public function buscarCedula(){

			if((isset($_GET['term'])))
			{
				$cedu=$_GET['term'];
				if(Auth::user()->role->name=='admin'){
				$empleados=Employee::where('ident_card', 'LIKE', '%'.$cedu.'%')->get()->toJson();
				}
				else 
				{
				$empleados=DB::table('employees')->join('users', 'employees.user_id', '=', 'users.id')->where('employees.ident_card', 'LIKE', '%'.$cedu.'%')->where('users.status', '=', 1)->get();
				}

				
				return $empleados;
			}

		
	}

		public function buscarProfesion(){

			$data = array();
			
			array_push($data, "Viernes", "Sábado");
			if((isset($_GET['term'])))
			{
				$profe=$_GET['term'];
				$profesiones=Employee::where('profession', 'LIKE', '%'.$profe.'%')->select('profession')->distinct()->get();
				
				return $profesiones;
			}
		}


		public function show(){
				 if(Request::ajax()){

			$rules=array(
			'buscar' =>'required',
			'busque' =>'required',
			);
				$validator=Validator::make(Input::all(),$rules);

			if(!$validator->fails())
			{
				$metodo= Input::get('busque');
				$parametro= Input::get('invisible');
				if($metodo=="nombre"  ||  $metodo=="cedula"){
					//$empleados=Employee::where('user_id', '=', $parametro)->get();
					$empleados1=User::where('id', '=', $parametro)->with('employee')->get()->toJson();
					//$empleado=$usu->employee()->first();
					//$emmpleado->civil_status=$usu->status;
					//$empleados=User::where('id', '=', $parametro)->with('employee')->get();
					if ($empleados1!==null){
						
					return $empleados1;}
					else return 0;
				}
						else {

							if(Auth::user()->role->name=='admin'){
								$empleados=Employee::where('profession', '=', $parametro)->get();
							}
							else{
							$empleados=DB::table('employees')->join('users', 'employees.user_id', '=', 'users.id')->where('profession', '=', $parametro)->where('users.status', '=', 1)->get();
							}
							if ($empleados!==null){
						foreach ($empleados as $empleado) {
							$usi=User::where('id', '=', $empleado->user_id)->first();
							$empleado->user_id=$empleado->user_id."|".$usi->status;
						}
						return $empleados;
					}
						else return 0;	

						}
			}
			else{

				return 1;
			}
		
		}
		
	}

	public function verUsuario($id)
	{
		try{
		if(Auth::user()->role->name=='admin'){
		$usuario=User::where('id', '=',  $id)->first();
		}
		else 
		{
		$usuario=User::where('id', '=',  $id)->where('status', '=',  1)->first();	
		}
		if($usuario!==null){
		$empleado=$usuario->employee()->first();
		$login=$usuario->email;
		$status=$usuario->status;
		try {
			$fecha= explode("-", $empleado->date_birth);
			$fecha=$fecha[2].'-'.$fecha[1].'-'.$fecha[0];
			}
			catch(Exception $e)
			{
				$fecha="";
			}
		return View::make('users.show', array('empleado'=>$empleado,'login'=>$login,'id'=>$id,'status'=>$status,'fecha'=>$fecha));
		}
		else{
		echo "NO encontrado";}
		}catch (Exception $e) {

				echo "ERROR! ".$e->getMessage();

			}

	}

	public function actualizaStatus()
	{
		 if(Request::ajax()){
		 	$id= Input::get('id');
		 	try{
		$usuario=User::where('id', '=',  $id)->first();
		$statusIni=$usuario->status;
		if ($statusIni ==1)
		{
			$usuario->status=0;
		}
		else {
			$usuario->status=1;
		}
		$usuario->save();
		}catch (Exception $e) {

				echo "ERROR! ".$e->getMessage();

			}
		 }
		return $usuario->status;

	}
	public function store(){

		$rules=array(
			'first_name' =>'required|min:3',
			'last_name' =>'required|min:3',
			'ident_card'=>'required|min:6',
			//'username' =>'required|max:50|unique:users,username',
			'email' =>'required|email|unique:users,email',
			'rol'=>'required',
			);

		$validator=Validator::make(Input::all(),$rules);

		if(!$validator->fails())
		{

			$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
			$pass = "";
			for($i=0;$i<12;$i++) {
			$pass .= substr($str,rand(0,62),1);
			}
			

			$user= new User();
			$user->role_id= Input::get('rol');
			$user->email= Input::get('email');
			$user->password= Hash::make($pass);
			$user->status= 1;
			$user->flag= 0;
			$employee = new Employee();
			$employee->first_name=Input::get('first_name');
			$employee->last_name=Input::get('last_name');
			$employee->ident_card= Input::get('ident_card');


			try
			{
				$user->save();
				$employee->user_id= $user->id;
				$employee->save();

			}

			catch (Exception $e) {
				//return $e;

				return Redirect::to('/empresa/registrar')->with('messageErrorRegis','Se produjo un error, verifique sus datos')->withInput();

			}
			//try
		//	{
				$data = array(
				'img' => 'images/LOGO.png',
			    'customer' => Input::get('first_name').' '.Input::get('last_name'),
			    'pass' => $pass
				);
				Mail::send('emails.contra', $data, function($message)
				{
				    $message->to(Input::get('email'), Input::get('first_name').' '.Input::get('last_name'))->subject('Buenas, ha sido registrado en el aplicativo de la Consultora.');
				});
		//		}

		//	catch (Exception $e) {

		//		return Redirect::to('/empresa/registrar')->with('messageRegistrar2','Se Registró al usuario correctamente pero no pudo ser enviado el correo con los datos');

		//	}
			
			
			return Redirect::to('/empresa/registrar')->with('messageRegistrar','Se Registró al usuario correctamente y se ha enviado un correo con los datos');

		}
		else
				{
					
					return Redirect::to('/empresa/registrar')->withErrors($validator)->withInput();
				}
	}

	public function admin_gerente(){

		print 'entro';
		
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
					'nombre' =>'required|min:3',
					'apellido' =>'required|min:3',
					'cedula' =>'required|min:6',
					'telefonoLocal' =>'required|min:6',
					'telefonoCel' =>'required|min:6',
					'direccion' =>'required|min:6',
					'estadoCivil' =>'required',
					'nacimiento' =>'required', 
					'sexo' =>'required',
					'profesion' =>'required|min:3',
					'especialidad' =>'required|min:3',
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
					$fecha= explode("-", Input::get('nacimiento'));
					$affectedRows = Employee::where('user_id', '=', $usuario->id)->update(
						array('first_name' => Input::get('nombre'),
							'last_name' => Input::get('apellido'),
							'ident_card' => Input::get('cedula'),
							'phone_local' => Input::get('telefonoLocal'),
							'phone_cel' => Input::get('telefonoCel'),
							'address' => Input::get('direccion'),
							'civil_status' => Input::get('estadoCivil'),
							'date_birth' => $fecha[2].'-'.$fecha[1].'-'.$fecha[0],
							'sex' => Input::get('sexo'),
							'profession' => Input::get('profesion'),
							'specialty' => Input::get('especialidad'),
							'curriculum' => $empleado->curriculum,
							'photo' => $empleado->photo,));
					$usuario->flag=1;
					$usuario->save();
				
					
						return Redirect::to('/perfil/datosPersonales')->with('messagePersonal','Se modificaron los datos correctamente');

					}
					catch(Exception $e)
					{
						return Redirect::to('/perfil/datosPersonales/modificar')->with('messageEdit','Se produjo un error')->withInput();

					}
				}
				else
				{
					return Redirect::to('perfil/datosPersonales/modificar')->withErrors($validator)->withInput();
				}

	}


	public function destroy($id){

	}



}