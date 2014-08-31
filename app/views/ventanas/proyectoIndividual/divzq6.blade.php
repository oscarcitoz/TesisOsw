<div name="izq" id="Dizq6" class="oculta">

<ul class="breadcrumb">
  <li class="active">Crear actividad</li>
</ul>

	@if(Session::has('messageAct'))
<div class="alert alert-dismissable alert-info">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Registro Completo!</strong> {{Session::get('messageAct')}}
</div>
@endif


@if(Session::has('messageErrorAct'))
<div class="row">
<div class=" alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Oh Error!</strong> {{Session::get('messageErrorAct')}}
</div>
</div>
@endif

<div id="myModal" class="modal fade bs-example-modal-sm">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Error</h4>
      </div>
      <div class="modal-body">
        <p>Es necesario Pre-cargar un Empleado.</p>
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@if ($project->status != "Paralizado" and $project->status != "Cerrado" and $project->status != "Finalizado")
<div class=​"well bs-component">​
	{{Form::open(array('url'=>'/project/individual/createActivity','method'=>'post', 'id'=>'formulario_Act'))}}
	{{ Form::hidden('invisible_user_id', '', array('id' => 'invisible_user_id')) }}
	{{ Form::hidden('invisible_id', $project->id, array('id' => 'invisible_id')) }}
	<div class="row">
		<fieldset class="form-group col-md-5">
		{{Form::label('description', 'Descripci&oacute;n: ')}}
		@if($errors->has('description'))
		    {{Form::label('description',$errors->first('description'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::text('description','', array('class'=>'form-control',"required"=>"true", 'maxlength'=>'255'))}}
		</fieldset>

		<fieldset class="form-group col-md-5">
		{{Form::label('types_activitie_id', 'Tipo de Actividad: ')}}
		@if($errors->has('types_activitie_id'))
		    {{Form::label('types_activitie_id',$errors->first('types_activitie_id'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::select('types_activitie_id',$types_activitie,'', array('class'=>'form-control',"required"=>"true", 'maxlength'=>'255'))}}
		</fieldset>
	</div>


	<div class="row">
		<fieldset class="form-group col-md-5">
		{{Form::label('date_proposal', 'Fecha Propuesta para ejecutar: ')}}
		@if($errors->has('date_proposal'))
		    {{Form::label('date_proposal',$errors->first('date_proposal'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::input('date','date_proposal','', array('class'=>'form-control',"required"=>"true", 'maxlength'=>'255'))}}
		</fieldset>

		<fieldset class="form-group col-md-5">
		{{Form::label('user_id', 'Empleado: ')}}
		@if($errors->has('user_id'))
		    {{Form::label('user_id',$errors->first('user_id'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::text('user_id', Input::old('user_id'), array('class'=>'form-control',"required"=>"true",'id'=>'tags'))}}
		</fieldset>
	</div>

	<div class="row">
	<div id="respuesta3" class=" col-md-offset-0 col-md-10">

	</div>
	</div>

	<div class="row">
		<fieldset class="form-group col-md-8">
			<input type="submit" class="btn btn-primary btn-lg" value="Crear"/>  
		</fieldset>
	</div>
	{{Form::close()}}
</div>
@else
	<fieldset class="form-group col-md-8">
		<table class="table" >
			<tr class="danger">
				<td><strong>En este momento no es posible crear crear una nueva actividad</strong></td>
			</tr>
		</table>
	</fieldset>
@endif





</div>
