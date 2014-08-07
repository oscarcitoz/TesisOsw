<?php

class Documents_project extends Eloquent {


	public function project(){
		return $this->belongsTo('Project');
	}

}