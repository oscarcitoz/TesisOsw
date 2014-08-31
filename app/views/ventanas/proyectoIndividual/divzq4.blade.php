<div name="izq" id="Dizq4" class="oculta">

<ul class="breadcrumb">
  <li class="active">Cambiar Estatus</li>
</ul>

	@if(Session::has('messageStatus'))
<div class="alert alert-dismissable alert-info">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Registro Completo!</strong> {{Session::get('messageStatus')}}
</div>
@endif


@if(Session::has('messageErrorStatus'))
<div class="row">
<div class=" alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Oh Error!</strong> {{Session::get('messageErrorStatus')}}
</div>
</div>
@endif

<div class=​"well bs-component">​
	@if ($project->status != "Cerrado" and $project->status != "Finalizado" and $project->user_id==Auth::user()->id)
	{{Form::open(array('url'=>'/project/individual/cambiarstatus','method'=>'post', 'id'=>'formulario_Status'))}}
	{{ Form::hidden('invisible', $project->id, array('id' => 'invisible_id')) }}
	<div class="row">
		<fieldset class="form-group col-md-5">
		{{Form::label('status', 'Estatus: ')}}
		@if($errors->has('status'))
		    {{Form::label('status',$errors->first('status'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::select('status',$combox,$project->status, array('class'=>'form-control',"required"=>"true", 'maxlength'=>'255'))}}
		</fieldset>

		<fieldset class="form-group col-md-5">
		{{Form::label('comment', 'Comentarios: ')}}
		@if($errors->has('comment'))
		    {{Form::label('comment',$errors->first('comment'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::text('comment','', array('class'=>'form-control',"required"=>"true", 'maxlength'=>'255'))}}
		</fieldset>
	</div>

	<div class="row">
		<fieldset class="form-group col-md-8">
			<input type="submit" class="btn btn-primary btn-lg" value="Cambiar Estatus"/>  
		</fieldset>
	</div>
	{{Form::close()}}
	@else
		<fieldset class="form-group col-md-5">
		{{Form::label('status', 'Estatus: ')}}
		@if($errors->has('status'))
		    {{Form::label('status',$errors->first('status'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::select('status',$combox,$project->status, array('class'=>'form-control',"required"=>"true", 'maxlength'=>'255','disabled'))}}
		</fieldset>
	@endif

</div>

</div>
