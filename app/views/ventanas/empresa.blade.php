@extends('Layouts.layout')
@section('title')
Empresa
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

{{$menu}}
<div name="izq" id="Dizq1">

<h2> DIV 1</h2>
</div>
<div name="izq" id="Dizq2" class="oculta">
<h2> DIV 2</h2>
</div>
<div name="izq"  id="Dizq3" class="oculta">
<h2> DIV 3</h2>
</div>
<br/>
  @stop  