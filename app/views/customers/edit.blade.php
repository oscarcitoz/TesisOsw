@extends('Layouts.layout')
@section('title')
Empresa
  @stop

@section('pestania')
Empresa
  @stop  


@section('menuPrincipal')
@include('Layouts.Menu.menuPrincipal')
  @stop  


@section('menuIzquierdo')
@include('Layouts.Menu.menuIzquierdoEmpresa')
  @stop    


@section('contenido')

<div name="izq" id="Dizq1" class="oculta" >
<ul class="breadcrumb">
   <li><a href="{{URL::to('/empresa')}}">Datos de Consultora</a></li>
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
{{Form::open(array('url'=>'/empresa/update','method'=>'POST'))}}
<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('name', 'Nombre: ')}}
@if($errors->has('name'))
    {{Form::label('name',$errors->first('name'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('name', $customer->name, array('class'=>'form-control','disabled',"required"=>"true"))}}
</fieldset>

<fieldset class="form-group col-md-5">
{{Form::label('rif', 'Rif: ')}}
@if($errors->has('rif'))
    {{Form::label('rif',$errors->first('rif'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('rif', $customer->rif, array('class'=>'form-control','disabled',"required"=>"true"))}}
</fieldset>
</div>
<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('email', 'Email: ')}}
@if($errors->has('email'))
    {{Form::email('email',$errors->first('email'),array('class'=>'label label-warning'))}}
    @endif
{{Form::email('email', $customer->email, array('class'=>'form-control','disabled',"required"=>"true"))}}
</fieldset>

<fieldset class="form-group col-md-5">
{{Form::label('phone', 'Telef&oacute;no: ')}}
@if($errors->has('phone'))
    {{Form::label('phone',$errors->first('phone'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('phone', $customer->phone, array('class'=>'form-control',"required"=>"true"))}}
</fieldset>
</div>

<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('locality', 'Localidad: ')}}
@if($errors->has('locality'))
    {{Form::label('locality',$errors->first('locality'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('locality', $customer->locality, array('class'=>'form-control',"required"=>"true"))}}
</fieldset>

<fieldset class="form-group col-md-5">
{{Form::label('person_contact', 'Persona de Contacto: ')}}
@if($errors->has('person_contact'))
    {{Form::label('person_contact',$errors->first('person_contact'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('person_contact', $customer->person_contact, array('class'=>'form-control',"required"=>"true"))}}
</fieldset>
</div>

<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('phone_contact', 'Telef&oacute;no de Contacto: ')}}
@if($errors->has('phone_contact'))
    {{Form::label('phone_contact',$errors->first('phone_contact'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('phone_contact', $customer->phone_contact, array('class'=>'form-control',"required"=>"true"))}}
</fieldset>

</div>

<fieldset class="form-group col-md-5 col-md-offset-4">
<input type="submit" class="btn btn-primary btn-lg" value="Editar"/>  
</fieldset>

{{Form::close()}}



</div>







</div>
@include('ventanas.empresa.divzq2')
<div name="izq"  id="Dizq3" class="oculta">
<h2> DIV 3</h2>
</div>
<br/>
  @stop  