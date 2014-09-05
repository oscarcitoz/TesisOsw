@extends('Layouts.layout')
@section('title')
Proyecto
  @stop

@section('style')
@parent
   <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}">
  @stop

@section('scripts')
 @parent
     <script src="{{asset('js/jquery-ui.min.js')}}"></script>
     <script type="text/javascript">
     	$(function() {

        $( "input[name=doc]:radio" ).change(function() {
          $("#invisible_id2").val(this.value);
          if(this.value==0){
            $("#agrega").val("Agregar");
          }else{
            $("#agrega").val("Modficar");
          }
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
		});

    function cambiarstatus(status){
       if (confirm("¿Dese cambiar el estatus de la actividad?") == false) {
      return false;}
     urlA= "{{URL::to('/actividad/individual/cambiarstatus')}}";
     var id={{$activity->id}};
     //var status="Ejecutar";
    $.ajax({
      type: "POST",
      url: urlA,
      data: { id: id, status:status }
    })
      .done(function( msg ) {
        if(msg.indexOf('ERROR')==-1)
    { var noti="<div class='alert alert-dismissable alert-info'>"
      +"<button type='button' class='close' data-dismiss='alert'>×</button>"
      +"<strong>Actividad Actualizada! </strong>"
      +"Modificaci&oacute;n Realizada con &Eacute;xito"
      +"</div>";
      $("#respuesta2").html(noti);
      $("#fecha_fin").html(msg);
      $("#status").hide("slow");
    }
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

     </script>
  @stop  

@section('pestania')

  @stop  


@section('menuPrincipal')
@include('Layouts.Menu.menuPrincipal')
  @stop  


@section('menuIzquierdo')
@include('Layouts.Menu.menuIzquierdoActividadIndividual')
  @stop    


@section('contenido')

@include('ventanas.actividadIndividual.divzq1')
@include('ventanas.actividadIndividual.divzq2')

 
<br/>
  @stop  