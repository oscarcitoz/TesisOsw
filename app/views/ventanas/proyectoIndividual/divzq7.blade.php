<div name="izq" id="Dizq7" class="oculta">

<ul class="breadcrumb">
  <li class="active">Empleados asociados al proyecto</li>
</ul>


@if ($activity!=null)
	@foreach ($activity as $act)
		<div class="table-responsive">
			<a class="text-muted" href="/actividad/individual/{{$act->id}}">
				<table class="table" >
					<tr class="success" >
						<td  width="10%" rowspan="3"><img class="img-rounded" width="100" src="{{asset('images/activi.jpg')}}" alt="Smiley face" ></td>
						<td  width="80%"><strong>{{$act->name}}</strong></td>
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
@else
	<table class="table" >
			<tr class="danger">
				<td><strong>No existe ningun registro</strong></td>
			</tr>
	</table>
@endif

</div>