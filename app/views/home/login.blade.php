@extends('Layouts.layout2')
@section('title')
Login
  @stop


@section('container')

<div id="login-content" class="container">
	<div class="row">
	
		<div class="col-md-4 col-md-offset-4 page-header" style='text-align:center'><h1>
			Consultora Login </h1> </div>
	</div>
<br/>
@if(Session::has('message'))

<div class="row" style=''>

<div class="col-md-4 col-md-offset-4 alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Oh Error!</strong> {{Session::get('message')}}.
</div>
</div>

@elseif(Session::has('success'))

<div class="row" style=''>

<div class="col-md-4 col-md-offset-4 alert alert-dismissable alert-info">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Contraseña Cambiada!</strong> {{Session::get('success')}}.
</div>
</div>
@endif


{{Form::open(array('url'=>'/authenticate','method'=>'POST'))}}

<fieldset class="row form-group">
		<div class="col-md-4 col-md-offset-4">
			{{Form::label('email','Email: ')}}
			@if($errors->has('email'))
			{{Form::label('email',$errors->first('email'),array('class'=>'label label-warning'))}}
			@endif
		{{Form::email('email',Input::old('email'),array('class'=>'form-control',"required"=>"true"))}}
		</div>
	</fieldset>

	<fieldset class="row form-group">
		<div class="col-md-4 col-md-offset-4">
			{{Form::label('password','Password de Usuario: ')}}
			@if($errors->has('password'))
			{{Form::label('password',$errors->first('password'),array('class'=>'label label-warning'))}}
			@endif
		{{Form::password('password',array('class'=>'form-control',"required"=>"true", 'minlength'=>'8'))}}
		</div>
	</fieldset>
<fieldset class="form-group-group row">
<div class="col-md-4 col-md-offset-4">
	<input type="submit" class="btn btn-primary" value="Iniciar Sesion">
	<span class="register">¿Olvidaste tu Contraseña? <a href="{{URL::to('/password/remind')}}">Recuperar</a></span>
</div>
	</fieldset>

	{{Form::close()}}

</div>
@stop  
