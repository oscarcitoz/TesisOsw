@extends('Layouts.layout2')
@section('title')
Reset
  @stop


@section('container')

<div id="login-content" class="container">
	<div class="row">
	
		<div class="col-md-4 col-md-offset-4 page-header" style='text-align:center'><h1>
			Recuperar Contraseña </h1> </div>
	</div>
<br/>

@if (Session::has('error'))
<div class="row" style=''>

<div class="col-md-4 col-md-offset-4 alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert">×</button>
 <strong>Oh Error!</strong>  Verifique los Datos Ingresados Por Favor.
</div>
</div>
@endif
<div class="row" style=''>
<form action="{{ action('RemindersController@postReset') }}" method="POST">
	<div class="col-md-4 col-md-offset-4">
    <input type="hidden" name="token" value="{{ $token }}">
    <fieldset class="row form-group">
    	<label for=​"email">​Email: ​</label>​
    	@if($errors->has('email'))
			{{Form::label('email',$errors->first('email'),array('class'=>'label label-warning'))}}
			@endif
    <input type="email"  required='true' class="form-control"  name="email">
    </fieldset>
    <fieldset class="row form-group">
    	<label for=​"password">Contraseña nueva: ​</label>​
    	@if($errors->has('password'))
			{{Form::label('password',$errors->first('password'),array('class'=>'label label-warning'))}}
			@endif
    <input type="password" required='true'  class="form-control"  name="password">
    </fieldset>
    <fieldset class="row form-group">
    	<label for=​"password_confirmation">Confirmaci&oacute;n de contraseña: ​</label>​
    <input type="password" required='true' class="form-control"  name="password_confirmation">
    </fieldset>

    <input type="submit" class="btn btn-primary"  value="Aceptar">
    </div>
</form>

</div>
</div>
@stop  