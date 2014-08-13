<?php

class ActivityController extends BaseController 
{

	public function __construct(){
		$this->beforeFilter('auth');
	}

	public function consultora_activity()
	{
		$nombre=Auth::user();
		$count_project = $nombre->proyect()->count();	
		$project = $nombre->proyect()->orderBy('date_create','desc')->take(5)->get();		
		$activity = $nombre->activitie()->orderBy('date_create','desc')->paginate(1);

		return View::make('miConsultora.miConsultora_Activity', array('menu' => '1','nombre'=>$nombre->email,"project"=> $project,"count_project"=>$count_project,"activity"=>$activity));
	}
}