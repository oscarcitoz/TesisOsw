<div name="izq" id="Dizq2" class="oculta">
<ul class="breadcrumb">
  <li class="active">Presupuesto de proyecto</li>
</ul>

	<div class="row">
<div id="respuesta2" class=" col-md-offset-0 col-md-9">

</div>
</div>


@if(Session::has('messageRegistrar'))
<div class="alert alert-dismissable alert-info">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Registro Completo!</strong> {{Session::get('messageRegistrar')}}
</div>
@endif

@if(Session::has('messageRegistrar2'))
<div class="alert alert-dismissable alert-warning">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Registro Completo!</strong> {{Session::get('messageRegistrar2')}}
</div>
@endif

@if(Session::has('messageErrorRegis'))

<div class="row">

<div class=" alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Oh Error!</strong> {{Session::get('messageErrorRegis')}}
</div>
</div>
@endif


<div class=​"well bs-component">​
	<div class="row">
		
		@if ($project->status != "Paralizado" and $project->status != "Cerrado" and $project->status != "Finalizado" and $project->user_id==Auth::user()->id)
			<fieldset class="form-group col-md-5">
			{{Form::label('amount_contract', 'Monto Total Contratado: ')}}
			@if($errors->has('amount_contract'))
			    {{Form::label('amount_contract',$errors->first('amount_contract'),array('class'=>'label label-warning'))}}
			    @endif
			{{Form::text('amount_contract',  $project->amount_contract, array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255'))}}
				<p class="help-block">Para guardar el monto presione 'Modificar Presupuesto'</p>
			</fieldset>
			<fieldset class="form-group col-md-5"><br>
				<input type="button" class="btn btn-primary btn-lg" value="Modificar Presupuesto" onclick="cambiarPresupuesto()"/>  
			</fieldset>
		@else
			<fieldset class="form-group col-md-5">
			{{Form::label('amount_contract', 'Monto Total Contratado: ')}}
			@if($errors->has('amount_contract'))
			    {{Form::label('amount_contract',$errors->first('amount_contract'),array('class'=>'label label-warning'))}}
			    @endif
			{{Form::text('amount_contract',  $project->amount_contract, array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255','disabled'))}}
			</fieldset>
		@endif
	</div>

	<div class="row">
		@if ($project->status != "Paralizado" and $project->status != "Cerrado" and $project->status != "Finalizado" and $project->user_id==Auth::user()->id)
			{{Form::open(array('url'=>'/project/individual/actualizaDocument','files'=>true,'method'=>'post', 'id'=>'formulario_project'))}}
			{{ Form::hidden('invisible', $project->id, array('id' => 'invisible_id')) }}
			<fieldset class="form-group col-md-8">
	      	{{Form::label('document_budget','Archivo:')}}
	    	@if($errors->has('document_budget'))
	    		{{Form::label('document_budget',$errors->first('document_budget'),array('class'=>'label label-warning'))}}
	    	@endif
		    {{Form::File('document_budget', array('class'=>'form-control',"required"=>"true"))}}
		    <p class="help-block">Debes subir exclusivamente archivos PDF o XLSX (Archivos Excel 2007 en adelante)</p>
		  	</fieldset>

			<fieldset class="form-group col-md-8">
				<input type="submit" class="btn btn-primary btn-lg" value="Subir Archivo del Presupuesto"/>  
			</fieldset>
			{{Form::close()}}
		@endif
		@if ($project->document_budget !== null)
			<a class="btn btn-primary btn-lg" href="{{asset($project->document_budget)}}" download={{$nombre}}><img class="img-rounded" width="20" src="{{asset('images/descargar.png')}}" alt="Descargar Archivo">Descargar Archivo</a>
		@else
			<fieldset class="form-group col-md-8">
				<table class="table" >
					<tr class="danger">
						<td><strong>No existe ningun presupuesto guardado</strong></td>
					</tr>
				</table>
			</fieldset>
		@endif




	</div>


</div>

</div>
