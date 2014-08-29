<div name="izq" id="Dizq1" class="oculta">

<ul class="breadcrumb">
  <li class="active">Datos de la actividad</li>
</ul>

<div class="row">
<div id="respuesta2" class=" col-md-offset-0 col-md-9">

</div>
</div>

<div class=​"well bs-component">​
	<div class="row">
		<fieldset class="form-group col-md-5">
			<strong>Tipo:</strong> {{$types_activitie}}<br><br>
			<strong>Proyecto:</strong> {{$name}}<br><br>
			<strong>Lider del proyecto:</strong> {{$lider->first_name}} {{$lider->last_name}}<br><br>
			<strong>Fecha de Creacci&oacute;n:</strong> {{$activity->date_create}}<br><br>
			<strong>Fecha Propuesta:</strong> {{$activity->date_proposal}}<br><br>
			<strong>Fecha Fin: </strong><span id="fecha_fin">{{$activity->date_end}}</span><br><br>
		</fieldset>
	</div>
	<div class="row">
	@if ($project->status != "Paralizado" and $project->status != "Cerrado" and $project->status != "Finalizado" and $activity->status=="Asignada" and $activity->user_id==Auth::user()->id)
		<fieldset class="form-group col-md-5">
			<input type="button" class="btn btn-primary btn-lg" value="Ejecutar" id="status" onclick="cambiarstatus('Ejecutar')"/>  
		</fieldset>
	@elseif ($project->status != "Paralizado" and $project->status != "Cerrado" and $project->status != "Finalizado" and $activity->status=="Ejecutar" and $lider->user_id==Auth::user()->id)
		<fieldset class="form-group col-md-5">
			<input type="button" class="btn btn-primary btn-lg" value="Cerrado" id="status" onclick="cambiarstatus('Cerrado')"/>  
		</fieldset>
	@endif
	</div>
</div>

</div>