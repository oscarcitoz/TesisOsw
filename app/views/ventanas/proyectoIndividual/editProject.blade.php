@extends('Layouts.layout2')
@section('title')
Usuario
  @stop

@section('scripts')
 @parent
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script type="text/javascript">
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
  <div class="row">
    <fieldset class="form-group col-md-5">
    {{Form::label('name', 'Nombre del Proyecto: ')}}
    @if($errors->has('name'))
        {{Form::label('name',$errors->first('name'),array('class'=>'label label-warning'))}}
        @endif
    {{Form::text('name', $project->name, array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255'))}}
    </fieldset>

    <fieldset class="form-group col-md-5">
    {{Form::label('description', 'Descripci&oacute;n: ')}}
    @if($errors->has('description'))
        {{Form::label('description',$errors->first('description'),array('class'=>'label label-warning'))}}
        @endif
    {{Form::text('description',$project->description, array('class'=>'form-control',"required"=>"true", 'maxlength'=>'255'))}}
    </fieldset>
  </div>
</div>

<div class=​"well bs-component">​
  <div class="row">
    <fieldset class="form-group col-md-5">
    {{Form::label('locality', 'Localidad: ')}}
    @if($errors->has('locality'))
        {{Form::label('locality',$errors->first('locality'),array('class'=>'label label-warning'))}}
        @endif
    {{Form::text('locality', $project->locality, array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255'))}}
    </fieldset>

    <fieldset class="form-group col-md-5">
    {{Form::label('status', 'Estatus: ')}}
    @if($errors->has('status'))
        {{Form::label('status',$errors->first('status'),array('class'=>'label label-warning'))}}
        @endif
    {{Form::select('status',$combox,$project->status, array('class'=>'form-control',"required"=>"true", 'maxlength'=>'255'))}}
    </fieldset>
  </div>
</div>

<div class=​"well bs-component">​
  <div class="row">
    <fieldset class="form-group col-md-5">
    {{Form::label('date_create', 'Fecha de creaci&oacute;n: ')}}
    @if($errors->has('date_create'))
        {{Form::label('date_create',$errors->first('date_create'),array('class'=>'label label-warning'))}}
        @endif
    {{Form::text('date_create', $project->date_create, array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255'))}}
    </fieldset>

    <fieldset class="form-group col-md-5">
    {{Form::label('date_end', 'Fecha de Cierre: ')}}
    @if($errors->has('date_end'))
        {{Form::label('date_end',$errors->first('date_end'),array('class'=>'label label-warning'))}}
        @endif
    {{Form::text('date_end',$project->date_end, array('class'=>'form-control',"required"=>"true", 'maxlength'=>'255'))}}
    </fieldset>
  </div>
</div>

<div class=​"well bs-component">​
  <div class="row">
    <fieldset class="form-group col-md-5">
    {{Form::label('first_name', 'Lider de Proyecto: ')}}
    @if($errors->has('first_name'))
        {{Form::label('first_name',$errors->first('first_name'),array('class'=>'label label-warning'))}}
        @endif
    {{Form::text('first_name', $project->first_name, array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255'))}}
    </fieldset>
  </div>
</div>


<fieldset class="form-group col-md-5 col-md-offset-4">
<input type="submit" class="btn btn-primary btn-lg" value="Modificar Cliente"/>  
</fieldset>


{{Form::close()}}

</div>


<br/>

@stop 