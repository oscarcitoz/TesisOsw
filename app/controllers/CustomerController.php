<?php

class CustomerController extends BaseController {


		public function __construct()
	{
		$this->beforeFilter('auth');	
		$this->beforeFilter('admin',array('only'=>array('edit','update')));	
		$this->beforeFilter('adminGerente',array('only'=>array('updateCustomer','editCustomer','buscarCustomer','CrearCustomer','RegistrarCustomer')));
	}

	public function index()
	{
		$id=1;
		$usuario=Auth::user();
		$empleado=$usuario->employee()->first();
		$nombre=$empleado->first_name;
		$customer=Customer::find($id);
		$roles = Role::all()->lists('name', 'id');
      	//$combobox = array(0 => "Seleccione ... ") + $roles;
      	$combobox=$roles;
      	$selected = array();
		return View::make('ventanas.empresa', compact('combobox', 'selected'), array('menu' => '4','nombre'=>$nombre,'customer'=>$customer,'menuIzq'=>'1'));

	}

		public function indexRegistrar()
	{
		$id=1;
		$usuario=Auth::user();
		$empleado=$usuario->employee()->first();
		$nombre=$empleado->first_name;
		$customer=Customer::find($id);
		$roles = Role::all()->lists('name', 'id');
      	//$combobox = array(0 => "Seleccione ... ") + $roles;
      	$combobox=$roles;
      	$selected = array();
		return View::make('ventanas.empresa', compact('combobox', 'selected'), array('menu' => '4','nombre'=>$nombre,'customer'=>$customer,'menuIzq'=>'2'));

	}

		public function edit(){
		$id=1;
		$usuario=Auth::user();
		$empleado=$usuario->employee()->first();
		$nombre=$empleado->first_name;
		$customer=Customer::find($id);
		$roles = Role::all()->lists('name', 'id');
      	//$combobox = array(0 => "Seleccione ... ") + $roles;
      	$combobox=$roles;
      	$selected = array();
		return View::make('customers.edit', compact('combobox', 'selected'), array('menu' => '4','nombre'=>$nombre,'customer'=>$customer,'menuIzq'=>'1'));

	
	}

	public function update()
	{
				$rules= array(
					'phone' =>'required',
					'locality' =>'required',
					'phone_contact' =>'required',
					'person_contact' =>'required',
					);

				$validator=Validator::make(Input::all(),$rules);

				if(!$validator->fails())
				{
					try
					{
					$affectedRows = Customer::where('id', '=', 1)->update(
						array('phone' => Input::get('phone'),
							'locality' => Input::get('locality'),
							'phone_contact' => Input::get('phone_contact'),
							'person_contact' => Input::get('person_contact'),));
					
						return Redirect::to('/empresa')->with('messageConsultora','Se modificaron los datos correctamente');

					}
					catch(Exception $e)
					{
						return Redirect::to('/empresa/modificar')->with('messageEdit','Se produjo un error');

					}
				}
				else
				{
					return Redirect::to('/empresa/modificar')->withErrors($validator);
				}

	}

	public function buscarCustomer(){

		if((isset($_GET['term'])))
		{
			$name=$_GET['term'];
			$customer=Customer::where('name', 'LIKE', '%'.$name.'%')
			->where('id','!=','1')
			->get()->toJson();
			return $customer;
		}
	}

	public function CrearCustomer(){
		
		return View::make('ventanas.customer.customer');		
	}

	public function editCustomer($id){

		$customer = Customer::find($id);
		return View::make('ventanas.customer.editCustomer', array('customer'=>$customer));		
	}

	

	public function RegistrarCustomer(){
		$rules=array(
			'name' => 'required', 
			'rif' => '',
			'email' => 'required|email|unique:customers,email',
			'locality' => 'required',
			'phone' => 'numeric|min:999999999',
			'person_contact' => 'required',
			'phone_contact' => 'required|numeric|min:999999999',
		);	
		$validator=Validator::make(Input::all(),$rules);

		if(!$validator->fails())
		{
			$Customer = new Customer();
			$Customer->name = Input::get('name');
			$Customer->rif = Input::get('rif');
			$Customer->email = Input::get('email');
			$Customer->locality = Input::get('locality');
			$Customer->phone = Input::get('phone');
			$Customer->person_contact = Input::get('person_contact');
			$Customer->phone_contact = Input::get('phone_contact');
			try {
				$Customer->save();
				return Redirect::to('/customer/crear')->with('messageRegistrar','Se Registró el cliente correctamente');
			} catch (Exception $e) {
				return Redirect::to('/customer/crear')->with('messageErrorRegis','Se produjo un error')->withInput();	
			}
		}else{
			return Redirect::to('/customer/crear')->withErrors($validator)->withInput();
		}
	}

	public function updateCustomer(){
		$id=Input::get('invisible');
		if($id=="" or $id=="null"){
			return Redirect::to('/');
		}else{
			$Customer=Customer::find($id);
		}
		$rules= array(
			'invisible' =>'required',
			'name' => 'required', 
			'rif' => '',
			'locality' => 'required',
			'phone' => 'numeric|min:999999999',
			'person_contact' => 'required',
			'phone_contact' => 'required|numeric|min:999999999',
			);

		if( Input::has('email') && Input::get('email') !== $Customer->email )
		{
			$rules['email'] = 'required|email|unique:customers,email';
		}
		else
		{
			$rules['email'] = 'required|max:50';
		}

		$validator=Validator::make(Input::all(),$rules);
		if(!$validator->fails()){
			$Customer->name = Input::get('name');
			$Customer->rif = Input::get('rif');
			$Customer->email = Input::get('email');
			$Customer->locality = Input::get('locality');
			$Customer->phone = Input::get('phone');
			$Customer->person_contact = Input::get('person_contact');
			$Customer->phone_contact = Input::get('phone_contact');
			//return $Customer;
			try{
				$Customer->save();
				return Redirect::to('/customer/edtiCustomer'.'/'.$id)->with('messageRegistrar','Se modificaron los datos correctamente');
			}
			catch(Exception $e)
			{
				return Redirect::to('/customer/edtiCustomer'.'/'.$id)->with('messageErrorRegis','Se produjo un error');
			}
		}else{
			return Redirect::to('/customer/edtiCustomer'.'/'.$id)->withErrors($validator);
		}
	}

}