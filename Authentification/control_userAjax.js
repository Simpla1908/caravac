// JavaScript Document .addpanier

$(document).ready(function () {
    $('#formulaire').click(function (event) {
        event.preventDefault();
        var bool = false;
        var donnees = $('.f').serialize();
        var url = $('.f').attr('action');
        var method = $('.f').attr('method');
        $.ajax({
            url: url,
            async: true,
            type: method,
            data: donnees,
            beforeSend: function () {
                $('#loader1').removeClass('hidden');
                $("#formulaire").addClass('hidden');

            },
            success: function (data) {
            // alert(data);
           if (data.message == 'superadmin') {
                location.href = 'REC/tableaudebordRec.php';
            } 
            else if (data.message == 'user'){
              location.href =data.moduledflt;
            }
            else if (data.message == 'idmpdincorect') {
                $('#text_msg').text("Nom d'utilisateur ou Mot de passe incorrect!");
                $('#alerte').show();

            } else if (data.message == 'userconnect') {
                $('#text_msg').text("Vous etes déjà connecté!");
                $('#alerte').show();

            }else if (data.message == 'companyinactif') {
                $('#text_msg').text("votre compagnie est désactivée");
                $('#alerte').show();

            } else if (data.message == 'siteinactif') {
                $('#text_msg').text("votre site est désactivé");
                $('#alerte').show();

            }else if (data.message == 'userinactif') {
                $('#text_msg').text("votre compte est désactivé");
                $('#alerte').show();

            }else if (data.message == 'aucunsite') {
                $('#text_msg').text("Aucune souscription n'est active");
                $('#alerte').show();

            }else{
                $('#text_msg').text("Mauvais code");
                $('#alerte').show().fadeOut(5000);
            }
                bool = true;
            },
            complete: function () {
                if (bool) {
                     $("#loader1").addClass('hidden');
                     $("#formulaire").removeClass('hidden');
                } else {
                    $('#loader1').addClass('loader').show();
                }
            }
          , dataType: 'json'
        });

        return false;
    });
    $('#sauvegarder').click(function (event) {
        event.preventDefault();
        var sauvegarder = $('#sauvegarder').val();
        var id_client = $('#id_client').val();
        var id_ch = $('#id_ch').val();
        var date_occ = $('#date_occ').val();
        var heure_occ = $('#heure_occ').val();
        $.post('ajax_occupation.php',
                {
                    sauvegarder: sauvegarder,
                    id_client: id_client,
                    id_ch: id_ch,
                    date_occ: date_occ,
                    heure_occ: heure_occ

                }, function (data) {

            $('#reserve').empty().text(data);
            location.href = 'rec_chambres_reserve.php';
        },
                'text');
        return false;

    });


    $('#valider1').click(function (event) {
        $('#client').val($('#val').val());
        $('#id_client').prepend('<option selected="selected">' + $('#val').val() + '</option>');
        //$('#infos_ch').removeClass('modal').addClass('hide');
        $('#infos_ch').css('display', 'none');

    });

    $('#valider_client').click(function (event) {
        $('#client').val($('#val_client').val());
        $('#id_client').prepend('<option selected="selected">' + $('#val_client').val() + '</option>');
        //$('#infos_ch').removeClass('modal').addClass('hide');
        $('#rech_client').css('display', 'none');

    });

});