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
$(function() {
$('#myModal').modal('show');
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


<!-- Modal -->
{{Form::open(array('url'=>'/perfil','method'=>'GET'))}}
 <div id="myModal" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title">Bienvenido</h4>
      </div>
      <div class="modal-body">
        <p>Es necesario que llenar sus datos antes de empezar. Para ello diríjase a perfil o de clic en el botón.</p>
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" value="Ir a mi Perfil">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{Form::close()}}


<div name="izq" id="Dizq1">
{{Form::open(array('url'=>'/consultora/more_project','method'=>'GET'))}}
	<div style='font-size:16;'>
		<ul class="breadcrumb">
		  <li>Ultimos 5 Proyectos</li>
		</ul>
	</div>

@if ($count_project>0)
	@foreach ($project as $pro)
		<div class="table-responsive">
			<a class="text-muted" href="#" >
			<table class="table" >
				<tr class="success" >
					<td  width="10%" rowspan="3"><img class="img-rounded" width="100" src="{{asset('images/Proyecto.jpg')}}" alt="Proyecto" ></td>
					<td  width="80%"><strong>Nombre del Proyecto: </strong>{{$pro->name}}</td>
					<td  width="10%"><strong>{{$pro->status}}</strong></td>
				</tr>
				<tr class="success">
					<td colspan="2"><strong>Localidad: </strong>{{$pro->locality}}</td>
				</tr>
				<tr class="success">
					<td colspan="2"><strong>Lider: </strong>{{$pro->first_name}}</td>
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


<!-- ACTIVIDADES-->


<div name="izq" id="Dizq2" class="oculta">
{{Form::open(array('url'=>'/consultora/more_activity','method'=>'GET'))}}
	<div style='font-size:16;'>
		<ul class="breadcrumb">
		  <li>Ultimas 5 Actividades</li>
		</ul>
	</div>
	
@if ($count_activity>0)
	@foreach ($activity as $act)
		<div class="table-responsive">
			<a class="text-muted" href="#">
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

@if ($count_activity>5)
	<input type="submit" class="btn btn-primary" value="Mostrar Todos Las Actividades">
@endif

{{Form::close()}}
</div>

<br/>
  @stop  
