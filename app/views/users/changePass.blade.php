@extends('Layouts.layout')
@section('title')
Perfil
  @stop

@section('pestania')
Perfil
  @stop  

@section('scripts')
 @parent
 
  @stop  


@section('menuPrincipal')
@include('Layouts.Menu.menuPrincipal')
  @stop  


@section('menuIzquierdo')
@include('Layouts.Menu.menuIzquierdoPerfil')
  @stop    


@section('contenido')

<div name="izq" id="Dizq1">
<div style='font-size:16;'>
<ul class="breadcrumb">
  <li><a href="{{URL::to('/perfil')}}">Perfil</a></li>
  <li class="active">Modificaci&oacute;n de Contraseña</li>
</ul>
</div>
<div class="col-md-6 col-md-offset-3">

@if(Session::has('message'))

<div class="row">

<div class=" alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Oh Error!</strong> {{Session::get('message')}}.
</div>
</div>
@endif
{{Form::open(array('url'=>'/perfil/updatePassword','method'=>'POST'))}}


<fieldset class="row form-group">
{{Form::label('password', 'Nueva Contraseña: ')}}
@if($errors->has('new_password'))
			{{Form::label('new_password',$errors->first('new_password'),array('class'=>'label label-warning'))}}
			@endif

{{Form::password('new_password', array('class'=>'form-control',"required"=>"true"))}}	
</fieldset>

<fieldset class="row form-group">
{{Form::label('new_password_confirmation', 'Confirmaci&oacute;n Contraseña: ')}}
@if($errors->has('new_password_confirmation'))
			{{Form::label('new_password_confirmation',$errors->first('new_password_confirmation'),array('class'=>'label label-warning'))}}
			@endif
{{Form::password('new_password_confirmation', array('class'=>'form-control',"required"=>"true"))}}
</fieldset>

<fieldset class="row form-group">
{{Form::label('current_password', 'Contraseña Actual: ')}}
{{Form::password('current_password', array('class'=>'form-control',"required"=>"true"))}}
</fieldset>

<fieldset class="row form-group">
	<div class="col-md-6 col-md-offset-4">

<input type="submit" class="btn btn-primary" value="Editar" />		
</div>
</fieldset>
{{Form::close()}}
</div>




</div>
<div name="izq" id="Dizq2" class="oculta">
<h2> DIV 2</h2>
</div>
<div name="izq" id="Dizq3" class="oculta">
<h2> DIV 3</h2>
</div>
<br/>
  @stop  