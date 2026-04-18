$(document).ready(function() {
//  Clic sur commande en espèce
    $('#espece').click(function(e) {
        e.preventDefault();
        var Commande_espece=$('#Commande_espece').val();
        var Commande_consignation=' ';
        $.post('ajaxAfficheCommande.php',
        {Commande_espece:Commande_espece,
         Commande_consignation:Commande_consignation
         }, 
         function(data) {
            $('#corpsDte').html(data);
        });
    });
    // Clic sur commande par consignation
     $('#consignation').click(function(e) {
        e.preventDefault();
         var Commande_consignation=$('#Commande_consignation').val();
         var Commande_espece=' ';
          $.post('ajaxAfficheCommande.php', 
          {Commande_consignation:Commande_consignation,
           Commande_espece:Commande_espece}, 
          function(data) {
            $('#corpsDte').html(data);
        });
    });
    // Clic sur go!
     $('#recherche').keyup(function(e) {
        e.preventDefault();
         var client=$(this).val();
         var Commande_espece=' ';
         var Commande_consignation=$('#Commande_consignation').val();
          $.post('p.php', 
          {client:client,
           Commande_consignation:Commande_consignation,
           Commande_espece:Commande_espece
          }, 
          function(data) {
            $('#corpsDte').html(data);
        });
    });
	    // Clic sur go!
     $('#select').change(function(e) {
     	 var val=$(this).val();
		    $.post('p.php', 
          {val:val,
           
          }, 
          function(data) {
            $('#corpsDte').html(data);
        });
    });
	

});