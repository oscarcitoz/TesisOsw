@extends('Layouts.layout')
@section('title')
Proyecto
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

  .hide { display:none; }
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

$(function() {


$( "#formulario_tipo" ).submit(function( event ) {
	enviarAjax("#formulario_tipo");
  	event.preventDefault();
});

$( "#formulario_status" ).submit(function( event ) {
	enviarAjax("#formulario_status");
  	event.preventDefault();
});

$( "#formulario_project" ).submit(function( event ) {
  if($("#invisible_id").val()==""){
      $('#myModal').modal('show');
    return false;}
    //event.preventDefault();
});

$( "#tags" ).keydown(function(tecla){
    if (tecla.keyCode == 8){
		$("#respuesta").html("");
    }
});

$( "#tags1" ).keydown(function(tecla){
    if (tecla.keyCode == 8){
    $("#invisible_id").val("");
    $("#respuesta2").html("");
    }
});
    
    $( "#tags" ).autocomplete({
      minLength: 1,
       source:function( request, response ) {
       var urlA= "{{URL::to('/proyecto/buscar')}}";
       var sele=$('input[name=busque]:checked').val();
       urlA=urlA+"/"+sele;
         $.ajax({
                    url: urlA,
                    dataType: "json",
                    data: {term: request.term},
                    beforeSend: function() {
	                   $("#respuesta").html("Buscando ...<br/> <IMG SRC={{asset('images/wait.gif')}}>");
	                },
	                error: function() {
	                   $("#respuesta").html("<div class='alert alert-dismissable alert-danger'> <button type='button' class='close' data-dismiss='alert'>×</button> <h4>Error!</h4> <p> Ha surgido un error Inesperado. </p></div>");
	                },
                    success: function(data) {
       					$("#respuesta").html("");
       					if(data=="")
       						return $("#respuesta").html("<div class='alert alert-dismissable alert-danger'> <button type='button' class='close' data-dismiss='alert'>×</button> <h4>Error!</h4> <p> No se han encontrado registros. </p></div>");
                response($.map(data, function(item) {
                var registro="<div class='table-responsive'><a class='text-muted' href='{{URL::to('/project/individual')}}"+"/"+item.id+"' ><table class='table' width='100%'>"
    							+"<tr class='success' ><td rowspan='4' width='10%'><img class='img-rounded' width='100' src='{{asset('images/Proyecto.jpg')}}' alt='Smiley face' ></td></tr>"
    							+"<tr class='success' ><td><strong>Nombre: </strong>"+ item.name + "</td><td><strong>"+ item.status + "</strong></td></tr>"
    							+"<tr class='success' ><td colspan='2'><strong>Localidad: </strong>"+ item.locality + "</td></tr>"
    							+"<tr class='success' ><td colspan='2'><strong>Lider: </strong>"+ item.first_name+ "</td></tr>"
    							+"</table></div>";
					      return $("#respuesta").append(registro);
                    	}));
                    }});
        }
    }).autocomplete( "instance" )._renderItem = function() {
     return true;
 	};
  

$('input[name=busque]').change(function(){
    if($('input[name=busque]:checked').val()=="tipo"){
    	$('#combo_tipo').removeClass("hide");
  		$('#text_busqueda').addClass( "hide" );
    	$('#combo_status').addClass("hide");
    }else if($('input[name=busque]:checked').val()=="status"){
    	$( "#combo_tipo" ).addClass( "hide" );
    	$( "#text_busqueda" ).addClass( "hide" );
    	$( "#combo_status" ).removeClass( "hide" );
    }else{
    	$( "#combo_status" ).addClass( "hide" );
    	$( "#combo_tipo" ).addClass( "hide" );
    	$( "#text_busqueda" ).removeClass( "hide" );
    }
    $( "#tags" ).val("");
    $("#respuesta").html("");
});

var urlA="";

$( "#tags1" ).autocomplete({
      minLength: 0,
       source:function( request, response ) {
       urlA= "{{URL::to('/customer/buscar/customer')}}";
         $.ajax({
                  url: urlA,
                  dataType: "json",
                  data: {term: request.term},
                  success: function(data) {
                    response($.map(data, function(item) {
                      return {
                              name: item.name,
                              id: item.id,
                              email: item.email,
                              rif:item.rif,
                              phone:item.phone,
                              locality:item.locality,
                              phone_contact:item.phone_contact,
                              person_contact:item.person_contact
                              };
                      }));
                    }});
        },
    select: function( event, ui ) {
        $("#invisible_id").val(ui.item.id);
        $("#respuesta2").html("");
        var valor1="{{URL::to('/customer/crear')}}";
        var valor2="_blank"
        var valor3= "width=1000, height=700, top=50, left=50, scrollbars=1"
        var tag="<div class='panel panel-primary'><div class='panel-heading'><h3 class='panel-title'>Cliente</h3></div>"
                +"<div class='panel-body'>"
                +"Nombre: "+ui.item.name+"<br>"
                +"Email: "+ui.item.email+"<br>"
                +"Rif: "+ui.item.rif+"<br>"
                +"Telefono: "+ui.item.phone+"<br>"
                +"Localidad: "+ui.item.locality+"<br>"
                +"Telefono de Contacto: "+ui.item.phone_contact+"<br>"
                +"Persona contacto: "+ui.item.person_contact+"<br>"
                +"</div><div class='panel-footer'>"
                +"<a href='#' class='btn btn-info btn-default' onclick='abreVentana("+ui.item.id+");'>Editar</a>"
                +"</div></div>";
        $("#respuesta2").append(tag);
        $( "#tags1" ).val( ui.item.name);
        return false;  
        },
         
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.name + "<br>" + "<span class='letrica'>"+ item.email +"</span>"+ "</a>" )
        .appendTo( ul ); };

});



function enviarAjax(valor) {

           var urlA= $( valor ).attr( 'action' );
             $.ajax({
                url: urlA,
                type: 'POST',
                data:  $( valor ).serialize(),
                dataType: 'JSON',
                beforeSend: function() {
                   $("#respuesta").html("Buscando ...<br/> <IMG SRC={{asset('images/wait.gif')}}>");
                },
                error: function() {
                   $("#respuesta").html("<div class='alert alert-dismissable alert-danger'> <button type='button' class='close' data-dismiss='alert'>×</button> <h4>Error!</h4> <p> Ha surgido un error Inesperado. </p></div>");
                },
                success: function(data) {
                $("#respuesta").html("");
                if(data=="")
                  return $("#respuesta").html("<div class='alert alert-dismissable alert-danger'> <button type='button' class='close' data-dismiss='alert'>×</button> <h4>Error!</h4> <p> No se han encontrado registros. </p></div>");
                ($.map(data, function(item) {
                var registro="<div class='table-responsive'><a class='text-muted'href='{{URL::to('/project/individual')}}"+"/"+item.id+"' ><table class='table' width='100%'>"
                  +"<tr class='success' ><td rowspan='4' width='10%'><img class='img-rounded' width='100' src='{{asset('images/Proyecto.jpg')}}' alt='Smiley face' ></td></tr>"
                  +"<tr class='success' ><td><strong>Nombre: </strong>"+ item.name + "</td><td><strong>"+ item.status + "</strong></td></tr>"
                  +"<tr class='success' ><td colspan='2'><strong>Localidad: </strong>"+ item.locality + "</td></tr>"
                  +"<tr class='success' ><td colspan='2'><strong>Lider: </strong>"+ item.first_name+ "</td></tr>"
                  +"</table></a></div>";
                return $("#respuesta").append(registro);
                      }));
                }
             });
          }

          function abreVentana(id){
  window.open("{{URL::to('/customer/edtiCustomer/')}}"+"/"+id,"_blank","width=1000, height=700, top=50, left=50, scrollbars=1");
}

</script>
  @stop  

@section('pestania')
Proyecto
  @stop  


@section('menuPrincipal')
@include('Layouts.Menu.menuPrincipal')
  @stop  


@section('menuIzquierdo')
@include('Layouts.Menu.menuIzquierdoProyecto')
  @stop    


@section('contenido')


@include('ventanas.proyecto.divzq1')
@include('ventanas.proyecto.divzq2')



<br/>
  @stop  