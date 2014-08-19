<div name="izq" id="Dizq1" class="oculta">

<ul class="breadcrumb">
  <li class="active">Buscar Proyecto</li>
</ul>



<div class=​"well bs-component">​
<div class="row">
<fieldset class="form-group col-md-5">


<div id="text_busqueda" class="ui-widget" >
{{Form::label('buscar', '')}}
{{Form::text('buscar', Input::old('buscar'), array('class'=>'form-control','id'=>'tags'))}}
</div>
<div id="combo_tipo" class="ui-widget hide" >
{{Form::open(array('url'=>'/proyecto/buscar/tipo','method'=>'POST', 'id'=>'formulario_tipo'))}}
{{Form::label('buscar', '')}}
{{ Form::select('buscar',  $combobox, $selected, array('class'=>'form-control',"required"=>"true")) }}
<div class="row">
<fieldset class="form-group col-md-5"><br><br>
<input type="submit" class="btn btn-primary btn-md" value="Buscar"/>  
</fieldset>
</div>
{{Form::close()}}
</div>
<div id="combo_status" class="ui-widget hide" >
{{Form::open(array('url'=>'/proyecto/buscar/status','method'=>'POST', 'id'=>'formulario_status'))}}
{{Form::label('buscar', '')}}
{{ Form::select('buscar',  $combobox1, $selected1, array('class'=>'form-control',"required"=>"true")) }}
<div class="row">
<fieldset class="form-group col-md-5"><br><br>
<input type="submit" class="btn btn-primary btn-md" value="Buscar"/>  
</fieldset>
</div>
{{Form::close()}}
</div>
</fieldset>
<input type="radio" name="busque" checked="checked"  value="proyecto">Proyecto<br>
<input type="radio" name="busque" value="local">Localidad<br>
<input type="radio" name="busque" value="tipo">Tipo<br>
<input type="radio" name="busque" value="status">Estatus<br>

</div>

<div class="row">
<div id="respuesta" class=" col-md-offset-0 col-md-9">

</div>
</div>
</div>



</div>