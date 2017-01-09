/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */





   //parallax de l'image dans la page d'accueil
(function($){
  $(function(){
    $('.parallax').parallax();
  });
})(jQuery);


//menu déroulant dans l'onglet moncompte
(function($) {
		$(function() {

$('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrain_width: false, // Does not change width of dropdown to that of the activator
      hover: true, // Activate on hover
     // gutter: 0, // Spacing from edge
      belowOrigin: true, // Displays dropdown below the button
      alignment: 'right' // Displays dropdown with edge aligned to the left of button
    }
    
  );

		}); // End Document Ready
})(jQuery); // End of jQuery name space

 
 //pour la barre de navigation qui a le mouvement de la page
  
  (function($){
  $(function(){
   $('.tabs-wrapper .row').pushpin({ top: $('.tabs-wrapper').offset().top });
  });
})(jQuery); 
  
   (function($) {
		$(function() {

      $('.scrollspy').scrollSpy();
  $('#menu').pushpin({ bottom: $('.container').offset().top });
    
 

		}); // End Document Ready
})(jQuery); // End of jQuery name space   