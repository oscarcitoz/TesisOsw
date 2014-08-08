@extends('Layouts.layout2')
@section('title')
Recuperar Contraseña
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
 <strong>Oh Error!</strong>  {{ trans(Session::get('error')) }}
</div>
</div>
@elseif (Session::has('status'))
<div class="row" style=''>
<div class="col-md-4 col-md-offset-4 alert alert-dismissable alert-info">
  <button type="button" class="close" data-dismiss="alert">×</button>
 <strong>Enviado!</strong> 
 {{ trans(Session::get('status')) }}</div>
</div>
@endif

<div class="row" style=''>
<form action="{{ action('RemindersController@postRemind') }}" method="POST">
	<div class="col-md-4 col-md-offset-4">
	<fieldset class="row form-group">
    	<label for=​"email">​Email: ​</label>​
    <input type="email"  class="form-control" required='true'  name="email">
    </fieldset>
	<input type="submit" class="btn btn-primary" value="Recuperar">
	
    
        </div>
</form>
</div>
</div>
@stop  
