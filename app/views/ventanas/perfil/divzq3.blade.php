<div name="izq" id="Dizq3" class="oculta">
<ul class="breadcrumb">
 
  <li class="active">Curriculum</li>
</ul>
  
@if ($empleado->curriculum === null)

<div class="alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <h4>Incompleto!</h4>
  <p> En este espacio puede realizar la carga del curriculum.</p>
</div>

{{Form::open(array('url'=>'/perfil/storeCurriculum','files'=>true,'method'=>'POST'))}}

  <fieldset class="row form-group">
    <div class="col-md-8 ">
      {{Form::label('curriculum','Archivo:')}}
    @if($errors->has('curriculum'))
    {{Form::label('curriculum',$errors->first('curriculum'),array('class'=>'label label-warning'))}}
    @endif

    {{Form::File('curriculum', array('class'=>'form-control',"required"=>"true"))}}
    <p class="help-block">Debes subir exclusivamente archivos PDF</p>
    </div>
  </fieldset>

  <fieldset class="row form-group">
    <div class="col-md-6 col-md-offset-4">
    <input type="submit" class="btn btn-info" value="Subir">
    </div>
  </fieldset>


{{Form::close()}}

@else
<div class='row'>
<div class="col-md-4 col-md-offset-4">
<img src="{{asset('images/pdf.jpg')}}" alt="Archivo PDF">
</div>
</div>
<div class='row'>
<div class="col-md-2 col-md-offset-4">
<a class="btn btn-primary btn-lg" href="{{asset($empleado->curriculum)}}" target="_blank">Vista Previa</a>
</div>
<div class="col-md-2">
<a class="btn btn-primary btn-lg" href="{{asset($empleado->curriculum)}}" download={{$nombre}}>Descargar</a>

</div></div>
@endif
</div>