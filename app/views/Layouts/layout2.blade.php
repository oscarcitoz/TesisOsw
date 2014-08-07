<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
      
    <!-- Bootstrap -->
    
     @section('style')
 <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" media="screen">
    <link rel="stylesheet" href="{{asset('css/bootswatch.css')}}">

  @show
   
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

  @section('scripts')
   <!-- Load JavaScript Libraries -->
    <script src="{{asset('js/jquery.min.js')}}"></script>
@show
  </head>
  <body>
    <div class="container">
       @yield('container')
     </div>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

  </body>
</html>