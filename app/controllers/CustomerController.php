<?php

class CustomerController extends BaseController {


		public function __construct()
	{
		$this->beforeFilter('auth');		
			
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



}