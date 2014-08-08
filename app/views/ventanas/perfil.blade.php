@extends('Layouts.layout')
@section('title')
Perfil
  @stop

@section('pestania')
Perfil
  @stop  

@section('scripts')
 @parent
 <script type="text/javascript">
function imprimirSito(){document.getElementById('divPrint').style.display='none';window.print();document.getElementById('divPrint').style.display='inline';}



 function reporte()
{
	var contenido="";
    contenido=$("#tabla").html();
 
    /* abro el popup */
    var myWindow=window.open('','_blank','width=1000, height=700, top=50, left=50, scrollbars=1');
 
    var head = '<html><head>';
 	  head += '<title>Reporte</title>';
   
    head += '<style>.azulito{color:#044586; font-weight:bold;}</style>';
     head+="<link rel='stylesheet' href='../css/bootstrap.min.css' media='screen'>";
     head+="<link rel='stylesheet' href='../css/bootswatch.css'>";
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


</script>
  @stop  


@section('menuPrincipal')
@include('Layouts.Menu.menuPrincipal')
  @stop  


@section('menuIzquierdo')
@include('Layouts.Menu.menuIzquierdoPerfil')
  @stop    


@section('contenido')

<div name="izq" id="Dizq1">

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
<div name="izq" id="Dizq2" class="oculta" >
<ul class="breadcrumb">
 
  <li class="active">Datos Personales</li>
</ul>
<div  id="tabla">
<div class="panel panel-default">
  <div class="panel-body">
    <span class='azulito'>Profesional de:</span>
  </div>
  <div class="panel-footer"> <span class='azulito'> Especialista en: </span></div>
</div>

<div class='row'>
<div class='col-md-2'>dsadasddsadasddsadasddsadasddsadasddsadasddsadasddsadasddsadasd
</div>
<div class='col-md-10'>

<table class="table table-striped">
  <tr>
    <th > <span class='azulito'>Nombre</span></th>
    <th > <span class='azulito'>Documento de Identidad</span></th>
  </tr>
  <tr>
    <td > <span class='azulito'>Fecha de Nacimiento</span></td>
    <td > <span class='azulito'>G&eacute;nero</span></td>
  </tr>
  <tr>
    <td > <span class='azulito'>Estado Civil</span></td>
    <td > <span class='azulito'>Email</span></td>
  </tr>
  <tr>
    <td  colspan="2"><span class='azulito'>Direcci&oacute;n</span></td>
     
  </tr>
  <tr>
    <td ><span class='azulito'>Tel&eacute;fono Local</span></td>
    <td ><span class='azulito'>Tel&eacute;fono Cel</span></td>
  </tr>
</table>
</div>
</div>
</div>
<div class="row">
	<div class='col-md-6 col-md-offset-4'>
<a href="#" onclick="reporte()" class="btn btn-info btn-default">Reporte</a>
<a href="#" onclick="reporte()" class="btn btn-info btn-default">Modificar</a>
</div>
</div>

</div>
<div name="izq" id="Dizq3" class="oculta">
<h2> DIV 3</h2>
</div>
<br/>
  @stop  