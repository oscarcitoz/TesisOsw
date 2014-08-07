<?php

class Documents_activitie extends Eloquent {


	public function activitie(){
		return $this->belongsTo('Activitie');
	}

}