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