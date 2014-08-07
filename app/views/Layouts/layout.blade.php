<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    @include('Layouts.Header.header')    
<style>

.oculta{
visibility:hidden;
display:none;
}
</style>
  </head>
  <body>
    @include('Layouts.Menu.menuSuperior')
    <div class="container">
        <div class="page-header" id="banner">
        </div>
        <div class="row">
          <div class="col-md-offset-3 col-md-9">
            <div class="row">
              <div class="col-md-5">
                <h1>@yield('pestania')</h1>
              </div>
             <div class="bs-component  col-md-7">
                @yield('menuPrincipal')
              </div>      
            </div>
            <hr> 

        </div>
     </div>

    <div class="row">
       <div class="col-md-3">
           @yield('menuIzquierdo')
      </div>
      <div class="col-md-9">
        @yield('contenido')
      </div>
      @include('Layouts.Footer.footer')
    </div>
  </div>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

  </body>
</html>