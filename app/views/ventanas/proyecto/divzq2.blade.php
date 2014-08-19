<div name="izq" id="Dizq2" class="oculta">

<ul class="breadcrumb">
  <li class="active">Crear Proyecto</li>
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


<div id="myModal" class="modal fade bs-example-modal-sm">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Error</h4>
      </div>
      <div class="modal-body">
        <p>Es necesario Pre-cargar un cliente.</p>
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div class=​"well bs-component">​
{{Form::open(array('url'=>'/proyecto/create','method'=>'post', 'id'=>'formulario_project'))}}
{{ Form::hidden('invisible', '', array('id' => 'invisible_id')) }}
<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('name', 'Nombre: ')}}
@if($errors->has('name'))
    {{Form::label('name',$errors->first('name'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('name', Input::old('name'), array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255'))}}
</fieldset>

<fieldset class="form-group col-md-5">
{{Form::label('description', 'Descripci&oacute;n: ')}}
@if($errors->has('description'))
    {{Form::label('description',$errors->first('description'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('description',Input::old('description'), array('class'=>'form-control',"required"=>"true"))}}
</fieldset>
</div>

<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('locality', 'Localidad: ')}}
@if($errors->has('locality'))
    {{Form::label('locality',$errors->first('locality'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('locality', Input::old('locality'), array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255'))}}
</fieldset>

<fieldset class="form-group col-md-5">
  {{Form::label('types_project_id', 'Tipo de Proyecto: ')}}
  @if($errors->has('types_project_id'))
    {{Form::label('types_project_id',$errors->first('types_project_id'),array('class'=>'label label-warning'))}}
    @endif
{{ Form::select('types_project_id',$combobox2, $selected2, array('class'=>'form-control',"required"=>"true")) }}
</fieldset>
</div>

<div class="row">
<fieldset class="form-group col-md-5">


<div class="ui-widget">
{{Form::label('buscar', 'Buscar Cliente: ')}}
{{Form::text('buscar', Input::old('buscar'), array('class'=>'form-control',"required"=>"true",'id'=>'tags1'))}}
</div>
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


<div id="combo_status" class="ui-widget" >
{{Form::open(array('url'=>'/proyecto/buscar/status','method'=>'POST', 'id'=>'formulario_status'))}}
<div class="row">
<fieldset class="form-group col-md-5">
<p>Si desea agregar un nuevo cliente haga clic <a href="#" onclick="window.open('{{URL::to('/customer/crear')}}','_blank','width=1000, height=700, top=50, left=50, scrollbars=1');">AQUI</a></p>
</fieldset>
</div>
{{Form::close()}}
</div>

</div>
