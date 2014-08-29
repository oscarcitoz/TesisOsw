<div class="bs-component">       
      <ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
        <li name="izq" id="izq1"><a href="javascript:menuIzquierdo('izq1');">Datos B&aacute;sicos</a></li>
        @if(Auth::user()->role->name=='admin' or Auth::user()->role->name=='gerente')
        <li name="izq" id="izq2"><a href="javascript:menuIzquierdo('izq2');">Presupuesto</a></li>
        @endif
        <li name="izq" id="izq3"><a href="javascript:menuIzquierdo('izq3');">Documentaci&oacute;n</a></li>
        @if(Auth::user()->role->name=='admin' or Auth::user()->role->name=='gerente')
        <li name="izq" id="izq4"><a href="javascript:menuIzquierdo('izq4');">Cambiar Estatus</a></li>
        @endif
        <li name="izq" id="izq5"><a href="javascript:menuIzquierdo('izq5');">Historial</a></li>
        @if(Auth::user()->role->name=='admin' or Auth::user()->role->name=='gerente')
        <li name="izq" id="izq6"><a href="javascript:menuIzquierdo('izq6');">Crear Actividad</a></li>
        @endif
		    <li name="izq" id="izq7"><a href="javascript:menuIzquierdo('izq7');">Consultar Actividades</a></li>
        <li name="izq" id="izq8"><a href="javascript:menuIzquierdo('izq8');">Empleados</a></li>
      </ul>
</div>