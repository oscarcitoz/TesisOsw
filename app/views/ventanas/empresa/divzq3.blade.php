<div name="izq" id="Dizq3" class="oculta" >
<ul class="breadcrumb">
  <li class="active">Buscar Empleado</li>
</ul>



<div class=​"well bs-component">​
{{Form::open(array('url'=>'/empresa/show','method'=>'POST', 'id'=>'formulario'))}}

{{ Form::hidden('invisible', '', array('id' => 'invisible_id')) }}

<div class="row">
<fieldset class="form-group col-md-5">


<div class="ui-widget">
{{Form::label('buscar', '')}}
{{Form::text('buscar', Input::old('buscar'), array('class'=>'form-control',"required"=>"true",'id'=>'tags'))}}
</div>
</fieldset>
<input type="radio" name="busque" checked="checked"  value="nombre">Nombre<br>
<input type="radio" name="busque" value="cedula">C&eacute;dula<br>
<input type="radio" name="busque" value="profesion">Profesi&oacute;n<br>

</div>
<div class="row">
<fieldset class="form-group col-md-5">
<input type="submit" class="btn btn-primary btn-md" value="Buscar"/>  
</fieldset>
</div>
{{Form::close()}}
<div class="row">
<div id="respuesta" class=" col-md-offset-2 col-md-8">
</div>
</div>
</div>

</div>