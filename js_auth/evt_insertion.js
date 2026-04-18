// JavaScript Document
$(document).ready(function(e) {
	// Ajout des produits dans le tableau ou panier
    $('#btnajouter').click(function(e) {
		var val=$('#selectproduit').val();
		
								var $nompro=$('#selectproduit'),
									$ajouter=$('#btnajouter'),
									$libelleproduit=$('#libeleproduit'),
									$quantite=$('#quantite'),
									$qte;
						alert($libelleproduit.val());
		$.post('traite_insert.php',
		{val:val
		},
		function(data){
			//alert(produit);
			$('#panier').after(data);
    });
	});
});

function incrementationqte() {
                                
								var $nompro=$('#selectproduit'),
									$ajouter=$('#btnajouter'),
									$libelleproduit=$('#libeleproduit'),
									$quantite=$('#quantite'),
									$qte;
						//alert($libelleproduit.val());
                            if ($nompro.val() == $libelleproduit.val())
							{
								var qte=parseInt($quantite.val())+1;
								var str=qte.toString();
								$('#quantite').val(str);
								//alert(qte);
							}
					}