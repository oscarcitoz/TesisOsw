<?php
 
class ProjectController extends BaseController 
{

	public function __construct(){
		$this->beforeFilter('auth');
	}

	public function proyecto()
	{
		$usuario=Auth::user();
		$nombre=$usuario->employee()->first()->first_name;

		$combobox = Project::join('types_projects', 'types_projects.id', '=', 'projects.types_project_id')
			->distinct()
			->select('types_projects.id','types_projects.name');
		$combobox = $combobox->lists("name","id");
      	$selected = array();

      	$combobox1 = Project::distinct()->lists("status","status");
      	$selected1 = array();

      	$combobox2 = Types_project::all()->lists("name","id");
      	$selected2 = array();
		return View::make('ventanas.proyecto', array('menu' => '3','nombre'=>$nombre,'menuIzq'=>'1','combobox'=>$combobox,'selected'=>$selected,'combobox1'=>$combobox1,'selected1'=>$selected1,'combobox2'=>$combobox2,'selected2'=>$selected2));
	}


public function proyectoReg()
	{
		$usuario=Auth::user();
		$nombre=$usuario->employee()->first()->first_name;

		$combobox = Project::join('types_projects', 'types_projects.id', '=', 'projects.types_project_id')
			->distinct()
			->select('types_projects.id','types_projects.name');
		$combobox = $combobox->lists("name","id");
      	$selected = array();

      	$combobox1 = Project::distinct()->lists("status","status");
      	$selected1 = array();

      	$combobox2 = Types_project::all()->lists("name","id");
      	$selected2 = array();
		return View::make('ventanas.proyecto', array('menu' => '3','nombre'=>$nombre,'menuIzq'=>'2','combobox'=>$combobox,'selected'=>$selected,'combobox1'=>$combobox1,'selected1'=>$selected1,'combobox2'=>$combobox2,'selected2'=>$selected2));
	}

	public function consultora()
	{
		$nombre=Auth::user();
		$count_project = $nombre->proyect()->count();	
		
		$project = $nombre->proyect()->orderBy('date_create','desc')->take(5)->get();
		$array_list = array();
		foreach ($project as $pro) {
			$lis_aux = new Detalle_project();
			$lis_aux->name = $pro->name;
			$lis_aux->status = $pro->status;
			$lis_aux->locality = $pro->locality;
			$lis_aux->first_name =$pro->user()->first()->employee()->first()->first_name;
			array_push($array_list, $lis_aux);
		}

		$array_list2 = array();
		$count_activity = $nombre->activitie()->count();	
		$activity = $nombre->activitie()->orderBy('date_create','desc')->take(5)->get();
		foreach ($activity as $act) {
			$lis_aux = new Detalle_Activity();
			$lis_aux->name = $act->types_activitie()->first()->name;
			$lis_aux->date_proposal = $act->date_proposal;
			$lis_aux->status = $act->status;
			$lis_aux->id = $act->id;
			$lis_aux->description = $act->description;
			array_push($array_list2, $lis_aux);
		}

		return View::make('miConsultora.miConsultora', array('menu' => '1','nombre'=>$nombre->email,"project"=>$array_list,"activity"=>$array_list2,"count_project"=>$count_project,"count_activity"=>$count_activity));
	}

	public function consultora_project()
	{
		$nombre = Auth::user();		
		$project = $nombre->proyect()->orderBy('date_create','desc')->paginate(3);
		$count_activity = $nombre->activitie()->count();
		$activity = $nombre->activitie()->orderBy('date_create','desc')->take(5)->get();

		return View::make('miConsultora.miConsultora_Project', array('menu' => '1','nombre'=>$nombre->email,"project" => $project,"activity"=>$activity,"count_activity"=>$count_activity));
	}

	public function buscarProyect(){

		if((isset($_GET['term'])))
		{
			$name=$_GET['term'];
			$project=Project::join('employees', 'projects.user_id', '=', 'employees.user_id')
			->where('name', 'LIKE', '%'.$name.'%')
			->get()->toJson();
			return $project;
		}
	}

	public function buscarLocal(){

		if((isset($_GET['term'])))
		{
			$locality=$_GET['term'];
			$project=Project::where('locality', 'LIKE', '%'.$locality.'%')->get()->toJson();
			return $project;
		}		
	}

	public function buscarTipo(){
		if(Request::ajax()){
			$rules=array(
			'buscar' =>'required',
			);
			$validator=Validator::make(Input::all(),$rules);
			if(!$validator->fails())
			{
				$parametro= Input::get('buscar');
				$project=Project::join('employees', 'projects.user_id', '=', 'employees.user_id')
				->where('types_project_id', $parametro)
				->get()->toJson();
			return $project;		
			}else{

				return 0;
			}
		}
	}

	public function buscarStatus(){
		if(Request::ajax()){
			$rules=array(
			'buscar' =>'required',
			);
			$validator=Validator::make(Input::all(),$rules);
			if(!$validator->fails())
			{
				$parametro= Input::get('buscar');
				$project=Project::join('employees', 'projects.user_id', '=', 'employees.user_id')
				->where('status', $parametro)
				->get()->toJson();
			return $project;		
			}else{

				return 0;
			}
		}
	}

	public function create(){
		$rules=array(
			'name' => 'required', 
			'description' => 'required',
			'locality' => 'required',
			'types_project_id' => 'required',
		);	
		$validator=Validator::make(Input::all(),$rules);

		if(!$validator->fails())
		{
			$now = date('Y-m-d H:i:s');
			$project = new Project();
			$project->name = Input::get('name');
			$project->description = Input::get('description');
			$project->locality = Input::get('locality');
			$project->customer_id = Input::get('invisible');
			$project->types_project_id = Input::get('types_project_id');
			$project->user_id = Auth::user()->id;
			$project->status = "Propuesta";
			$project->amount_contract = 0.0;
			$project->date_create = $now;

			$record= new Record();
			$record->status="Propuesta";
			$record->comment="Se da inicio al proyecto";
			$record->date_create=$now;
			
			
			try {
				$project->save();
				$record->project_id=$project->id;	
				$record->save();
				return Redirect::to('/project/registrar')->with('messageRegistrar','Se Registró al usuario correctamente y se ha enviado un correo con los datos');
			} catch (Exception $e) {
				return Redirect::to('/project/registrar')->with('messageErrorRegis','Se produjo un error')->withInput();	
			}
		}else{
			return Redirect::to('/project/registrar')->withErrors($validator)->withInput();
		}
	}

	public function proyectoIndividual($id)
	{
		$Project=Project::join('employees', 'projects.user_id', '=', 'employees.user_id')
				->where('projects.id', $id)
				->first();
		$Customer=$Project->Customer()->first();
		$status = array('Propuesta' => 'Propuesta', 
			'Adjudicado' => 'Adjudicado', 
			'Ejecución' => 'Ejecución', 
			'Paralizado' => 'Paralizado', 
			'Finalizado' => 'Finalizado', 
			'Cerrado' => 'Cerrado', );
		$usuario=Auth::user();
		$document_project=$Project->Documents_project()->get();
		$record=$Project->Record()->get();
		$types_activitie=Types_activitie::all()->lists("name","id");
		$employees=$Project->user()->get();
		$array_list = array();
		foreach ($employees as $emplo) {
			$lis_aux = new Employee_project();
			$lis_aux->first_name = $emplo->employee()->first()->first_name;
			$lis_aux->last_name = $emplo->employee()->first()->last_name;
			$lis_aux->ident_card = $emplo->employee()->first()->ident_card;
			$lis_aux->profession = $emplo->employee()->first()->profession;
			$lis_aux->specialty = $emplo->employee()->first()->specialty;
			$lis_aux->status = $emplo->first()->status;
			array_push($array_list, $lis_aux);
		}
		$activity = $Project->activitie()->get();
		$array_list2 = array();
		foreach ($activity as $act) {
			$lis_aux = new Detalle_Activity();
			$lis_aux->name = $act->types_activitie()->first()->name;
			$lis_aux->date_proposal = $act->date_proposal;
			$lis_aux->status = $act->status;
			$lis_aux->id = $act->id;
			$lis_aux->description = $act->description;
			array_push($array_list2, $lis_aux);
		}
		$nombre=$usuario->employee()->first()->first_name;	
		return View::make('ventanas.proyectoIndividual', array('menu' => '3','nombre'=>$nombre,'menuIzq'=>'1','project'=>$Project,'combox'=>$status,'Customer'=>$Customer,'document_project'=>$document_project,'record'=>$record,'types_activitie'=>$types_activitie,'employees'=>$array_list,'activity'=>$array_list2));
	}


	public function proyectoDocument($id)
	{
		$Project=Project::join('employees', 'projects.user_id', '=', 'employees.user_id')
				->where('projects.id', $id)
				->first();
		$Customer=$Project->Customer()->first();
		$status = array('Propuesta' => 'Propuesta', 
			'Adjudicado' => 'Adjudicado', 
			'Ejecución' => 'Ejecución', 
			'Paralizado' => 'Paralizado', 
			'Finalizado' => 'Finalizado', 
			'Cerrado' => 'Cerrado', );
		$usuario=Auth::user();
		$document_project=$Project->Documents_project()->get();
		$record=$Project->Record()->get();
		$types_activitie=Types_activitie::all()->lists("name","id");
		$employees=$Project->user()->get();
		$array_list = array();
		foreach ($employees as $emplo) {
			$lis_aux = new Employee_project();
			$lis_aux->first_name = $emplo->employee()->first()->first_name;
			$lis_aux->last_name = $emplo->employee()->first()->last_name;
			$lis_aux->ident_card = $emplo->employee()->first()->ident_card;
			$lis_aux->profession = $emplo->employee()->first()->profession;
			$lis_aux->specialty = $emplo->employee()->first()->specialty;
			$lis_aux->status = $emplo->first()->status;
			array_push($array_list, $lis_aux);
		}
		$activity = $Project->activitie()->get();
		$array_list2 = array();
		foreach ($activity as $act) {
			$lis_aux = new Detalle_Activity();
			$lis_aux->name = $act->types_activitie()->first()->name;
			$lis_aux->date_proposal = $act->date_proposal;
			$lis_aux->status = $act->status;
			$lis_aux->id = $act->id;
			$lis_aux->description = $act->description;
			array_push($array_list2, $lis_aux);
		}
		$nombre=$usuario->employee()->first()->first_name;	
		return View::make('ventanas.proyectoIndividual', array('menu' => '3','nombre'=>$nombre,'menuIzq'=>'2','project'=>$Project,'combox'=>$status,'Customer'=>$Customer,'document_project'=>$document_project,'record'=>$record,'types_activitie'=>$types_activitie,'employees'=>$array_list,'activity'=>$array_list2));
	}

	public function proyectoDocument_varios($id)
	{
		$Project=Project::join('employees', 'projects.user_id', '=', 'employees.user_id')
				->where('projects.id', $id)
				->first();
		$Customer=$Project->Customer()->first();
		$status = array('Propuesta' => 'Propuesta', 
			'Adjudicado' => 'Adjudicado', 
			'Ejecución' => 'Ejecución', 
			'Paralizado' => 'Paralizado', 
			'Finalizado' => 'Finalizado', 
			'Cerrado' => 'Cerrado', );
		$usuario=Auth::user();
		$document_project=$Project->Documents_project()->get();
		$record=$Project->Record()->get();
		$types_activitie=Types_activitie::all()->lists("name","id");
		$employees=$Project->user()->get();
		$array_list = array();
		foreach ($employees as $emplo) {
			$lis_aux = new Employee_project();
			$lis_aux->first_name = $emplo->employee()->first()->first_name;
			$lis_aux->last_name = $emplo->employee()->first()->last_name;
			$lis_aux->ident_card = $emplo->employee()->first()->ident_card;
			$lis_aux->profession = $emplo->employee()->first()->profession;
			$lis_aux->specialty = $emplo->employee()->first()->specialty;
			$lis_aux->status = $emplo->first()->status;
			array_push($array_list, $lis_aux);
		}
		$activity = $Project->activitie()->get();
		$array_list2 = array();
		foreach ($activity as $act) {
			$lis_aux = new Detalle_Activity();
			$lis_aux->name = $act->types_activitie()->first()->name;
			$lis_aux->date_proposal = $act->date_proposal;
			$lis_aux->status = $act->status;
			$lis_aux->id = $act->id;
			$lis_aux->description = $act->description;
			array_push($array_list2, $lis_aux);
		}
		$nombre=$usuario->employee()->first()->first_name;	
		return View::make('ventanas.proyectoIndividual', array('menu' => '3','nombre'=>$nombre,'menuIzq'=>'3','project'=>$Project,'combox'=>$status,'Customer'=>$Customer,'document_project'=>$document_project,'record'=>$record,'types_activitie'=>$types_activitie,'employees'=>$array_list,'activity'=>$array_list2));
	}

	public function proyectoStatus($id)
	{
		$Project=Project::join('employees', 'projects.user_id', '=', 'employees.user_id')
				->where('projects.id', $id)
				->first();
		$Customer=$Project->Customer()->first();
		$status = array('Propuesta' => 'Propuesta', 
			'Adjudicado' => 'Adjudicado', 
			'Ejecución' => 'Ejecución', 
			'Paralizado' => 'Paralizado', 
			'Finalizado' => 'Finalizado', 
			'Cerrado' => 'Cerrado', );
		$usuario=Auth::user();
		$document_project=$Project->Documents_project()->get();
		$record=$Project->Record()->get();
		$types_activitie=Types_activitie::all()->lists("name","id");
		$employees=$Project->user()->get();
		$array_list = array();
		foreach ($employees as $emplo) {
			$lis_aux = new Employee_project();
			$lis_aux->first_name = $emplo->employee()->first()->first_name;
			$lis_aux->last_name = $emplo->employee()->first()->last_name;
			$lis_aux->ident_card = $emplo->employee()->first()->ident_card;
			$lis_aux->profession = $emplo->employee()->first()->profession;
			$lis_aux->specialty = $emplo->employee()->first()->specialty;
			$lis_aux->status = $emplo->first()->status;
			array_push($array_list, $lis_aux);
		}
		$activity = $Project->activitie()->get();
		$array_list2 = array();
		foreach ($activity as $act) {
			$lis_aux = new Detalle_Activity();
			$lis_aux->name = $act->types_activitie()->first()->name;
			$lis_aux->date_proposal = $act->date_proposal;
			$lis_aux->status = $act->status;
			$lis_aux->id = $act->id;
			$lis_aux->description = $act->description;
			array_push($array_list2, $lis_aux);
		}
		$nombre=$usuario->employee()->first()->first_name;	
		return View::make('ventanas.proyectoIndividual', array('menu' => '3','nombre'=>$nombre,'menuIzq'=>'4','project'=>$Project,'combox'=>$status,'Customer'=>$Customer,'document_project'=>$document_project,'record'=>$record,'types_activitie'=>$types_activitie,'employees'=>$array_list,'activity'=>$array_list2));
	}

	public function proyectoAct($id)
	{
		$Project=Project::join('employees', 'projects.user_id', '=', 'employees.user_id')
				->where('projects.id', $id)
				->first();
		$Customer=$Project->Customer()->first();
		$status = array('Propuesta' => 'Propuesta', 
			'Adjudicado' => 'Adjudicado', 
			'Ejecución' => 'Ejecución', 
			'Paralizado' => 'Paralizado', 
			'Finalizado' => 'Finalizado', 
			'Cerrado' => 'Cerrado', );
		$usuario=Auth::user();
		$document_project=$Project->Documents_project()->get();
		$record=$Project->Record()->get();
		$types_activitie=Types_activitie::all()->lists("name","id");
		$employees=$Project->user()->get();
		$array_list = array();
		foreach ($employees as $emplo) {
			$lis_aux = new Employee_project();
			$lis_aux->first_name = $emplo->employee()->first()->first_name;
			$lis_aux->last_name = $emplo->employee()->first()->last_name;
			$lis_aux->ident_card = $emplo->employee()->first()->ident_card;
			$lis_aux->profession = $emplo->employee()->first()->profession;
			$lis_aux->specialty = $emplo->employee()->first()->specialty;
			$lis_aux->status = $emplo->first()->status;
			array_push($array_list, $lis_aux);
		}
		$activity = $Project->activitie()->get();
		$array_list2 = array();
		foreach ($activity as $act) {
			$lis_aux = new Detalle_Activity();
			$lis_aux->name = $act->types_activitie()->first()->name;
			$lis_aux->date_proposal = $act->date_proposal;
			$lis_aux->status = $act->status;
			$lis_aux->id = $act->id;
			$lis_aux->description = $act->description;
			array_push($array_list2, $lis_aux);
		}
		$nombre=$usuario->employee()->first()->first_name;	
		return View::make('ventanas.proyectoIndividual', array('menu' => '3','nombre'=>$nombre,'menuIzq'=>'6','project'=>$Project,'combox'=>$status,'Customer'=>$Customer,'document_project'=>$document_project,'record'=>$record,'types_activitie'=>$types_activitie,'employees'=>$array_list,'activity'=>$array_list2));
	}

	public function proyectoEdit($id){

		$Project=Project::join('employees', 'projects.user_id', '=', 'employees.user_id')
				->where('projects.id', $id)
				->first();
		$Customer=$Project->Customer()->first();
		$status = array('Propuesta' => 'Propuesta', 
			'Adjudicado' => 'Adjudicado', 
			'Ejecución' => 'Ejecución', 
			'Paralizado' => 'Paralizado', 
			'Finalizado' => 'Finalizado', 
			'Cerrado' => 'Cerrado', );	
		return View::make('ventanas.proyectoIndividual.editProject', array('project'=>$Project,'combox'=>$status));
	}

	public function actualizaMonto()
	{
		if(Request::ajax()){
			$rules=array(
				'id' => 'required', 
				'amount' => 'required|numeric',
			);	
			$validator=Validator::make(Input::all(),$rules);
			if(!$validator->fails())
			{
				$id= Input::get('id');
		 		$amount= Input::get('amount');
				try{
					$project=Project::where('id', '=',  $id)->first();
					$project->amount_contract=$amount;
					$project->save();
				}catch (Exception $e) {
						return "ERROR! Ha ocurrido un error Inesperado, intente nuevamente";
				}
				return $project->amount_contract;
			}else{
				return "ERROR! Por favor validar el dato colocado en el campo 'Monto Total Contratado'";
			}
		}
	}

	public function actualizaDocument()
	{
		$id=Input::get('invisible');
		if($id=="" or $id=="null"){
			return Redirect::to('/');
		}else{
			$Project=Project::find($id);
		}
		$rules=array(
			'document_budget'=>'required|mimes:xls,xlsx,pdf',
			'invisible' => 'required', 
		);	
		$validator=Validator::make(Input::all(),$rules);
		if(!$validator->fails())
		{
			try{
				$Project->deleteArchivo();
				$Project->subir(Input::file('document_budget'));
				$Project->document_budget;
				$Project->save();
				return Redirect::to('/project/individual/document'.'/'.$id)->with('messageRegistrar','Se Registró al usuario correctamente y se ha enviado un correo con los datos');
			}catch (Exception $e) {
					return Redirect::to('/project/individual/document'.'/'.$id)->with('messageErrorRegis','Se produjo un error')->withInput();
			}
		}else{
			return Redirect::to('/project/individual/document'.'/'.$id)->withErrors($validator)->withInput();
		}
	
	}





	public function CambiarStatus()
	{
		$id=Input::get('invisible');
		if($id=="" or $id=="null"){
			return Redirect::to('/');
		}else{
			$Project=Project::find($id);
		}
		$rules=array(
			'status'=>'required',
			'invisible' => 'required',
			'comment' => 'required', 
		);	
		$validator=Validator::make(Input::all(),$rules);
		if(!$validator->fails())
		{
			$status = array(0 => 'Propuesta', 
							1 => 'Adjudicado', 
							2 => 'Ejecución', 
							3 => 'Finalizado', );	
			$now = date('Y-m-d H:i:s');
			$ultRecord=$Project->record()->whereNotIn('status', array('Paralizado','Cerrado'))->orderby('date_create','DESC')->take(1)->first();
			
			$aux1=array_search($ultRecord->status,$status);
			$aux2=array_search(Input::get('status'),$status);
			try{
				//return $aux2.">".$aux1;
				if($ultRecord->status==Input::get('status') and $Project->status=="Paralizado"){				
					$Project->status=Input::get('status');
					$Project->save();
					
					$record= new Record();
					$record->status=Input::get('status');
					$record->comment=Input::get('comment');
					$record->date_create=$now;
					$record->project_id=$id;	
					$record->save();
					return Redirect::to('/project/individual/status'.'/'.$id)->with('messageStatus','Se actualizo correctamente el estatus');

				}else if($aux2-$aux1==1 and $Project->status!="Paralizado"){
								
					$Project->status=Input::get('status');
					$Project->save();
					
					$record= new Record();
					$record->status=Input::get('status');
					$record->comment=Input::get('comment');
					$record->date_create=$now;
					$record->project_id=$id;	
					$record->save();
							
					return Redirect::to('/project/individual/status'.'/'.$id)->with('messageStatus','Se actualizo correctamente el estatus');
				}else if(Input::get('status')=="Paralizado" and $Project->status!="Finalizado"){
					$Project->status=Input::get('status');
					$Project->save();
					
					$record= new Record();
					$record->status=Input::get('status');
					$record->comment=Input::get('comment');
					$record->date_create=$now;
					$record->project_id=$id;	
					$record->save();

					return Redirect::to('/project/individual/status'.'/'.$id)->with('messageStatus','El proyecto a sido Paralizado');
				}else if( $Project->status=="Finalizado"  and Input::get('status')=="Cerrado"){
					$Project->status=Input::get('status');
					$Project->save();
					
					$record= new Record();
					$record->status=Input::get('status');
					$record->comment=Input::get('comment');
					$record->date_create=$now;
					$record->project_id=$id;	
					$record->save();

					return Redirect::to('/project/individual/status'.'/'.$id)->with('messageStatus','El proyecto a sido Paralizado');
				}else{
					if( $Project->status=="Paralizado"){
						return Redirect::to('/project/individual/status'.'/'.$id)->with('messageErrorStatus','No se actualizo el estatus debido a que se debe reactivar el proyecto regresando a su fase anterior '.$ultRecord->status);
					}else{
						return Redirect::to('/project/individual/status'.'/'.$id)->with('messageErrorStatus','No se actualizo el estatus debido a que debe ser una fase siguiente a la actual '.$ultRecord->status);
					}
				}
			}catch (Exception $e) {
					return Redirect::to('/project/individual/status'.'/'.$id)->with('messageErrorStatus','Se produjo un error')->withInput();
			}
		}else{
			return Redirect::to('/project/individual/status'.'/'.$id)->withErrors($validator)->withInput();
		}
	
	}
}




class Detalle_project
{
    // Declaración de la propiedad
    public $name;
    public $status;
    public $locality;
    public $first_name;

     public function __toString()
    {
        return 'Detalle_project[name=' . $this->name .
            ', status=' . $this->status .
            ', locality=' . $this->locality .
            ', first_name=' . $this->first_name . ']';
    }
}

class Employee_project
{
    // Declaración de la propiedad
    public $first_name;
    public $last_name;
    public $ident_card;
    public $profession;
    public $specialty;
    public $status;

     public function __toString()
    {
        return 'Employee_project[first_name=' . $this->first_name .
            ', last_name=' . $this->last_name .
            ', ident_card=' . $this->ident_card .
            ', profession=' . $this->profession .
            ', specialty=' . $this->specialty .
            ', status=' . $this->status . ']';
    }
}

class Detalle_Activity
{
    // Declaración de la propiedad
    public $id;
    public $name;
    public $status;
    public $date_proposal;
    public $description;

     public function __toString()
    {
        return 'Detalle_Activity[name=' . $this->name .
            ', status=' . $this->status .
            ', id=' . $this->id .
            ', date_proposal=' . $this->date_proposal .
            ', description=' . $this->description .']';
    }
}