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
<div name="izq" id="Dizq1">

@if ($project->count()>0)
	@foreach ($project as $pro)
		<div class="table-responsive text-muted">
			<a class="text-muted" href="#" >
			<table class="table" >
				<tr class="success" >
					<td  width="10%" rowspan="3"><img class="img-rounded" width="100" src="{{asset('images/Proyecto.jpg')}}" alt="Smiley face" ></td>
					<td  width="80%"><strong>Nombre del Proyecto: </strong>{{$pro->name}}</td>
					<td  width="10%"><strong>{{$pro->status}}</strong></td>
				</tr>
				<tr class="success">
					<td colspan="2"><strong>Localidad: </strong>{{$pro->locality}}</td>
				</tr>
				<tr class="success">
					<td colspan="2"><strong>Lider: </strong>{{$pro->user()->first()->employee()->first()->first_name}}</td>
				</tr>
			</table>
			</a>
		</div> 

	@endforeach
@else
	<table class="table" >
			<tr class="danger">
				<td><strong>No existe ningun registro</strong></td>
			</tr>
	</table>
@endif
	<button type="button" class="btn btn-primary" onclick="window.open('{{URL::to('/consultora/more')}}')">Mostrar Todos Los Proyectos</button>
</div>
<div name="izq" id="Dizq2" class="oculta">

@if ($activity->count()>0)
{{$activity}}
	@foreach ($activity as $act)
		<div class="table-responsive">
			<table class="table" >
				<tr class="success" >
					<td  width="10%" rowspan="3"><img class="img-rounded" width="100" src="{{asset('images/Proyecto.jpg')}}" alt="Smiley face" ></td>
					<td  width="80%"><strong>{{$act->name}}</strong></td>
					<td  width="10%"><a  href="#">Propuesta</a></td>
				</tr>
				<tr class="success">
					<td colspan="2">Localidad: {{$act->description}}</td>
				</tr>
				<tr class="success">
					<td colspan="2">Lider</td>
				</tr>
			</table>
		</div>    
	@endforeach
@else
	<table class="table" >
			<tr class="danger">
				<td><strong>No existe ningun registro</strong></td>
			</tr>
	</table>
@endif

</div>

<br/>
  @stop  
