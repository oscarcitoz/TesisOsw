<?php

class ProjectController extends BaseController 
{

	public function __construct(){
		$this->beforeFilter('auth');
	}

	public function consultora()
	{
		$nombre=Auth::user();		
		$project = $nombre->proyect()->orderBy('date_create','desc')->take(5)->get();
		$activity = $nombre->activitie()->orderBy('date_create','desc')->take(5)->get();
		
		return View::make('miConsultora.miConsultora', array('menu' => '1','nombre'=>$nombre->email,"project"=>$project,"activity"=>$activity));
	}

	public function consultora_project()
	{
		$nombre=Auth::user();		
		$users = $nombre->proyect()->orderBy('date_create','desc')->paginate(1);

		return View::make('miConsultora.miConsultora_Project', array('menu' => '1','nombre'=>$nombre->email,"users" => $users));
	}
}