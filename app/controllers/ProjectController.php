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
			$project->document_budget = "";
			$project->amount_contract = 0.0;
			$project->date_create = $now;
			$project->date_end = $now;
			
			try {
				$project->save();
				return Redirect::to('/project/registrar')->with('messageRegistrar','Se Registró al usuario correctamente y se ha enviado un correo con los datos');
			} catch (Exception $e) {
				return $e;
				return Redirect::to('/project/registrar')->with('messageErrorRegis','Se produjo un error')->withInput();	
			}
		}else{
			return Redirect::to('/project/registrar')->withErrors($validator)->withInput();
		}
	}

	public function proyectoIndividual($id)
	{
		$Project=Project::find($id);
		$usuario=Auth::user();
		$nombre=$usuario->employee()->first()->first_name;	
		return View::make('ventanas.proyectoIndividual', array('menu' => '3','nombre'=>$nombre,'menuIzq'=>'1','project'=>$Project));
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

class Detalle_Activity
{
    // Declaración de la propiedad
    public $name;
    public $status;
    public $date_proposal;
    public $description;

     public function __toString()
    {
        return 'Detalle_Activity[name=' . $this->name .
            ', status=' . $this->status .
            ', date_proposal=' . $this->date_proposal .
            ', description=' . $this->description .']';
    }
}