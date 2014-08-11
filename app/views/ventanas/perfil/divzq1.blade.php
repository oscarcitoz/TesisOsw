<div name="izq" id="Dizq1" class="oculta">

<ul class="breadcrumb">
 
  <li class="active">Informaci&oacute;n de Cuenta</li>
</ul>

@if(Session::has('message'))

<div class="row">

<div class="alert alert-dismissable alert-info">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Actualizaci&oacute;n Completa!</strong> {{Session::get('message')}}.
</div>
</div>
@endif
<span style='font-weight:bold;'>Login: </span>{{$login}}
<br/>
<span style='font-weight:bold;'>RAC: </span>{{$perfil}}
<br/><br/>
<a href="{{URL::to('/perfil/changePassword')}}" class="btn btn-info btn-default">Modificar Contraseña</a>

</div>