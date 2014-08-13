@extends('Layouts.layout')
@section('title')
Empresa
  @stop

@section('style')
@parent
   <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">

     <style>
  .ui-autocomplete {
    max-height: 100px;
    overflow-y: auto;
    /* prevent horizontal scrollbar */
    overflow-x: hidden;
  }
  .letrica
  {
      font: oblique 100% sans-serif bold; 

  }
  /* IE 6 doesn't support max-height
   * we use height instead, but this forces the menu to always be this tall
   */
  * html .ui-autocomplete {
    height: 100px;
  }
  </style>
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
$(function() {
  $( "#formulario" ).submit(function( event ) {
 enviarAjax();
  event.preventDefault();
});
$( "#tags" ).keydown(function(tecla){
    if (tecla.keyCode == 8){
       $("#invisible_id").val("");
    }
});


    var sele="";
    var urlA= "";
    $( "#tags" ).autocomplete({
      minLength: 0,
       source:function( request, response ) {
        urlA= "{{URL::to('/empresa/buscar')}}";
       sele=$('input[name=busque]:checked').val();
        urlA=urlA+"/"+sele;
         $.ajax({
                    url: urlA,
                    dataType: "json",
                    data: {term: request.term},
                    success: function(data) {
                                response($.map(data, function(item) {
                                  if(sele=="profesion")
                                  {
                                     return {
                                    label: item.profession,
                                    id: item.profession,
                                    desc: "",
                                   
                                    };
                                  }
                                  else{
                                return {
                                    label: item.first_name+' '+item.last_name,
                                    id: item.user_id,
                                    desc: item.profession,
                                    cedu:item.ident_card
                                  
                                    };
                                    }
                            }));
                        }
                    });

                },
        select: function( event, ui ) {
          // add the selected item
          //terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          //terms.push( "" );
          $("#invisible_id").val(ui.item.id);
          if(urlA=="{{URL::to('/empresa/buscar')}}"+"/cedula")
          {
             $( "#tags" ).val( ui.item.cedu+" "+ui.item.label );
             return false;
          }
          else{
          return true;}
        },
        
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.label + "<br>" + "<span class='letrica'>"+ item.desc +"</span>"+ "</a>" )
        .appendTo( ul ); };
});

 function enviarAjax() {
           var urlA= $( '#formulario' ).attr( 'action' );
             $.ajax({
                url: urlA,
                type: 'POST',
                data:  $( '#formulario' ).serialize(),
                dataType: 'JSON',
                beforeSend: function() {
                   $("#respuesta").html("Buscando ...<br/> <IMG SRC={{asset('images/wait.gif')}}>");
                },
                error: function() {
                   $("#respuesta").html("<div class='alert alert-dismissable alert-danger'> <button type='button' class='close' data-dismiss='alert'>×</button> <h4>Error!</h4> <p> Ha surgido un error Inesperado. </p></div>");
                },
                success: function(respuesta) {
                   if (respuesta!=0 && respuesta!=1) {
                    var datico="";
                    var urlita="";
                    
                    var datos="<table class='table table-striped table-hover'> ";
                    datos+="<thead><tr><th>Id</th><th>Nombre y Apellido</th><th>Cedula</th>";
                    datos+="<th>Profesi&oacute;n</th>  <th>Status</th></tr></thead>";
                    datos+="<tbody>";
                    for (i = 0; i < respuesta.length; i++) {
                      datico='';
                      urlita='';
                      if(respuesta[i].user_id==undefined){
                    datico = respuesta[i].status;
                     datos+="<tr>";
                     urlita="{{URL::to('empresa/verUsuario/')}}";
                     urlita+="/"+respuesta[i].employee.user_id;
                   datos += "<td>"+respuesta[i].employee.user_id+ "</td>";
                   datos += "<td><a  target='_blank' href='"+urlita+"'>"+respuesta[i].employee.first_name +" "+respuesta[i].employee.last_name+ "</a></td>";
                   datos += "<td>"+respuesta[i].employee.ident_card + "</td>";
                    datos += "<td>"+respuesta[i].employee.profession + "</td>";
                     datos += "<td>"+datico + "</td>";
                   datos+="</tr>";
                   }
                   else {
                     datico = respuesta[i].user_id.split('|');
                      urlita="{{URL::to('empresa/verUsuario/')}}";
                     urlita+="/"+datico[0];
                     datos+="<tr>" 
                   datos += "<td>"+datico[0]+ "</td>";
                   datos += "<td><a target='_blank' href='"+urlita+"'>"+respuesta[i].first_name +" "+respuesta[i].last_name+ "</a></td>";
                   datos += "<td>"+respuesta[i].ident_card + "</td>";
                    datos += "<td>"+respuesta[i].profession + "</td>";
                     datos += "<td>"+datico[1] + "</td>";
                   datos+="</tr>";

                   }
                    }
                     datos+="</tbody></table>";

                    $("#respuesta").html(datos);

                   } else if(respuesta==0){
                       $("#respuesta").html("<div class='alert alert-dismissable alert-danger'> <button type='button' class='close' data-dismiss='alert'>×</button> <h4>Error!</h4> <p> No hay ning&uacute;n empleado con esa caracter&iacute;stica. Intente Nuevamente. </p></div>");
                 
                   }
                   else {
                     $("#respuesta").html("<div class='alert alert-dismissable alert-danger'> <button type='button' class='close' data-dismiss='alert'>×</button> <h4>Error!</h4> <p> Ha surgido un error Inesperado. Complete el formulario correctamente </p></div>");
                   }
                }
             });
          }

</script>
  @stop  







@section('pestania')
Empresa
  @stop  


@section('menuPrincipal')
@include('Layouts.Menu.menuPrincipal')
  @stop  


@section('menuIzquierdo')
@include('Layouts.Menu.menuIzquierdoEmpresa')
  @stop    


@section('contenido')

<div name="izq" id="Dizq1" class="oculta" >
<ul class="breadcrumb">
   <li><a href="{{URL::to('/empresa')}}">Datos de Consultora</a></li>
  <li class="active">Modificar</li>
</ul>


@if(Session::has('messageEdit'))

<div class="row">

<div class=" alert alert-dismissable alert-danger">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Oh Error!</strong> {{Session::get('messageEdit')}}.
</div>
</div>
@endif



<div class=​"well bs-component">​
{{Form::open(array('url'=>'/empresa/update','method'=>'POST'))}}
<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('name', 'Nombre: ')}}
@if($errors->has('name'))
    {{Form::label('name',$errors->first('name'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('name', $customer->name, array('class'=>'form-control','disabled',"required"=>"true"))}}
</fieldset>

<fieldset class="form-group col-md-5">
{{Form::label('rif', 'Rif: ')}}
@if($errors->has('rif'))
    {{Form::label('rif',$errors->first('rif'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('rif', $customer->rif, array('class'=>'form-control','disabled',"required"=>"true"))}}
</fieldset>
</div>
<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('email', 'Email: ')}}
@if($errors->has('email'))
    {{Form::email('email',$errors->first('email'),array('class'=>'label label-warning'))}}
    @endif
{{Form::email('email', $customer->email, array('class'=>'form-control','disabled',"required"=>"true"))}}
</fieldset>

<fieldset class="form-group col-md-5">
{{Form::label('phone', 'Telef&oacute;no: ')}}
@if($errors->has('phone'))
    {{Form::label('phone',$errors->first('phone'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('phone', $customer->phone, array('class'=>'form-control',"required"=>"true"))}}
</fieldset>
</div>

<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('locality', 'Localidad: ')}}
@if($errors->has('locality'))
    {{Form::label('locality',$errors->first('locality'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('locality', $customer->locality, array('class'=>'form-control',"required"=>"true"))}}
</fieldset>

<fieldset class="form-group col-md-5">
{{Form::label('person_contact', 'Persona de Contacto: ')}}
@if($errors->has('person_contact'))
    {{Form::label('person_contact',$errors->first('person_contact'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('person_contact', $customer->person_contact, array('class'=>'form-control',"required"=>"true"))}}
</fieldset>
</div>

<div class="row">
<fieldset class="form-group col-md-5">
{{Form::label('phone_contact', 'Telef&oacute;no de Contacto: ')}}
@if($errors->has('phone_contact'))
    {{Form::label('phone_contact',$errors->first('phone_contact'),array('class'=>'label label-warning'))}}
    @endif
{{Form::text('phone_contact', $customer->phone_contact, array('class'=>'form-control',"required"=>"true"))}}
</fieldset>

</div>

<fieldset class="form-group col-md-5 col-md-offset-4">
<input type="submit" class="btn btn-primary btn-lg" value="Editar"/>  
</fieldset>

{{Form::close()}}



</div>







</div>
@include('ventanas.empresa.divzq2')
@include('ventanas.empresa.divzq3')
<br/>
  @stop  