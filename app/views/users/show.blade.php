@extends('Layouts.layout2')
@section('title')
Usuario
  @stop

@section('scripts')
 @parent
     <script src="{{asset('js/jquery-ui.min.js')}}"></script>
 <script type="text/javascript">

 function reporte()
{
	var contenido="";
    contenido=$("#tabla").html();
 
    /* abro el popup */
    var myWindow=window.open('','_blank','width=1000, height=700, top=50, left=50, scrollbars=1');
 
    var head = '<html><head>';
 	  head += '<title>Reporte</title>';
   

    var libre1="{{asset('css/bootstrap.min.css')}}";
    var libre2="{{asset('css/bootswatch.css')}}";

    head += '<style>.azulito{color:#044586; font-weight:bold;}</style>';
     head+="<link rel='stylesheet' href="+libre1+" media='screen'>";
     head+="<link rel='stylesheet' href="+libre1+">";
    head += '</head>';
     
    var body = '<body  onload="window.print()"><div id="printArea"<br/><h3>Datos Personales</h3>'
    body += contenido+"</div>";
    //var btnPrint = "<button onclick='imprimirSito();' class='btn btn-info btn-default'>Imprimir </button>";
      // var btnClose = "<button onclick='window.close();' class='btn btn-info btn-default'>Cerrar </button>";
    //var divPrint = "<div id='divPrint' class='col-md-6 col-md-offset-4'>";
    //divPrint += btnPrint;
    //divPrint += "&nbsp;&nbsp;";
    //divPrint += btnClose;
    //divPrint += "</div>";
      //body+=divPrint;
    body += '</body></html>';
     
    myWindow.document.write(head+body);
    myWindow.document.close();
 
    return myWindow;
}

function cambiarStatus()
{
 urlA= "{{URL::to('/empresa/actualizaStatus')}}";
 var id={{$id}};
$.ajax({
  type: "POST",
  url: urlA,
  data: { id: id }
})
  .done(function( msg ) {
     $('#stat').hide();
    if(msg ==1)
    {
     
      $('#data').html("<div class='alert alert-dismissable alert-info'  id='stat'><span><strong>Status:</strong> Activo</span></div>");
    }

    else {
        $('#data').html("<div class='alert alert-dismissable alert-warning'  id='stat'><span id='stat'><strong>Status:</strong> Inactivo</span></div>");
    }
  }) .fail(function() {
    alert( "Ha ocurrido un error Inesperado, intente nuevamente" );
  });
}
</script>
 @stop
@section('container')

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
<div class='col-md-3'>
@if($status==1)
<div class="alert alert-dismissable alert-info"  id='stat'>
<span>
<strong>Status:</strong> 
Activo
</span>
</div>
@else 
<div class="alert alert-dismissable alert-warning"  id='stat'>
<span id='stat'>
  <strong>Status:</strong> 
Inactivo
</span>
</div>
@endif
<div id='data'>
</div>
<br/>
</div>
</div>
</div>
</div>
<div class="row">
	<div class='col-md-6 col-md-offset-4'>
<a href="#" onclick="reporte()" class="btn btn-info btn-default">Reporte</a>
<a href="#" onclick="cambiarStatus()" class="btn btn-info btn-default">Cambiar Status</a>

<a class="btn btn-info btn-default" href="{{asset($empleado->curriculum)}}" target="_blank">Ver Curriculum</a>
</div>
</div>


@stop 