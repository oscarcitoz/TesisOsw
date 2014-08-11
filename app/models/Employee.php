<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Employee extends Eloquent {

	public $timestamps = false;
	const ARCHIVOS_DIR='archivos';
	const FOTOS_DIR='fotos';
	private $public_path;
	private $basedir;


	public function subir($archivo=null)
	{
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

		public function subirFoto($archivo=null)
	{
		$this->public_path=public_path().DIRECTORY_SEPARATOR;

		if($archivo instanceof Symfony\Component\HttpFoundation\File\UploadedFile)
		{
			$file=$this->moveFiletoDestinationPhoto($archivo);

			if($file !==null)
			{
				$this->setAttributesPhoto($file);

			}
			else 
			{
				Throw new Exception("El archivo no subio correctamente");

			}

		}

	}

	public function moveFiletoDestination($file)
	{
		$basedir=$this->getDestinationPath();

		//concatenamos hora de la foto id de usuario y nombre original
		$filename=Auth::user()->username.$file->getClientOriginalName().time();
		$filename=md5($filename);
		$filename=$filename.'.'.$file->guessExtension();

		try
		{
			$file=$file->move($this->public_path.$basedir,$filename);
			$this->curriculum=$filename;
			$this->basedir=$basedir;
			
		}

		catch (Exception $e)
		{
			$file=null;

		}
		return $file;
	}

		public function moveFiletoDestinationPhoto($file)
	{
		$basedir=$this->getDestinationPathPhoto();

		//concatenamos hora de la foto id de usuario y nombre original
		$filename=Auth::user()->username.$file->getClientOriginalName().time();
		$filename=md5($filename);
		$filename=$filename.'.'.$file->guessExtension();

		try
		{
			$file=$file->move($this->public_path.$basedir,$filename);
			$this->photo=$filename;
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


	public function getDestinationPathPhoto()
	{

		//SEPARA LOS ARCHIVOS POR CARPETA DIA MES Y AÑO PARA EVITAR EL TAMAÑO DE LAS CARPETAS 
		$basedir=self::FOTOS_DIR.DIRECTORY_SEPARATOR.date('Y').DIRECTORY_SEPARATOR.date('m').
		DIRECTORY_SEPARATOR.date('d').DIRECTORY_SEPARATOR;

		if(! is_dir($this->public_path.$basedir))
		{
			mkdir($this->public_path.$basedir,0777,true);

		}

		return $basedir;

	}

	public function setAttributes($file)

	{
		//$this->user_id=(isset($user_id)&&!empty($user_id))?$user_id:Auth::user()->id;
		$this->basedir= str_replace('\\','/',$this->basedir); 
		$this->curriculum=$this->basedir.$this->curriculum;

	}
		public function setAttributesPhoto($file)

	{
		//$this->user_id=(isset($user_id)&&!empty($user_id))?$user_id:Auth::user()->id;
		$this->basedir= str_replace('\\','/',$this->basedir); 
		$this->photo=$this->basedir.$this->photo;

	}

	public function deleteArchivo()
	{

		if(@unlink($this->public_path.$this->basedir.$this->curriculum))
		{
			$this->delete();

		}


	}

		public function deletePhoto()
	{

		if(@unlink($this->public_path.$this->basedir.$this->photo))
		{
			$this->delete();

		}


	}


	public function user(){
		return $this->hasOne('User');
	}



}