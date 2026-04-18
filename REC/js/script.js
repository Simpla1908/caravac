$(document).ready(function(event) {
   
//    alert("bonjour");
  	$('.add').on('click',function(event){
  		event.preventDefault();
		var hebergement=$('#hebergement').val();
  		$.get($(this).attr('href'),{},function(data){
  			if(data.error){
  				if(confirm('voulez-vous voir la(les) chambre(s) sélectionnée(s)?')){
  					location.href='rec_reservation_client_chambre_paiement.php?hebergement='+hebergement;
  				}
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
        $(".tit_cat").empty().append('Categorie :'+$(this).attr("id1"));
        $(".hotel_class").hide();
        $(".chambre_class").show();
        $("." + $(this).attr("id")).show();
        $(".cha_btn_add").show();
        var id_hotel=$(this).attr("id");
        $(".cha_btn_add").replaceWith("<a href=\"gl_ajout_chambre.php?id_hotel="+id_hotel+"\" class=\"btn btn-squared-default-plain btn-warning\" style=\" margin-top: -10px; margin-left: 10px;\"><i class=\"fa fa-plus-circle fa-3x\"></i><br/>Ajouter <br/>Chambre</a>");
    });
    
        
    });