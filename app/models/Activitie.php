<?php

class Activitie extends Eloquent {
 
	public $timestamps = false;

	public function types_activitie(){
		return $this->belongsTo('Types_activitie');
	}

	public function Documents_activitie(){
		return $this->hasMany('Documents_activitie');
	}

	public function project(){
		return $this->belongsTo('Project');
	}

	public function user(){
		return $this->belongsTo('User');
	}

}