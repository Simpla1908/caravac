// JavaScript Document
$(document).ready(function() {
	//  Clic sur commande en espèce
    $('#art').click(function(e) {
		var article=$('#article').val();
		var caisses=' ';
		var imprimantes=' ';
		var ecrans=' ';
		var unite=' ';
		var champagne=' ';
     	 $.post('ajax_traite_produit.php',
        {article:article,
         caisses:caisses,
		 imprimantes:imprimantes,
		 ecrans:ecrans,
		 unite:unite,
		 champagne:champagne
         }, 
         function(data) {
            $('#articles').html(data);
        });
    });
	
	


});