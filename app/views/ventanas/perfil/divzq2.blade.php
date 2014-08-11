<div name="izq" id="Dizq2" class="oculta" >
<ul class="breadcrumb">
 
  <li class="active">Datos Personales</li>
</ul>
@if(Session::has('messagePersonal'))
<div class="alert alert-dismissable alert-info">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Actualizaci&oacute;n Completa!</strong> {{Session::get('messagePersonal')}}.
</div>
@endif
<div  id="tabla">
<div class="panel panel-default">
  <div class="panel-body">
    <span class='azulito'>Profesional de:</span>&nbsp;{{$empleado->profession}}
  </div>
  <div class="panel-footer"> <span class='azulito'> Especialista en: </span>&nbsp;{{$empleado->specialty}}</div>
</div>

<div class='row'>
<div class='col-md-3'><IMG SRC="{{asset($empleado->photo)}}" class="img-thumbnail" height="200" width="200">
</div>
<div class='col-md-9'>

<table class="table table-striped">
  <tr>
    <td > <span class='azulito'>Nombre</span>&nbsp;{{$empleado->first_name}}</td>
    <td > <span class='azulito'>Documento de Identidad</span>&nbsp;{{$empleado->ident_card}}</td>
  </tr>
  <tr>
    <td > <span class='azulito'>Fecha de Nacimiento</span>&nbsp;{{$empleado->date_birth}}</td>
    <td > <span class='azulito'>G&eacute;nero</span>&nbsp;{{$empleado->sex}}</td>
  </tr>
  <tr>
    <td > <span class='azulito'>Estado Civil</span>&nbsp;{{$empleado->civil_status}}</td>
    <td > <span class='azulito'>Email</span>&nbsp;{{$login}}</td>
  </tr>
  <tr>
    <td  colspan="2"><span class='azulito'>Direcci&oacute;n</span>&nbsp;{{$empleado->address}}</td>
     
  </tr>
  <tr>
    <td ><span class='azulito'>Tel&eacute;fono Local</span>&nbsp;{{$empleado->phone_local}}</td>
    <td ><span class='azulito'>Tel&eacute;fono Cel</span>&nbsp;{{$empleado->phone_cel}}</td>
  </tr>
</table>
</div>
</div>
</div>
<div class="row">
	<div class='col-md-6 col-md-offset-4'>
<a href="#" onclick="reporte()" class="btn btn-info btn-default">Reporte</a>
<a href="{{URL::to('/perfil/datosPersonales/modificar')}}" class="btn btn-info btn-default">Modificar</a>
</div>
</div>

</div>