/*Para o paralax da página*/
jQuery(document).ready(function($) { 
	$(".scroll").click(function(event){		
		event.preventDefault();
		$('html,body').animate({scrollTop:$(this.hash).offset().top}, 800);
	});
});

/*Fazer os scroll descer lentamente até o local desejado*/
$(document).ready(function(){
 $window = $(window);
 $('section[data-type="background"]').each(function(){
   var $scroll = $(this);                 
    $(window).scroll(function() {
      var yPos = -($window.scrollTop() / $scroll.data('speed')); 
       var coords = '50% '+ yPos + 'px';
      $scroll.css({ backgroundPosition: coords });    
    });
 });  
});

/*Mostrar e esconder uma div*/
function change(field)
{
  if( document.getElementById(field).style.visibility == "hidden")
        document.getElementById(field).style.visibility = "visible";
  else
        document.getElementById(field).style.visibility = "hidden";
}
          