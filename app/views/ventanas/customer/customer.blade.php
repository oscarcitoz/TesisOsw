@extends('Layouts.layout2')
@section('title')
Usuario
  @stop

@section('scripts')
 @parent
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script type="text/javascript">
$(function() {
$( "#formulario_project" ).submit(function( event ) {
 
 var cadena=$("#email").val();
 cadena=cadena.toLowerCase();
 $("#email").val(cadena);
});
});
</script>
 @stop
@section('container')
 

<ul class="breadcrumb">
  <li class="active">Crear Nuevo Cliente</li>
</ul>
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
{{Form::open(array('url'=>'/customer/registrar','method'=>'post', 'id'=>'formulario_project'))}}

<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('name', 'Nombre: ')}}
@if($errors->has('name'))
    {{Form::label('name',$errors->first('name'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('name', Input::old('name'), array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255'))}}
</fieldset>

<fieldset class="form-group col-md-5">
{{Form::label('rif', 'Rif: ')}}
@if($errors->has('rif'))
    {{Form::label('rif',$errors->first('rif'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('rif',Input::old('rif'), array('class'=>'form-control','maxlength'=>'15'))}}
</fieldset>
</div>

<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('email', 'Correo Electronico: ')}}
@if($errors->has('email'))
    {{Form::label('email',$errors->first('email'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('email', Input::old('email'), array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'50'))}}
</fieldset>

<fieldset class="form-group col-md-5">
  {{Form::label('locality', 'Localidad: ')}}
  @if($errors->has('locality'))
    {{Form::label('locality',$errors->first('locality'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('locality', Input::old('locality'), array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255'))}}
</fieldset>
</div>

<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('phone', 'Telefono: ')}}
@if($errors->has('phone'))
    {{Form::label('phone',$errors->first('phone'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('phone', Input::old('phone'), array('class'=>'form-control', 'maxlength'=>'15'))}}
</fieldset>

<fieldset class="form-group col-md-5">
  {{Form::label('person_contact', 'Persona de Contacto: ')}}
  @if($errors->has('person_contact'))
    {{Form::label('person_contact',$errors->first('person_contact'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('person_contact', Input::old('person_contact'), array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255'))}}
</fieldset>
</div>

<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('phone_contact', 'Telefono contacto: ')}}
@if($errors->has('phone_contact'))
    {{Form::label('phone_contact',$errors->first('phone_contact'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('phone_contact', Input::old('phone_contact'), array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'15'))}}
</fieldset>

</div>

<div class="row">
<div id="respuesta2" class=" col-md-offset-0 col-md-9">

</div>
</div>

<fieldset class="form-group col-md-5 col-md-offset-4">
<input type="submit" class="btn btn-primary btn-lg" value="Registrar"/>  
</fieldset>


{{Form::close()}}

</div>


<br/>

@stop 