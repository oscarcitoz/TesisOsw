@extends('Layouts.layout')
@section('title')
Proyecto
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

{{$menu}}
<div name="izq" id="Dizq1">

<h2> DIV 1</h2>
</div>
<div name="izq" id="Dizq2" class="oculta">
<h2> DIV 2</h2>
</div>
<br/>
  @stop  