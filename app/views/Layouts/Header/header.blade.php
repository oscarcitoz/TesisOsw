
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
  <script src="{{asset('js/menuizq.js')}}"></script>

<script type="text/javascript">
 $(document).ready(function(){

var menu2='{{$menu}}';

$('#'+menu2).addClass( "active" )


});  

</script>

  @show



