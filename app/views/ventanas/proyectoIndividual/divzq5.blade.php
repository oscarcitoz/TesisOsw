<div name="izq" id="Dizq5" class="oculta">

<ul class="breadcrumb">
  <li class="active">Historial</li>
</ul>

<div class=​"well bs-component">​
	<div class="row">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Comentario</th>
				<th>Fecha</th>
				<th>Estatus</th>
			</tr>
		</thead>
		<tbody>
@foreach ($record as $red)
	<tr>
		<td>{{$red->comment}}</td>
		<td>{{$red->date_create}}</td>
		<td>{{$red->status}}</td>
	</tr>
@endforeach
	</tbody>
	</table>
	</div>
</div>
</div>