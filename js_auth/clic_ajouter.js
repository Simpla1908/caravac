// JavaScript Document
$(document).ready(function() {


    // Clic sur commande par consignation
     $('#btnajouter a').click(function(e) {
      e.preventDefault();
         var id=$('#idprod').val();
         
          $.post('addpanier.php', 
          {id:id
           }, 
          function(data) {
            $('#corpsDte').html(data);
        });
	
    });
    
	
	

});