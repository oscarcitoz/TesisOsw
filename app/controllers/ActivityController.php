<?php

class ActivityController extends BaseController 
{

	public function __construct(){
		$this->beforeFilter('auth');
	}

	public function actividadIndividual($id){
		$activity=Activitie::find($id);
		$usuario=Auth::user();
		if($activity->user_id!=$usuario->id and $usuario->role->name=='empleado'){
			return Redirect::to('/');
		}
		$project=$activity->project()->first();
		$name=$project->name;
		$types_activitie=$activity->types_activitie()->first()->name;
		$lider=$project->join('employees', 'projects.user_id', '=', 'employees.user_id')
				->select('employees.first_name','employees.last_name','employees.user_id')->first();
		$nombre=$usuario->employee()->first()->first_name;
		$document_project=$activity->Documents_activitie()->get();	
		return View::make('ventanas.actividadIndividual', array('menu' => '3','nombre'=>$nombre,'menuIzq'=>'1','activity'=>$activity,'name'=>$name,'types_activitie'=>$types_activitie,'lider'=>$lider,'document_project'=>$document_project,'project'=>$project));
	}

	public function actividadIndividualDocument($id){
		$activity=Activitie::find($id);
		$usuario=Auth::user();
		if($activity->user_id!=$usuario->id and $usuario->role->name=='empleado'){
			return Redirect::to('/');
		}
		$project=$activity->project()->first();
		$name=$project->name;
		$types_activitie=$activity->types_activitie()->first()->name;
		$lider=$project->join('employees', 'projects.user_id', '=', 'employees.user_id')
				->select('employees.first_name','employees.last_name','employees.user_id')->first();
		$nombre=$usuario->employee()->first()->first_name;	
		$document_project=$activity->Documents_activitie()->get();
		return View::make('ventanas.actividadIndividual', array('menu' => '3','nombre'=>$nombre,'menuIzq'=>'2','activity'=>$activity,'name'=>$name,'types_activitie'=>$types_activitie,'lider'=>$lider,'document_project'=>$document_project,'project'=>$project));
	}

	public function consultora_activity()
	{
		$nombre=Auth::user();
		$count_project = $nombre->proyect()->count();	
		$project = $nombre->proyect()->orderBy('date_create','desc')->take(5)->get();		
		$activity = $nombre->activitie()->orderBy('date_create','desc')->paginate(3);
		$empleado=$nombre->employee()->first();

		return View::make('miConsultora.miConsultora_Activity', array('menu' => '1','nombre'=>$empleado->first_name,"project"=> $project,"count_project"=>$count_project,"activity"=>$activity));
	}

	public function createActivity()
	{
		$id=Input::get('invisible_id');
		if($id=="" or $id=="null"){
			return Redirect::to('/');
		}
		$rules=array(
			'invisible_user_id'=>'required',
			'invisible_id' => 'required', 
			'description'=>'required',
			'types_activitie_id' => 'required', 
			'date_proposal'=>'required',
		);	
		$validator=Validator::make(Input::all(),$rules);
		if(!$validator->fails())
		{
			try{
				$now = date('Y-m-d H:i:s');
				$fecha= explode("-", Input::get('date_proposal'));
				$activity=new Activitie();
				$activity->types_activitie_id=Input::get('types_activitie_id');
				$activity->project_id=Input::get('invisible_id');
				$activity->user_id=Input::get('invisible_user_id');
				$activity->description=Input::get('description');
				$activity->status="Asignada";
				$activity->date_create=$now;
				$activity->date_proposal=$fecha[2].'-'.$fecha[1].'-'.$fecha[0];
				$activity->save();
				$usuarios = DB::table('project_user')->where('project_id', '=', $id)->where('user_id', '=', Input::get('invisible_user_id'))->first();
				if($usuarios==null){
				$relacion = array('project_id'=> Input::get('invisible_id'),
					'user_id'=> Input::get('invisible_user_id'),
					'date_create'=> $now);
				DB::table('project_user')->insert($relacion);
				} 
				return Redirect::to('/project/individual/activity'.'/'.$id)->with('messageAct','Se creo la actividad de manera correcta');
			}catch (Exception $e) {
				return Redirect::to('/project/individual/activity'.'/'.$id)->with('messageErrorAct','Se produjo un error')->withInput();
			}
		}else{
			return Redirect::to('/project/individual/activity'.'/'.$id)->withErrors($validator)->withInput();
		}
	
	}

	public function CambiarStatus(){
		if(Request::ajax()){
			$rules=array(
				'id' => 'required', 
				'status' => 'required',
			);	
			$validator=Validator::make(Input::all(),$rules);
			if(!$validator->fails())
			{
				$id= Input::get('id');
		 		$status= Input::get('status');
				try{
					$activitie=Activitie::where('id', '=',  $id)->first();
					$count=$activitie->Documents_activitie()->count();
					if($count>=1){
						if($status=="Ejecutar"){
							$activitie->status=$status;
							$activitie->save();
						}else{
							$now = date('Y-m-d H:i:s');
							$activitie->status=$status;
							$activitie->date_end=$now;
							$activitie->save();
							return$now;
						}
					}else{
						return "ERROR! Por favor suba los debidos documentos antes de pasar esta actvidad a la siguiente fase";
					}
				}catch (Exception $e) {
						return "ERROR! Ha ocurrido un error Inesperado, intente nuevamente";
				}
			}else{
				return "ERROR! Ha ocurrido un error Inesperado, intente nuevamente";
			}
		}
	}

}