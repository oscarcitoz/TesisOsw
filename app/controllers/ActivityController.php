<?php

class ActivityController extends BaseController 
{

	public function __construct(){
		$this->beforeFilter('auth');
	}

	public function actividadIndividual($id){
		$activity=Activitie::find($id);
		$project=$activity->project()->first();
		$name=$project->name;
		$types_activitie=$activity->types_activitie()->first()->name;
		$lider=$project->join('employees', 'projects.user_id', '=', 'employees.user_id')
				->select('employees.first_name','employees.last_name')->first();
		$usuario=Auth::user();
		$nombre=$usuario->employee()->first()->first_name;
		$document_project=$activity->Documents_activitie()->get();	
		return View::make('ventanas.actividadIndividual', array('menu' => '3','nombre'=>$nombre,'menuIzq'=>'1','activity'=>$activity,'name'=>$name,'types_activitie'=>$types_activitie,'lider'=>$lider,'document_project'=>$document_project));
	}

	public function actividadIndividualDocument($id){
		$activity=Activitie::find($id);
		$project=$activity->project()->first();
		$name=$project->name;
		$types_activitie=$activity->types_activitie()->first()->name;
		$lider=$project->join('employees', 'projects.user_id', '=', 'employees.user_id')
				->select('employees.first_name','employees.last_name')->first();
		$usuario=Auth::user();
		$nombre=$usuario->employee()->first()->first_name;	
		$document_project=$activity->Documents_activitie()->get();
		return View::make('ventanas.actividadIndividual', array('menu' => '3','nombre'=>$nombre,'menuIzq'=>'2','activity'=>$activity,'name'=>$name,'types_activitie'=>$types_activitie,'lider'=>$lider,'document_project'=>$document_project));
	}

	public function consultora_activity()
	{
		$nombre=Auth::user();
		$count_project = $nombre->proyect()->count();	
		$project = $nombre->proyect()->orderBy('date_create','desc')->take(5)->get();		
		$activity = $nombre->activitie()->orderBy('date_create','desc')->paginate(1);

		return View::make('miConsultora.miConsultora_Activity', array('menu' => '1','nombre'=>$nombre->email,"project"=> $project,"count_project"=>$count_project,"activity"=>$activity));
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
				return Redirect::to('/project/individual/activity'.'/'.$id)->with('messageAct','Se Registró al usuario correctamente y se ha enviado un correo con los datos');
			}catch (Exception $e) {return$e;
				return Redirect::to('/project/individual/activity'.'/'.$id)->with('messageErrorAct','Se produjo un error')->withInput();
			}
		}else{
			return Redirect::to('/project/individual/activity'.'/'.$id)->withErrors($validator)->withInput();
		}
	
	}
}