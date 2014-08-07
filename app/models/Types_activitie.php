<?php

class Types_activitie extends Eloquent {
 
	public $timestamps = false;

	public function activitie(){
		return $this->hasMany('Activitie');
	}

}