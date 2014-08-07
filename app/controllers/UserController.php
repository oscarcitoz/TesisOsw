<?php

class UserController extends BaseController 
{

		public function __construct()
	{
		$this->beforeFilter('auth',array('except'=>array('store')));		
		$this->beforeFilter('admin',array('only'=>array('create','destroy')));
		$this->beforeFilter('adminGerente',array('only'=>array('admin_gerente')));
				

	}



	public function index(){

	}

	public function create(){

		print 'entro';
	}

	public function store(){

	
		
	}

	public function admin_gerente(){

		print 'entro';
		
	}



	public function show($id)
	{
		

	}

	public function edit($id){

	
	}

	public function update($id)
	{
		

	}


	public function destroy($id){

	}



}