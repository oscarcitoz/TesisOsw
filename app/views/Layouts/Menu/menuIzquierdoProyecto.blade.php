<div class="bs-component">
       
              <ul class="nav nav-pills nav-stacked" style="max-width: 300px;">
                <li name="izq" id="izq1"><a href="javascript:menuIzquierdo('izq1');">Consulta</a></li>
                @if(Auth::user()->role->name=='admin' or Auth::user()->role->name=='gerente')
                	<li name="izq" id="izq2"><a href="javascript:menuIzquierdo('izq2');">Crear Proyecto</a></li>
 				@endif
              </ul>
            </div>