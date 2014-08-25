<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Project extends Eloquent {
 
	public $timestamps = false;
	const ARCHIVOS_DIR='archivos';
	private $public_path;
	private $basedir;

	public function subir($archivo=null){
		$this->public_path=public_path().DIRECTORY_SEPARATOR;
		if($archivo instanceof Symfony\Component\HttpFoundation\File\UploadedFile)
		{
			$file=$this->moveFiletoDestination($archivo);
			if($file !==null)
			{
				$this->setAttributes($file);
			}
			else 
			{
				Throw new Exception("El archivo no subio correctamente");
			}
		}
	}

	public function moveFiletoDestination($file){
		$basedir=$this->getDestinationPath();
		//concatenamos hora de la foto id de usuario y nombre original
		$filename=Auth::user()->username.$file->getClientOriginalName().time();
		$filename=md5($filename);
		$filename=$filename.'.'.$file->guessExtension();
		try
		{
			$file=$file->move($this->public_path.$basedir,$filename);
			$this->document_budget=$filename;
			$this->basedir=$basedir;
		}
		catch (Exception $e)
		{
			$file=null;
		}
		return $file;
	}

	public function getDestinationPath()
	{
		//SEPARA LOS ARCHIVOS POR CARPETA DIA MES Y AÑO PARA EVITAR EL TAMAÑO DE LAS CARPETAS 
		$basedir=self::ARCHIVOS_DIR.DIRECTORY_SEPARATOR.date('Y').DIRECTORY_SEPARATOR.date('m').
		DIRECTORY_SEPARATOR.date('d').DIRECTORY_SEPARATOR;
		if(! is_dir($this->public_path.$basedir))
		{
			mkdir($this->public_path.$basedir,0777,true);
		}
		return $basedir;
	}

	public function setAttributes($file){
		//$this->user_id=(isset($user_id)&&!empty($user_id))?$user_id:Auth::user()->id;
		$this->basedir= str_replace('\\','/',$this->basedir); 
		$this->document_budget=$this->basedir.$this->document_budget;
	}

	public function deleteArchivo(){
		if(@unlink($this->public_path.$this->basedir.$this->document_budget))
		{
			$this->delete();
		}
	}

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