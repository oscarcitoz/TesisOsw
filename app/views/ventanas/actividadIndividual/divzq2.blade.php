<div name="izq" id="Dizq2" class="oculta">

	<ul class="breadcrumb">
  <li class="active">Documentaci&oacute;n</li>
</ul>

	@if(Session::has('messageDocument'))
<div class="alert alert-dismissable alert-info">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Registro Completo!</strong> {{Session::get('messageDocument')}}
</div>
@endif


@if(Session::has('messageErrorDocument'))

<div class="row">

<div class=" alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Oh Error!</strong> {{Session::get('messageErrorDocument')}}
</div>
</div>
@endif

	@if ($project->status != "Paralizado" and $project->status != "Cerrado" and $project->status != "Finalizado" and $activity->status!="Ejecutar")
	<div class=​"well bs-component">​
		<div class="row">
			<fieldset class="col-md-9 col-md-offset-9">
	    		<input type="button" id="agrega" class="btn btn-primary btn-lg" value="Agregar"/>  
			</fieldset>
	    </div>
	</div>
	@endif

	<div class=​"well bs-component" id="cargar">
		@if ($project->status != "Paralizado" and $project->status != "Cerrado" and $project->status != "Finalizado" and $activity->status!="Ejecutar")
		{{Form::open(array('url'=>'/actividad/individual/agregaDocument','files'=>true,'method'=>'post', 'id'=>'formulario_Document'))}}
		{{ Form::hidden('invisible', $activity->id, array('id' => 'invisible_id')) }}
			<div class="row">
			  <fieldset class="form-group col-md-5">
				{{Form::label('description', 'Descripci&oacute;n: ')}}
				@if($errors->has('description'))
				    {{Form::label('description',$errors->first('description'),array('class'=>'label label-warning'))}}
				 @endif
				{{Form::text('description', '', array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255'))}}
			</fieldset>
		  <fieldset class="form-group form-group col-md-8">
		      {{Form::label('attached','Archivo:')}}
			    @if($errors->has('attached'))
			    	{{Form::label('attached',$errors->first('attached'),array('class'=>'label label-warning'))}}
			    @endif
		      {{Form::File('attached', array('class'=>'form-control',"required"=>"true"))}}
		    <p class="help-block">Debes subir exclusivamente archivos PDF</p>
		  </fieldset>

		  <fieldset class="form-group col-md-8">
			<input type="submit" class="btn btn-primary btn-lg" value="Subir documento al proyecto"/>  
		  </fieldset>

			</div>
		{{Form::close()}}
		@endif
	</div>
			@if ($document_project->count() > 0)
			<div class='col-md-9'>
				<table class="table table-striped">
					<thead>
						<tr>
							<th>Descripci&oacute;n</th>
							<th>Descargar</th>
						</tr>
					</thead>
					<tbody>
			@foreach ($document_project as $doc)
				<tr>
					<td>Descargar {{$doc->description}}</td>
					<td><a class="btn btn-primary btn-lg" href="{{asset($doc->attached)}}" download={{$nombre}}><img class="img-rounded" width="20" src="{{asset('images/descargar.png')}}" alt="Descargar Archivo"></a></td>
				</tr>
			@endforeach
				</tbody>
				</table>
			</div>
			@else
			<fieldset class="form-group col-md-8">
				<table class="table" >
					<tr class="danger">
						<td><strong>No existe ningun documento guardado</strong></td>
					</tr>
				</table>
			</fieldset>
			@endif

</div>