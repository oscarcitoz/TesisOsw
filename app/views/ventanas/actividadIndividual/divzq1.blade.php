<div name="izq" id="Dizq1" class="oculta">

<ul class="breadcrumb">
  <li class="active">Datos de la actividad</li>
</ul>

<div class=​"well bs-component">​
	<div class="row">
		<strong>Tipo:</strong> {{$types_activitie}}<br><br>
		<strong>Proyecto:</strong> {{$name}}<br><br>
		<strong>Lider del proyecto:</strong> {{$lider->first_name}} {{$lider->last_name}}<br><br>
		<strong>Fecha de Creacci&oacute;n:</strong> {{$activity->date_create}}<br><br>
		<strong>Fecha Propuesta:</strong> {{$activity->date_proposal}}<br><br>
		<strong>Fecha Fin:</strong> {{$activity->date_end}}<br><br>
	</div>
</div>

</div>