@extends('Layouts.layout')
@section('title')
Mi Consultora
  @stop

@section('pestania')
Mi Consultora
  @stop  

@section('scripts')
 @parent
<script type="text/javascript">
$(document).ready(function() {
   $('#izq1').removeClass("active");
   $('#izq2').addClass("active");
});
</script>
  @stop

@section('menuPrincipal')
@include('Layouts.Menu.menuPrincipal')
  @stop    

@section('menuIzquierdo')
@include('Layouts.Menu.menuIzquierdoMiConsultora')
  @stop


@section('contenido')

<div name="izq" id="Dizq1" class="oculta">

{{Form::open(array('url'=>'/consultora/more_project','method'=>'GET'))}}
	<div style='font-size:16;'>
		<ul class="breadcrumb">
		  <li>Ultimos 5 Proyectos</li>
		</ul>
	</div>

@if ($count_project>0)
	@foreach ($project as $pro)
		<div class="table-responsive text-muted">
			<a class="text-muted" href="{{URL::to('/project/individual')}}/{{$pro->id}}">
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
@if ($count_project>5)
	<input type="submit" class="btn btn-primary" value="Mostrar Todos Los Proyectos">
@endif

{{Form::close()}}
	
</div>

<div name="izq" id="Dizq2" >

	<div style='font-size:16;'>
		<ul class="breadcrumb">
		  <li>Ultimas 5 Actividades</li>
		</ul>
	</div>
	

	@foreach ($activity as $act)
		<div class="table-responsive">
			<a class="text-muted" href="{{URL::to('/actividad/individual/')}}/{{$act->id}}">
				<table class="table" >
					<tr class="success" >
						<td  width="10%" rowspan="3"><img class="img-rounded" width="100" src="{{asset('images/activi.jpg')}}" alt="Smiley face" ></td>
						<td  width="80%"><strong>{{$act->types_activitie()->first()->name}}</strong></td>
						<td  width="10%">{{$act->status}}</td>
					</tr>
					<tr class="success">
						<td colspan="2">Fecha Propuesta: {{$act->date_proposal}}</td>
					</tr>
					<tr class="success">
						<td colspan="2">Descripción de la Actividad: {{$act->description}}</td>
					</tr>
				</table>
			</a>
		</div>    
	@endforeach


{{$activity->links()}}

</div>

<br/>
  @stop  
