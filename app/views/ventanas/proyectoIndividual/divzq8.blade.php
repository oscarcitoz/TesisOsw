<div name="izq" id="Dizq8" class="oculta">

<ul class="breadcrumb">
  <li class="active">Empleados asociados al proyecto</li>
</ul>

<div class=​"well bs-component">​
	@if($employees!=null)
	<div class="row col-md-12">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Nombre y Apeliido</th>
				<th>Cedula</th>
				<th>Profesi&oacute;n</th>
				<th>Especialidad</th>
				<th>Estatus</th>
			</tr>
		</thead>
		<tbody>
	@foreach ($employees as $emplo)
	<tr>
		<td>{{$emplo->first_name}} {{$emplo->last_name}}</td>
		<td>{{$emplo->ident_card}}</td>
		<td>{{$emplo->profession}}</td>
		<td>{{$emplo->specialty}}</td>
		<td>{{$emplo->status}}</td>
	</tr>
	@endforeach
	</tbody>
	</table>
	</div>
	@else
	<fieldset class="form-group col-md-8">
		<table class="table" >
			<tr class="danger">
				<td><strong>No existe ningun Empleado asociado al Proyecto</strong></td>
			</tr>
		</table>
	</fieldset>
	@endif
</div>


</div>
