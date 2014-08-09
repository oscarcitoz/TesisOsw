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


@section('contenido')
<div>
	    @foreach ($users as $pro)
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
	

	
		{{$users->links()}}
	
</div>

<br/>
  @stop  
