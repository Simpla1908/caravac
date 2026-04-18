// JavaScript Document
//Insertion client
$(document).ready(function() {
//Insertion utilisateur
	 $('#save_user').click(function(event) {
		
	    event.preventDefault();
		
		var nom_user = $('#nom_user').val();
		var prenom_user = $('#prenom_user').val();
		 var sexe_user = $('#sexe_user').val();
		var telephone_user = $('#telephone_user').val();
		var email_user = $('#email_user').val();
		var mdp_user = $('#mdp_user').val();
		var mdp_user2 = $('#mdp_user2').val();
		var id_droit = $('#id_droit').val();
		var id_hotel = $('#id_hotel').val();
		var save_user = $('#save_user').val();
        $.post('Traitement/insertion.php',
                {
                     nom_user:nom_user  ,
                    prenom_user: prenom_user,
					sexe_user:sexe_user,
					telephone_user: telephone_user,
					email_user:email_user,
					mdp_user: mdp_user,
					mdp_user2:mdp_user2,
					id_droit: id_droit,
					id_hotel:id_hotel,
					save_user: save_user
					
                }, function(data) {
            		
					alert(data);
					
			
		

        },
                'text');

        return false;
		
		
    });
//	Fin insertion utilisateur
	
//	Modification utilisateur
$('#edit_user').click(function(event) {
		
	    event.preventDefault();
		var id_user = $('#id_user').val();
		var nom_user = $('#nom_user').val();
		var prenom_user = $('#prenom_user').val();
		 var sexe_user = $('#sexe_user').val();
		var telephone_user = $('#telephone_user').val();
		var email_user = $('#email_user').val();
		var mdp_user = $('#mdp_user').val();
		var mdp_user2 = $('#mdp_user2').val();
		var id_droit = $('#id_droit').val();
		var id_hotel = $('#id_hotel').val();
		var edit_user = $('#edit_user').val();
		var modification ='OK';
  		 $.post('Traitement/insertion.php',
                {   id_user:id_user  ,
                    nom_user:nom_user  ,
                    prenom_user: prenom_user,
					sexe_user:sexe_user,
					telephone_user: telephone_user,
					email_user:email_user,
					mdp_user: mdp_user,
					mdp_user2:mdp_user2,
					id_droit: id_droit,
					id_hotel:id_hotel,
					modification: modification
					
                }, function(data) {
					
					alert(data);
					
			
		

        },
                'text');
        return false;
		
		
    });
//	Fin Modification utilisateur


});
	