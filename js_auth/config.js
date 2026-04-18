// JavaScript Document 

$(document).ready(function() {

    $('#formulaire').submit(function(e) {
        e.preventDefault(); // Le navigateur ne peut pas envoyer le formulaire
        var donnees = $(this).serialize(); // On créer une variable content le formulaire sérialisé
        $.post('verif.php',
                {donnees: donnees

                }, function(data) {

            if (data == 'Success') {
// Le membre est connecté. Ajoutons lui un message dans la page HTML.
                $("#resultat").html("<p>Vous avez été connecté avec succès ! < /p>");
            }
            else {
// Le membre n'a pas été connecté. (data vaut ici "failed")
                $("#message").html("<p>Erreur lors de laconnexion... < /p>");
            }
        }, 'json');


    });



});