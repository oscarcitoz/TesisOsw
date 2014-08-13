<div name="izq" id="Dizq1" class="oculta" >
<ul class="breadcrumb">
 
  <li class="active">Datos de Consultora</li>
</ul>
@if(Session::has('messageConsultora'))
<div class="alert alert-dismissable alert-info">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Actualizaci&oacute;n Completa!</strong> {{Session::get('messageConsultora')}}.
</div>
@endif
<div  id="tabla">
<div class="panel panel-default">
  <div class="panel-body">
    <span class='azulito'>Nombre:</span>&nbsp;{{$customer->name}}
  </div>
  <div class="panel-footer"> <span class='azulito'> RIF: </span>&nbsp;{{$customer->rif}}</div>
</div>

<div class='row'>
<div class='col-md-3'>
  <IMG SRC="{{asset($customer->logo)}}" class="img-thumbnail" height="200" width="200"/>
</div>
<div class='col-md-9'>

<table class="table table-striped">
  <tr>
    <td > <span class='azulito'>Email</span>&nbsp;{{$customer->email}}</td>
    <td > <span class='azulito'>Tel&eacute;fono</span>&nbsp;{{$customer->phone}}</td>
  </tr>
  <tr>
    <td  colspan="2"><span class='azulito'>Localidad</span>&nbsp;{{$customer->locality}}</td>
     
  </tr>
  <tr>
    <td ><span class='azulito'>Persona de Contacto</span>&nbsp;{{$customer->person_contact}}</td>
    <td ><span class='azulito'>Tel&eacute;fono de Contacto</span>&nbsp;{{$customer->phone_contact}}</td>
  </tr>
</table>
</div>
</div>
</div>
<div class="row">
	<div class='col-md-6 col-md-offset-4'>
<a href="#" onclick="reporte()" class="btn btn-info btn-default">Reporte</a>
<a href="{{URL::to('/empresa/modificar')}}" class="btn btn-info btn-default">Modificar</a>
</div>
</div>

</div>