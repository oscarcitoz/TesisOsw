

$(window).scroll(function(){
        if ($(this).scrollTop() > 50) {
            $('.scrollUp').fadeIn();
        } else {
            $('.scrollUp').fadeOut();
        }
});

$(function(){

  $('#IrFinal').click(function () {
       $('html, body').animate({
           scrollTop: $(document).height()
       },
       1500);
       $('.active').attr('class','stick bg-red');
           $('li#Portafolio').attr('class','active');
       return false;
   });
 
   $('#IrInicio').click(function () {
       $('html, body').animate({                        
           scrollTop: '0px'
       },
       1500);
         $('.active').attr('class','stick bg-red');
         $('li#QuienesSomos').attr('class','active');

       return false;
   });


$(".ir").click(function(){
     var dire = $(this).attr('href');
      
         $('.active').attr('class','stick bg-red');
         $("html,body").animate({ scrollTop : $('h1'+dire).offset().top  }, 2000 );
          $('li'+dire).attr('class','active');
        
        return false;
    });

$(".nada").click(function(){
return false;

});

$(".todo").click(function(){
  $("#contacto").slideUp();
  $('#correo').val('');
  $('#descripcion').val('');
return true;

});


});

