<div name="izq" id="Dizq2" class="oculta" >
<ul class="breadcrumb">
  <li class="active">Registrar Empleado</li>
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
{{Form::open(array('url'=>'/empresa/create','method'=>'POST','id'=>"registro"))}}
<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('first_name', 'Nombre: ')}}
@if($errors->has('first_name'))
    {{Form::label('first_name',$errors->first('first_name'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('first_name', Input::old('name'), array('class'=>'form-control',"required"=>"true"))}}
</fieldset>

<fieldset class="form-group col-md-5">
{{Form::label('last_name', 'Apellido: ')}}
@if($errors->has('last_name'))
    {{Form::label('last_name',$errors->first('last_name'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('last_name',Input::old('last_name'), array('class'=>'form-control',"required"=>"true"))}}
</fieldset>
</div>
<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('email', 'Email: ')}}
@if($errors->has('email'))
    {{Form::label('email',$errors->first('email'),array('class'=>'label label-warning'))}}
    @endif
{{Form::email('email',Input::old('email'), array('class'=>'form-control',"required"=>"true",'id'=>"email"))}}
</fieldset>

<fieldset class="form-group col-md-5">
{{Form::label('ident_card', 'C&eacute;dula: ')}}
@if($errors->has('ident_card'))
    {{Form::label('ident_card',$errors->first('ident_card'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('ident_card',Input::old('ident_card'), array('class'=>'form-control',"required"=>"true"))}}
</fieldset>
</div>
<div class="row">

<fieldset class="form-group col-md-5">
  {{Form::label('rol', 'Rol: ')}}
  @if($errors->has('rol'))
    {{Form::label('rol',$errors->first('rol'),array('class'=>'label label-warning'))}}
    @endif
{{ Form::select('rol', $combobox, $selected, array('class'=>'form-control',"required"=>"true")) }}
</fieldset>
</div>

<fieldset class="form-group col-md-5 col-md-offset-4">
<input type="submit" class="btn btn-primary btn-lg" value="Registrar"/>  
</fieldset>

{{Form::close()}}

</div>



</div>