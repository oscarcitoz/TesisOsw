@extends('Layouts.layout')
@section('title')
Mi Consultora
  @stop

@section('pestania')
Mi Consultora
  @stop  


@section('menuPrincipal')
@include('Layouts.Menu.menuPrincipal')
  @stop  


@section('menuIzquierdo')
@include('Layouts.Menu.menuIzquierdoMiConsultora')
  @stop    


@section('contenido')

{{$menu}}
<div name="izq" id="Dizq1">

<h2> DIV 1</h2>
</div>
<div name="izq" id="Dizq2" class="oculta">
<h2> DIV 2</h2>
</div>

<br/>
  @stop  
