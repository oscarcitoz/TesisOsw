


function menuIzquierdo (obj){

  var id=obj;

$('li[name=izq]').each(function(){
                    if($(this).attr("class")=='active')
                    {
                        $(this).removeAttr("class")
                    }
                });

$('div[name=izq]').each(function(){
                     if($(this).attr("class")!='oculta')
                    {
                        $(this).attr("class",'oculta');
                    }
                });



$("#"+id).attr("class",'active');
$("#D"+id).removeAttr("class");

}