// JavaScript Document

// JavaScript Document .addpanier

//$(document).ready(function() {
		
//		$('#validerP').click(function() {
//	var valider=$('#validerP').val();
//	var mois= $("#hotel").val();
//	var annee=$("#hotel").val();
//	alert(mois);
//	if(false){
//	$('#msg').show().fadeOut(4000);
//	$("#table_paie").empty();
//	
//	}
//	else{
//	$.ajax({
//	url:'rec_situation_paiement_hotel.php',
//	async:true,
//	type:'POST',
//	data:"valider="+valider+"&mois="+mois+"&annee="+annee, 
//	global: false,
//	cache: false,
//	success: function(html){
//	$("#table_paie").empty().append(html);
//	}
//	});
//	
//		}
//	
//	return false;
//	});
   /* $('#suivant1').click(function(event) {
	    event.preventDefault();
		
        var date_res = $('#datetimepicker6').val();
        var id_client = $('#id_client').val();
		var id_com = $('#id_commissionnaire1').val();
        var date_arrive = $('#datetimepickerOcc').val();
		var date_sortie = $('#datetimepickerLib').val();
		var adulte = $('#adulte').val();
		var enfant = $('#enfant').val();
		var hebergement = $('#hebergement').val();
		
		
        $.post('Traitement_reservation/envoi_data_reservation.php',
                {
                    date_res : date_res ,
                    id_client: id_client,
					id_com:id_com,
					date_arrive: date_arrive,
					date_sortie:date_sortie,
					adulte: adulte,
					enfant:enfant,
					hebergement:hebergement
                }, function(data) {
					
					if(data==1){
						
						location.href='rec_reservation_client_chambre_paiement.php?hebergement='+hebergement;
						$('#prec_paie').hide()
					}else{
						alert(data);
						}
				    

        },
                'text');

        return false;

    });
<!--Passage chambre à paiemment -->
	 $('#suivant2').click(function(event) {
	    event.preventDefault();
		var hebergement = $('#hebergement').val();
		$('#prec_paie').hide()
		
		location.href='rec_reservation_paiement.php?hebergement='+hebergement;
		
    });
<!--Paiement-->

<!--Liberation-->
	 $('#valider_liberation').click(function(event) {
		 
	    event.preventDefault();
		
		var date_lib = $('#datetimepickerLib1').val();
		var id_client = $('#id_client').val();
		var num_res = $('#num_res').val();
		var id_ch = $('#id_ch').val();
		
		
		//var num_res =$('#num_res').val();
	
		
		 $.post('Traitement_propre/liberation_traitement.php',
                {
				   date_lib:date_lib,  
				  id_client:id_client,
				  num_res:num_res,
				  id_ch:id_ch
				        
				 },
			    function(data) {
				$('#datetimepickerLib1').val(' ');	
				alert(data);
               },
                'text');
		
		return false;
    });
<!--Liberation-->

<!--Occupation indirecte -->
	 $('#valider_occup').click(function(event) {
		 
	    event.preventDefault();
		
		 var num_reserv = $('#num_reserv').val();
		 var id_res = $('#id_res').val();
		 var id_chambre = $('#id_chambre').val();
		 var id_client = $('#id_client').val();
		  
		 $.post('Traitement_reservation/occupation.php',
                {
                    
					num_reserv: num_reserv,
					id_chambre:id_chambre,
					id_client:id_client,
					id_res:id_res
					
                }, function(json) {
            		$('#id_client').empty();
				$.each(json, function(index, value) {
                       $('#id_client').append('<option value="'+ index +'">'+ value +'</option>');
                 });
					alert('Attribution chambre reussie!');

        },
                'json');

        return false;
		
    });
<!--Occupation indirecte-->
	 $('#save_reservation').click(function(event) {
		
	    event.preventDefault();
		
		var monnaie = $('#monnaie').val();
		var mode = $('#mode').val();
		var montant = $('#montant').val();
        var montantUSD = $('#montantUSD').val();
		var montantFC = $('#montantFC').val();
		var remise = $('#remise').val();
		var majoration = $('#majoration').val();
		var justif = $('#justif').val();
		var hebergement = $('#hebergement').val();
		var reservation ='multuple';
		
        $.post('Traitement_reservation/enreg_paiement.php',
                {
                     monnaie:monnaie  ,
                    mode: mode,
					montant:montant,
					montantUSD: montantUSD,
					montantFC:montantFC,
					remise: remise,
					justif:justif,
					majoration: majoration,
					hebergement: hebergement,
					reservation:reservation
                }, function(data) {
					
					if(data==1){
						
						alert('La réservation est effectuée avec succès.');
						$('#save_reservation').hide();
						$('#prec_paie').show();
						$('#precedent').hide();
						$('#imprimer_fact').show();
					
					}else if(data==2){
						
						alert("L'occupation est effectuée avec succès.");
						$('#save_reservation').hide();
						$('#prec_paie').show();
						$('#precedent').hide();
						$('#imprimer_fact').show();
						
					}else{
						alert(data);
						}
					
            		
					

        },
                'text');

        return false;
		
		
    });
	
	<!-- Completer Paiement-->
	 $('#completer_paiement').click(function(event) {
		
	    event.preventDefault();
		
		var monnaie = $('#monnaie').val();
		var mode = $('#mode').val();
		var montant = $('#montant').val();
        var montantUSD = $('#montantUSD').val();
		var montantFC = $('#montantFC').val();
		var justif = $('#justif').val();
		var reste = $('#reste').val();
		var num_fact = $('#num_fact').val();
		var reservation ='multuple';
		
        $.post('Traitement_reservation/completer_paiement.php',
                {
                     monnaie:monnaie  ,
                    mode: mode,
					montant:montant,
					montantUSD: montantUSD,
					montantFC:montantFC,
					justif:justif,
					reste:reste,
					num_fact:num_fact,
					reservation:reservation
                }, function(data) {
            		
					if(data==1){
						$('#completer_paiement').hide();
						alert('Le paiement est effectué avec succès.');
						
						$('#imprimer_fact').show();
						
					}else{
						alert(data);
						}
		

        },
                'text');

        return false;
		
		
    });
//Insertion client


	 $('#btn_save_client').click(function(event) {
		
	    event.preventDefault();
		
		var nom_client = $('#nom_client').val();
		var date_naiss_client = $('#datetimepicker6').val();
		var sexe_client = $('#sexe_client').val();
        var etat_civil_client = $('#etat_civil_client').val();
		var nationalite_client = $('#nationalite_client').val();
		var provenance_client = $('#provenance_client').val();
		var adresse_provenance_client = $('#adresse_provenance_client').val();
		var num_piece_identite_client = $('#num_piece_identite_client').val();
		var num_passeport_client = $('#num_passeport_client').val();
		var email_client = $('#email_client').val();
		var telephone_client = $('#telephone_client').val();
		var num_pers_contacter_client = $('#num_pers_contacter_client').val();
		var id_respo = $('#id_respo').val();
		var btn_save_client = $('#btn_save_client').val();
		
        $.post('Traitement_reservation/insertion_client.php',
                {
                     nom_client:nom_client  ,
                    date_naiss_client: date_naiss_client,
					sexe_client:sexe_client,
					etat_civil_client: etat_civil_client,
					nationalite_client:nationalite_client,
					provenance_client: provenance_client,
					num_piece_identite_client:num_piece_identite_client,
					num_passeport_client: num_passeport_client,
					email_client:email_client,
					telephone_client: telephone_client,
					num_pers_contacter_client:num_pers_contacter_client,
					adresse_provenance_client:adresse_provenance_client,
					id_respo: id_respo,
					btn_save_client: btn_save_client
					
                }, function(data) {
            		$('#nom_client').val(' ');
					$('#datetimepicker6').val(' ');
					$('#sexe_client').val('');
					$('#etat_civil_client').val(' ');
				    $('#nationalite_client').val(' ');
				    $('#provenance_client').val(' ');
				    $('#adresse_provenance_client').val(' ');
		            $('#num_piece_identite_client').val(' ');
				    $('#num_passeport_client').val(' ');
				    $('#email_client').val(' ');
				    $('#telephone_client').val(' ');
				    $('#num_pers_contacter_client').val(' ');
				    $('#id_respo').val(' ');
					alert(data);
					
					//$('#id_client').append('<option>'+' new client'+'</option>');
		

        },
                'text');

        return false;
		
		
    });
	
	
*/
	

//});