<?php

class Project extends Eloquent {
 
	public $timestamps = false;

	public function types_project(){
		return $this->belongsTo('Types_project');
	}

	public function Customer(){
		return $this->belongsTo('Customer');
	}

	public function user()
    {
        return $this->belongsToMany('User')->withPivot('date_create');
    }

    public function usero()
    {
        return $this->belongsTo('User');
    }

    public function Documents_project(){
		return $this->hasMany('Documents_project');
	}

	public function record(){
		return $this->hasMany('Record');
	}

	public function activitie(){
		return $this->hasMany('Activitie');
	}
}