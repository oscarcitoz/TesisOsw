		

	<div class="bs-component">
           
                  <ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
                    <li  name="izq" id="izq1" ><a   href="javascript:menuIzquierdo('izq1');">Datos de Consultora</a></li>
                   @if(Auth::user()->role->name=='admin')
                    <li  name="izq" id="izq2"><a  href="javascript:menuIzquierdo ('izq2');">Registrar Empleado</a></li>
                     @endif
                     <li  name="izq" id="izq3"><a  href="javascript:menuIzquierdo ('izq3');">Buscar Empleado</a></li>
                  </ul>
		</div>