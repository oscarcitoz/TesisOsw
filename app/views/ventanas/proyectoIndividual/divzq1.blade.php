<div name="izq" id="Dizq1" class="oculta">

<ul class="breadcrumb">
  <li class="active">Datos del Proyecto</li>
</ul>

<div class=​"well bs-component">​
	<div class="row">
		<fieldset class="form-group col-md-5">
		{{Form::label('name', 'Nombre del Proyecto: ')}}
		@if($errors->has('name'))
		    {{Form::label('name',$errors->first('name'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::text('name', $project->name, array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255','disabled'=>"true"))}}
		</fieldset>

		<fieldset class="form-group col-md-5">
		{{Form::label('description', 'Descripci&oacute;n: ')}}
		@if($errors->has('description'))
		    {{Form::label('description',$errors->first('description'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::text('description',$project->description, array('class'=>'form-control',"required"=>"true", 'maxlength'=>'255','disabled'=>"true"))}}
		</fieldset>
	</div>
</div>

<div class=​"well bs-component">​
	<div class="row">
		<fieldset class="form-group col-md-5">
		{{Form::label('locality', 'Localidad: ')}}
		@if($errors->has('locality'))
		    {{Form::label('locality',$errors->first('locality'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::text('locality', $project->locality, array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255','disabled'=>"true"))}}
		</fieldset>

		<fieldset class="form-group col-md-5">
		{{Form::label('status', 'Estatus: ')}}
		@if($errors->has('status'))
		    {{Form::label('status',$errors->first('status'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::select('status',$combox,$project->status, array('class'=>'form-control',"required"=>"true", 'maxlength'=>'255','disabled'=>'true'))}}
		</fieldset>
	</div>
</div>

<div class=​"well bs-component">​
	<div class="row">
		<fieldset class="form-group col-md-5">
		{{Form::label('date_create', 'Fecha de creaci&oacute;n: ')}}
		@if($errors->has('date_create'))
		    {{Form::label('date_create',$errors->first('date_create'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::text('date_create', $project->date_create, array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255','disabled'=>"true"))}}
		</fieldset>

		<fieldset class="form-group col-md-5">
		{{Form::label('date_end', 'Fecha de Cierre: ')}}
		@if($errors->has('date_end'))
		    {{Form::label('date_end',$errors->first('date_end'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::text('date_end',$project->date_end, array('class'=>'form-control',"required"=>"true", 'maxlength'=>'255','disabled'=>'true'))}}
		</fieldset>
	</div>
</div>

<div class=​"well bs-component">​
	<div class="row">
		<fieldset class="form-group col-md-5">
		{{Form::label('first_name', 'Lider de Proyecto: ')}}
		@if($errors->has('first_name'))
		    {{Form::label('first_name',$errors->first('first_name'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::text('first_name', $project->first_name, array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255','disabled'=>"true"))}}
		</fieldset>
	</div>
</div>



<br>

<ul class="breadcrumb">
  <li class="active">Datos del Cliente</li>
</ul>

<div class=​"well bs-component">​
	<div class="row">
		<fieldset class="form-group col-md-5">
		{{Form::label('name', 'Cliente: ')}}
		@if($errors->has('name'))
		    {{Form::label('name',$errors->first('name'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::text('name', $Customer->name, array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255','disabled'=>"true"))}}
		</fieldset>

		<fieldset class="form-group col-md-5">
		{{Form::label('rif', 'Rif: ')}}
		@if($errors->has('rif'))
		    {{Form::label('rif',$errors->first('rif'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::text('rif',$Customer->rif, array('class'=>'form-control',"required"=>"true", 'maxlength'=>'255','disabled'=>'true'))}}
		</fieldset>
	</div>
</div>

<div class=​"well bs-component">​
	<div class="row">
		<fieldset class="form-group col-md-5">
		{{Form::label('email', 'Correo: ')}}
		@if($errors->has('email'))
		    {{Form::label('email',$errors->first('email'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::text('email', $Customer->email, array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255','disabled'=>"true"))}}
		</fieldset>

		<fieldset class="form-group col-md-5">
		{{Form::label('person_contact', 'Persona de Contacto: ')}}
		@if($errors->has('person_contact'))
		    {{Form::label('person_contact',$errors->first('person_contact'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::text('person_contact',$Customer->person_contact, array('class'=>'form-control',"required"=>"true", 'maxlength'=>'255','disabled'=>'true'))}}
		</fieldset>
	</div>
</div>

<div class=​"well bs-component">​
	<div class="row">
		<fieldset class="form-group col-md-5">
		{{Form::label('phone_contact', 'T&eacute;lefono de Contacto: ')}}
		@if($errors->has('phone_contact'))
		    {{Form::label('phone_contact',$errors->first('phone_contact'),array('class'=>'label label-warning'))}}
		    @endif
		{{Form::text('phone_contact', $Customer->phone_contact, array('class'=>'form-control',"required"=>"true" , 'maxlength'=>'255','disabled'=>"true"))}}
		</fieldset>

	</div>
</div>
<div class=​"well bs-component">​
	<div class="row">
		<fieldset class="form-group col-md-5 col-md-offset-4">
		<a href='#' class='btn btn-info btn-default' onclick='abreVentana({{$Customer->id}},"customer");'>Editar</a>
	</fieldset>
	</div>
</div>

</div>