<?php

class Record extends Eloquent {

	public $timestamps = false;

	public function project(){
		return $this->belongsTo('Project');
	}

}