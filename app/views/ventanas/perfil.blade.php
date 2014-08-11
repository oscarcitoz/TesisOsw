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


</script>
  @stop  


@section('menuPrincipal')
@include('Layouts.Menu.menuPrincipal')
  @stop  


@section('menuIzquierdo')
@include('Layouts.Menu.menuIzquierdoPerfil')
  @stop    


@section('contenido')

@include('ventanas.perfil.divzq1')
@include('ventanas.perfil.divzq2')
@include('ventanas.perfil.divzq3')
<br/>
  @stop  