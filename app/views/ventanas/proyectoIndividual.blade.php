@extends('Layouts.layout')
@section('title')
Proyecto
  @stop

@section('style')
@parent
   <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">

<style type="text/css">
  .hide { display:none; }

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

 var ventana=null;
 function abreVentana(id,ruta){
 	var URL="{{URL::to('/customer/edtiCustomer')}}";
  ventana  =  window.open(URL+"/"+id,"Modificacion","width=1000, height=700, top=50, left=50, scrollbars=yes");
  ventana.focus();
  }

  function cambiarPresupuesto(){
     urlA= "{{URL::to('/project/individual/actualizaMonto')}}";
     var id={{$project->id}};
     var amount=$("#amount_contract").val();
    $.ajax({
      type: "POST",
      url: urlA,
      data: { id: id, amount:amount }
    })
      .done(function( msg ) {
        if(msg.indexOf('ERROR')==-1)
    { var noti="<div class='alert alert-dismissable alert-info'>"
      +"<button type='button' class='close' data-dismiss='alert'>×</button>"
      +"<strong>Presupuesto Actualizado! </strong>"
      +"Modificación Realizada con Exito"
      +"</div>";
      $("#respuesta2").html(noti);}
    else{
      var noti="<div class='alert alert-dismissable alert-danger'>"
      +"<button type='button' class='close' data-dismiss='alert'>×</button>"
      +"<strong>Oh Error! =(</strong><br>"
      +msg
      +"</div>";
      $("#respuesta2").html(noti);}

      }) .fail(function() {
        var noti="<div class='alert alert-dismissable alert-danger'>"
      +"<button type='button' class='close' data-dismiss='alert'>×</button>"
      +"<strong>Registro Completo!</strong>"
      +"Ha ocurrido un error Inesperado, intente nuevamente"
      +"</div>";
      $("#respuesta2").html(noti); 
  });
}

$(function() {

$( "#formulario_Status" ).submit(function( event ) {
    if (confirm("¿Dese cambiar el estatus del proyecto?") == false) {
      return false;}
    //event.preventDefault();
});

  $("#cargar").hide();

$( "#agrega" ).click(function() {
    if($("#cargar").is(":visible")){
      $("#cargar").hide("slow");
      $( "#agrega" ).val("Agregar");
    }else{
      $("#cargar").show( "slow" );
      $( "#agrega" ).val("Ya no Agregar");
    }
});
  
$( "#tags" ).keydown(function(tecla){
    if (tecla.keyCode == 8){
       $("#invisible_user_id").val("");
    }
});


    $( "#formulario_Act" ).submit(function( event ) {
  if($("#invisible_user_id").val()==""){
      $('#myModal').modal('show');
    return false;}
    //event.preventDefault();
});

    
    var urlA= "";
    $( "#tags" ).autocomplete({
      minLength: 0,
       source:function( request, response ) {
        urlA= "{{URL::to('/empresa/buscar/nombre')}}";
       
         $.ajax({
                    url: urlA,
                    dataType: "json",
                    data: {term: request.term},
                    success: function(data) {
                                response($.map(data, function(item) {
                                  
                                return {
                                    label: item.first_name+' '+item.last_name,
                                    id: item.user_id,
                                    desc: item.profession,
                                    cedu:item.ident_card
                                  
                                    };
                                    
                            }));
                        }
                    });

                },
        select: function( event, ui ) {
          // add the selected item
          //terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          //terms.push( "" );
          $("#invisible_user_id").val(ui.item.id);
          
          return true;
        },
        
    }).autocomplete( "instance" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.label + "<br>" + "<span class='letrica'>"+ item.desc +"</span>"+ "</a>" )
        .appendTo( ul ); };

});





 
</script>
  @stop  

@section('pestania')
{{$project->name}}
  @stop  


@section('menuPrincipal')
@include('Layouts.Menu.menuPrincipal')
  @stop  


@section('menuIzquierdo')
@include('Layouts.Menu.menuIzquierdoProyectoIndividual')
  @stop    


@section('contenido')

@include('ventanas.proyectoIndividual.divzq1')
@if(Auth::user()->role->name=='admin' or Auth::user()->role->name=='gerente')
@include('ventanas.proyectoIndividual.divzq2')
@endif
@include('ventanas.proyectoIndividual.divzq3')
@if(Auth::user()->role->name=='admin' or Auth::user()->role->name=='gerente')
@include('ventanas.proyectoIndividual.divzq4')
@endif
@include('ventanas.proyectoIndividual.divzq5')
@if(Auth::user()->role->name=='admin' or Auth::user()->role->name=='gerente')
@include('ventanas.proyectoIndividual.divzq6')
@endif
@include('ventanas.proyectoIndividual.divzq7')
@include('ventanas.proyectoIndividual.divzq8')

 
<br/>
  @stop  