<?php
 
class Document_projectController extends BaseController 
{


	public function agrega()
	{
		$id=Input::get('invisible');
		if($id=="" or $id=="null"){
			return Redirect::to('/');
		}
		$rules=array(
			'attached'=>'required|mimes:xls,xlsx,pdf',
			'invisible' => 'required', 
			'description' => 'required', 
		);	
		$validator=Validator::make(Input::all(),$rules);
		if(!$validator->fails())
		{
			try{
				$doc= new Documents_project();
				$doc->description=Input::get('description');
				$doc->project_id=$id;
				$doc->subir(Input::file('attached'));
				$doc->attached;
				$doc->save();
				return Redirect::to('/project/individual/document_varios'.'/'.$id)->with('messageDocument','Se Registró el documento y ya esta disponible para su descarga');
			}catch (Exception $e) {
					return $e;Redirect::to('/project/individual/document_varios'.'/'.$id)->with('messageErrorDocument','Se produjo un error')->withInput();
			}
		}else{
			return Redirect::to('/project/individual/document_varios'.'/'.$id)->withErrors($validator)->withInput();
		}
	}



	public function actualizaDocument()
	{
		$id=Input::get('invisible');
		if($id=="" or $id=="null"){
			return Redirect::to('/');
		}else{
			$Project=Project::find($id);
		}
		$rules=array(
			'attached'=>'required|mimes:xls,xlsx,pdf',
			'invisible' => 'required', 
		);	
		$validator=Validator::make(Input::all(),$rules);
		if(!$validator->fails())
		{
			try{
				$Project->deleteArchivo();
				$Project->subir(Input::file('attached'));
				$Project->attached;
				$Project->save();
				return Redirect::to('/project/individual/document_varios'.'/'.$id)->with('messageRegistrar','Se Registró al usuario correctamente y se ha enviado un correo con los datos');
			}catch (Exception $e) {
					return $e;Redirect::to('/project/individual/document_varios'.'/'.$id)->with('messageErrorRegis','Se produjo un error')->withInput();
			}
		}else{
			return Redirect::to('/project/individual/document_varios'.'/'.$id)->withErrors($validator)->withInput();
		}
	}


}