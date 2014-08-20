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

</script>
  @stop  

@section('pestania')
Proyecto
  @stop  


@section('menuPrincipal')
@include('Layouts.Menu.menuPrincipal')
  @stop  


@section('menuIzquierdo')
@include('Layouts.Menu.menuIzquierdoProyectoIndividual')
  @stop    


@section('contenido')

@include('ventanas.proyectoIndividual.divzq1')
@include('ventanas.proyectoIndividual.divzq2')
@include('ventanas.proyectoIndividual.divzq3')
@include('ventanas.proyectoIndividual.divzq4')
@include('ventanas.proyectoIndividual.divzq5')
@include('ventanas.proyectoIndividual.divzq6')
@include('ventanas.proyectoIndividual.divzq7')
@include('ventanas.proyectoIndividual.divzq8')

 
<br/>
  @stop  