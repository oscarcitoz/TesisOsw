<?php

class ProjectController extends BaseController 
{

	public function __construct(){
		$this->beforeFilter('auth');
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
		$nombre=Auth::user();		
		$project = $nombre->proyect()->orderBy('date_create','desc')->paginate(1);
		$count_activity = $nombre->activitie()->count();
		$activity = $nombre->activitie()->orderBy('date_create','desc')->take(5)->get();

		return View::make('miConsultora.miConsultora_Project', array('menu' => '1','nombre'=>$nombre->email,"project" => $project,"activity"=>$activity,"count_activity"=>$count_activity));
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