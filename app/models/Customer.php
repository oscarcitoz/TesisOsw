<?php

class Customer extends Eloquent {
 
	public $timestamps = false;

	public function project(){
		return $this->hasMany('Project');
	}

	
}