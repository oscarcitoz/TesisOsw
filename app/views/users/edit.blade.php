@extends('Layouts.layout')
@section('title')
Perfil
  @stop

@section('pestania')
Perfil
  @stop  


@section('menuPrincipal')
@include('Layouts.Menu.menuPrincipal')
  @stop  


@section('menuIzquierdo')
@include('Layouts.Menu.menuIzquierdoPerfil')
  @stop    


@section('contenido')

@include('ventanas.perfil.divzq1')

<div name="izq" id="Dizq2" class="oculta" >
<ul class="breadcrumb">
   <li><a href="{{URL::to('/perfil/datosPersonales')}}">Datos Personales</a></li>
  <li class="active">Modificar</li>
</ul>


@if(Session::has('messageEdit'))

<div class="row">

<div class=" alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Oh Error!</strong> {{Session::get('messageEdit')}}.
</div>
</div>
@endif

<div class=​"well bs-component">​
{{Form::open(array('url'=>'/perfil/updateDatosPersonales','files'=>true,'method'=>'POST',"id"=>'formEdit'))}}
<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('nombre', 'Nombre: ')}}
@if($errors->has('nombre'))
    {{Form::label('nombre',$errors->first('nombre'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('nombre', $empleado->first_name, array('class'=>'form-control',"required"=>"true"))}}
</fieldset>

<fieldset class="form-group col-md-5">
{{Form::label('apellido', 'Apellido: ')}}
@if($errors->has('apellido'))
    {{Form::label('apellido',$errors->first('apellido'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('apellido', $empleado->last_name, array('class'=>'form-control',"required"=>"true"))}}
</fieldset>
</div>
<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('email', 'Email: ')}}
@if($errors->has('email'))
    {{Form::label('email',$errors->first('email'),array('class'=>'label label-warning'))}}
    @endif
{{Form::email('email', $login, array('class'=>'form-control','disabled',"required"=>"true"))}}
</fieldset>

<fieldset class="form-group col-md-5">
{{Form::label('cedula', 'C&eacute;dula: ')}}
@if($errors->has('cedula'))
    {{Form::label('cedula',$errors->first('cedula'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('cedula', $empleado->ident_card, array('class'=>'form-control',"required"=>"true","maxlength"=>"15"))}}
</fieldset>
</div>
<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('telefonoLocal', 'Telef&oacute;no Local: ')}}
@if($errors->has('telefonoLocal'))
    {{Form::label('telefonoLocal',$errors->first('telefonoLocal'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('telefonoLocal', $empleado->phone_local, array('class'=>'form-control',"required"=>"true","maxlength"=>"15"))}}
</fieldset>

<fieldset class="form-group col-md-5">
{{Form::label('telefonoCel', 'Telef&oacute;no Celular: ')}}
@if($errors->has('telefonoCel'))
    {{Form::label('telefonoCel',$errors->first('telefonoCel'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('telefonoCel', $empleado->phone_cel, array('class'=>'form-control',"required"=>"true","maxlength"=>"15"))}}
</fieldset>
</div>
<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('direccion', 'Direcci&oacute;n: ')}}
@if($errors->has('direccion'))
    {{Form::label('direccion',$errors->first('direccion'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('direccion', $empleado->address, array('class'=>'form-control',"required"=>"true"))}}
</fieldset>

<fieldset class="form-group col-md-5">
{{Form::label('estadoCivil', 'Estado Civil: ')}}
@if($errors->has('estadoCivil'))
    {{Form::label('estadoCivil',$errors->first('estadoCivil'),array('class'=>'label label-warning'))}}
    @endif
{{Form::select('estadoCivil',array('Soltero' => 'Soltero', 'Casado' => 'Casado'), $empleado->civil_status, array('class'=>'form-control',"required"=>"true"))}}

</fieldset>
</div>
<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('nacimiento', 'Fecha de Nacimiento: ')}}
@if($errors->has('nacimiento'))
    {{Form::label('nacimiento',$errors->first('nacimiento'),array('class'=>'label label-warning'))}}
    @endif
{{ Form::input('date','nacimiento', $empleado->date_birth, array('class'=>'form-control',"required"=>"true",'id'=>"datepicker"))}}
</fieldset>

<fieldset class="form-group col-md-5">
{{Form::label('sexo', 'Sexo: ')}}
@if($errors->has('sexo'))
    {{Form::label('sexo',$errors->first('sexo'),array('class'=>'label label-warning'))}}
    @endif
<br/>

@if($empleado->sex =="Masculino")
{{ Form::radio('sexo',  'Masculino',true ) }}Masculino
{{ Form::radio('sexo','Femenino') }}Femenino
@elseif ($empleado->sex =="Femenino")
{{ Form::radio('sexo',  'Masculino' ) }}Masculino
{{ Form::radio('sexo','Femenino',true) }}Femenino
@else
{{ Form::radio('sexo',  'Masculino' ) }}Masculino
{{ Form::radio('sexo','Femenino') }}Femenino
@endif


</fieldset>
</div>
<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('profesion', 'Profesi&oacute;n: ')}}
@if($errors->has('profesion'))
    {{Form::label('profesion',$errors->first('profesion'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('profesion', $empleado->profession, array('class'=>'form-control',"required"=>"true"))}}
</fieldset>


<fieldset class="form-group col-md-5">
{{Form::label('especialidad', 'Especialidad: ')}}
@if($errors->has('especialidad'))
    {{Form::label('especialidad',$errors->first('especialidad'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('especialidad', $empleado->specialty, array('class'=>'form-control',"required"=>"true"))}}
</fieldset>
</div>
<hr>
<h3>Curriculum y Foto </h3>
<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('curriculum', 'Curriculum: ')}}
@if($errors->has('curriculum'))
    {{Form::label('curriculum',$errors->first('curriculum'),array('class'=>'label label-warning'))}}
    @endif
    @if ($empleado->curriculum===null)
{{Form::File('curriculum', array('class'=>'form-control',"required"=>"true"))}}
@else
{{Form::File('curriculum', array('class'=>'form-control'))}}
@endif
 <p class="help-block">Debes subir exclusivamente archivos PDF</p>
</fieldset>
@if ($empleado->curriculum!==null)
<div class="alert alert-dismissable alert-info  col-md-5">
  <button type="button" class="close" data-dismiss="alert">×</button>
 Actualmente tienes cargado un curriculum.&nbsp;Haz clic para &nbsp;<a href="{{asset($empleado->curriculum)}}" target="_blank" class="alert-link">Ver</a></div>
@endif
</div>

<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('photo', 'Foto: ')}}
@if($errors->has('photo'))
    {{Form::label('photo',$errors->first('photo'),array('class'=>'label label-warning'))}}
    @endif
    @if ($empleado->photo===null)
{{Form::File('photo', array('class'=>'form-control',"required"=>"true"))}}
@else
{{Form::File('photo', array('class'=>'form-control'))}}
@endif
 <p class="help-block">Debes subir exclusivamente Imagenes</p>
</fieldset>
@if ($empleado->photo!==null)
<div class="alert alert-dismissable alert-info  col-md-5">
  <button type="button" class="close" data-dismiss="alert">×</button>
Foto Actual ----->&nbsp; <IMG SRC="{{asset($empleado->photo)}}" class="img-thumbnail" height="100" width="100">
</div>
@endif
</div>


<fieldset class="form-group col-md-5 col-md-offset-4">
<input type="submit" class="btn btn-primary btn-lg" value="Editar"/>  
</fieldset>

{{Form::close()}}
</div>​

</div>


@include('ventanas.perfil.divzq3')
<br/>
  @stop  