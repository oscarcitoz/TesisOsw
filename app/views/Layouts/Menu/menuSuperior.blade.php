
  <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a  href="{{URL::to('/')}}" class="navbar-brand">Consultora</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          

          <ul class="nav navbar-nav navbar-right">
            <li><a href="{{URL::to('/perfil')}}" >{{$nombre}}</a></li>
            <li><a href="{{URL::to('/logout')}}" >Cerrar Sesi&oacute;n</a></li>
          </ul>

        </div>
      </div>
    </div>