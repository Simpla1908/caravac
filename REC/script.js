$(document).ready(function(event) {
   
//    alert("bonjour");
  	$('.add').on('click',function(event){
  		event.preventDefault();
		var hebergement=$('#hebergement').val();
  		$.get($(this).attr('href'),{},function(data){
  			if(data.error){
                            $("#panier_ch").load('IHMpanier.php');
//  				if(confirm('voulez-vous voir la(les) chambre(s) sélectionnée(s)?')){
//  					location.href='rec_reservation_client_chambre_paiement.php?hebergement='+hebergement;
//  				}
                        
  			}else{
  					alert (data.message);
  			}
  		},'json');
  	});
  	
  	$('#add1').on('click',function(event){
  		alert($('#case').val());
  	});

    $(".cat").click(function () {
        $(".cha").hide();
        $(".tit_cat").empty().append('Hotel :'+$(this).attr("id1"));
        $("." + $(this).attr("id")).show();
    });
    
        
    });