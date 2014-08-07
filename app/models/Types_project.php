<?php

class Types_project extends Eloquent {
 
	public $timestamps = false;

	public function project(){
		return $this->hasMany('Project');
	}

}