// JavaScript Document

// JavaScript Document .addpanier

$(document).ready(function () {
//		<!--alert('bbbb');-->
    function effacer() {

        $(':input', '#form').not(':button,:submit,:reset,:hidden,\n\
                               #optionsRadiosInline,#monnaie,#datebonentre,#optbanque')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');
    }

    $('#suivant1').click(function (event) {
        event.preventDefault();
        var hebergement = $('#hebergement').val();
        var sexe_client = $('#sexe_client').val();
        var etat_civil_client = $('#etat_civil_client').val();
        var donnees = $('#form_reservation').serialize() + "&sexe=" + sexe_client + "&etat=" + etat_civil_client + "&hebergement=" + hebergement;
      //  alert(donnees);
        $.ajax({
            url: 'Traitement_reservation/envoi_data_reservation.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data.message_succes == 'succes') {
                    location.href = 'rec_reservation_client_chambre_paiement.php?hebergement=' + hebergement;
                    $('#prec_paie').hide()
                } else if (data.message_dte_sorti == 'sorti') {
                    $('#msg').show()
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text("La date de sortie doit etre superieure à la date  d'arrivée.")
                }  else if (data.message_dte_sorti == 'sorti2') {
                    $('#msg').show()
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text("La date d'occupation doit etre inférieure ou égale à la date  du jour.")
                }else if (data.message_dte_arrive == 'arrive') {
                    $('#msg').show()
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text("La date d'arrivée ou de sortie doit etre superieure à la date de reservation.")
                } else if (data.message_vide == 'vide') {
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez remplir les champs vides!')

                }

            }, dataType: 'json'
        });

        return false;

    });
//<!--Passage chambre à paiemment -->
    $('#suivant2').click(function (event) {
        event.preventDefault();
        var hebergement = $('#hebergement').val();
        var remise = $('#rem').val();
        $('#prec_paie').hide();

        location.href = 'rec_reservation_paiement.php?hebergement=' + hebergement +'&remise='+ remise +'#paie_res';

    });
//<!--Paiement-->

//<!--Liberation-->
    $('#valider_liberation').click(function (event) {
        event.preventDefault();
        var date_lib = $('#datetimepicker6').val();
        var id_client = $('#id_client').val();
        var num_res = $('#num_res').val();
        var id_ch = $('#id_ch').val();
        var fact = $('#fact').val();
        var mont_remboursable = $('#mont_remboursable').val();
        var montantUSD = $('#montUSD').val();
        var montantFC = $('#montFC').val();
        var m_aff = $('#m_aff').val();
        //var num_res =$('#num_res').val();
        $.ajax({
            url: 'Traitement_propre/liberation_traitement.php',
            type: 'POST',
            data: "date_lib=" + date_lib + "&id_client=" + id_client + "&fact=" + fact +"&num_res=" + num_res + "&id_ch=" + id_ch + "&mont_remboursable=" + mont_remboursable + "&montantUSD=" + montantUSD + "&montantFC=" + montantFC+ "&m_aff=" + m_aff,
            success: function (data) {
                if (data.message == 'succes') {
                    $('#datetimepicker6').val(' ');
                    $('#client').val(' ');
                    $('#chambre').val(' ');
                    $('#montUSD').val(' ');
                    $('#montFC').val(' ');
                    $('#mont_remboursable').attr('disabled', false);
                    $('#mont_remboursable').val(' ');
                    $('#mont_remboursable').attr('disabled', true);
                    $('#valider_liberation').attr('disabled', true);
                    alert("la libération s'est effectuée avec succès!");
                } else if (data.message == 'montantIncorrect1') {
                    alert("Les montants saisis doivent etre inferieurs aux soldes de la caisse " + data.caisse_montantUSD_solde + "$" + " et " + data.caisse_montantFC_solde + "FC");
                } else if (data.message == 'montantIncorrect') {
                    alert("Les montants saisis doivent etre egal au montant à rembourser!");
                }
            }, dataType: 'json'
        });
    });


//<!--Liberation-->

//<!--Occupation indirecte -->
    $('#valider_occup').click(function (event) {

        event.preventDefault();

        var num_reserv = $('#num_reserv').val();
        var id_res = $('#id_res').val();
        var id_chambre = $('#id_chambre').val();
        var id_client = $('#id_client').val();

        var donnees = "num_reserv=" + num_reserv + "&id_chambre=" + id_chambre + "&id_client=" + id_client + "&id_res=" + id_res;
        $.ajax({
            url: 'Traitement_reservation/occupation.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data.message_succes == 'succes') {
                    effacer();
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('#msg_alert').text("Attribution chambre  effectuée avec succès!")
                } else if (data.message_erreur == 'erreur') {
                    $('#msg').show()
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text("La chambre " + data.numch_value + " n'a plus d'espace(capacite:0)")
                } else if (data.message_vide == 'vide') {
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez remplir les champs vides!')

                }

            }, dataType: 'json'
        });
        var donnees = '';
        $.ajax({
            url: 'Traitement_reservation/table_affectation.php?id_res=' + id_res,
            type: 'POST',
            data: donnees,
            success: function (data) {
//                alert(data);
                $('#div_affectation').empty().append(data);

            }
        });
        var donnees = '';
        $.ajax({
            url: 'Traitement_reservation/maj_form_occup.php?id_res=' + id_res,
            type: 'POST',
            data: donnees,
            success: function (data) {
//            alert(data);
                $('#data_occupa').empty().append(data);

            }
        });
        return false;

    });

 $('#save_reservation').click(function (e){
        e.preventDefault();
        var bool=false;
        var donnees=$('#form').serialize();
        $.ajax({
            url: 'Traitement_reservation/enreg_paiement.php',
            type: 'POST',
            data: donnees,
            beforeSend: function () {
                $("#loader").removeClass('hidden');
                $("#save_reservation").addClass('hidden');
            },
            success: function (data) {
                if (data.succes) {
                       $('#msg').show().fadeOut(5000)
                               .addClass('alert-success')
                               .removeClass('alert-danger');
                       $('#msg_alert').text(data.message)
                       $('#save_reservation').hide();
                       $('#prec_paie').show();
                       $('#precedent').hide();
                       $('#go_heb').show();
                       window.open('impression/facture.php?id_res=' + data.id_res);
                        location.href =' rec_reservation_multiple.php?hebergement='+data.hebergement;
                      
                   } else {
                     $("#save_reservation").removeClass('hidden');
                     
                       $('#msg').show()
                               .addClass('alert-danger')
                               .removeClass('alert-success');
                       $('#msg_alert').text(data.message)
                   }
                bool=true;
            },complete: function () {
                if (bool) {
                    $("#loader").addClass('hidden');
                } else {
                    $("#loader").removeClass('hidden');
                }
            }, dataType: 'json'
        });

    });
//	<!-- Completer Paiement-->
    $('#completer_paiement').click(function (event) {

        event.preventDefault();

        var monnaie = $('#monnaie').val();
        var mode = $('#mode').val();
        var montant = $('#montant').val();
        var montantUSD = $('#montantUSD').val();
        var montantFC = $('#montantFC').val();
        var justif = $('#justif').val();
        var reste = $('#reste').val();
        var num_fact = $('#num_fact').val();
        var id_fact = $('#id_fact').val();
        var id_ch = $('#id_ch').val();
        var id_client = $('#id_client').val();
        var id_res = $('#id_res').val();
        var reservation = 'multuple';

        $.post('Traitement_reservation/completer_paiement.php',
            {
                monnaie: monnaie,
                mode: mode,
                montant: montant,
                montantUSD: montantUSD,
                montantFC: montantFC,
                justif: justif,
                reste: reste,
                num_fact: num_fact,
                id_fact: id_fact,
                id_ch: id_ch,
                id_client: id_client,
                id_res: id_res,
                reservation: reservation
            }, function (data) {

                if (data == 1) {
                    $('#msg').show().fadeOut(6000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text("Veuillez saisir les valeurs correctes dans tous les champs!");


                } else if (data == 2) {
                    $('#msg').show().fadeOut(6000)
                        .addClass('alert-warning')
                        .removeClass('alert-success');
                    $('#msg_alert').text("La totalité des montants saisis doit etre égale au reste à payer!");
                } else {
                    $('#msg').show().fadeOut(6000)
                        .addClass('alert-success')
                        .removeClass('alert-warning');
                    $('#msg_alert').text("Le paiement est effectué avec succès");
                    $('#completer_paiement').hide();
                    $('#imprimer_fact').show();
                }


            },
            'text');

        return false;


    });
    $('#completer_paiement_1').click(function (event) {

        event.preventDefault();

        var monnaie = $('#monnaie').val();
        var mode = $('#mode').val();
        var montant = $('#montant').val();
        var montantUSD = $('#montantUSD').val();
        var montantFC = $('#montantFC').val();
        var justif = $('#justif').val();
        var reste = $('#reste').val();
        var num_fact = $('#num_fact').val();
        var id_fact = $('#id_fact').val();
//                var id_ch = $('#id_ch').val();
        var id_client = $('#id_client').val();
        var id_res = $('#id_res').val();
        var reservation = 'multuple';

        $.post('Traitement_reservation/completer_paiement_1.php',
            {
                monnaie: monnaie,
                mode: mode,
                montant: montant,
                montantUSD: montantUSD,
                montantFC: montantFC,
                justif: justif,
                reste: reste,
                num_fact: num_fact,
                id_fact: id_fact,
                id_client: id_client,
                id_res: id_res,
                reservation: reservation
            }, function (data) {

                if (data == 1) {
                    $('#msg').show().fadeOut(6000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text("Veuillez saisir les valeurs correctes dans tous les champs!");

                } else if (data == 2) {
                    $('#msg').show().fadeOut(6000)
                        .addClass('alert-warning')
                        .removeClass('alert-success');
                    $('#msg_alert').text("Les montants saisis  debordent le reste!");
                } else {
                    $('#msg').show().fadeOut(6000)
                        .addClass('alert-success')
                        .removeClass('alert-warning');
                    $('#msg_alert').text("Le paiement est effectué avec succès");
                    $('#completer_paiement_1').hide();
                    $('#imprimer_fact').show();
                }


            },
            'text');

        return false;


    });
//Insertion client


    $('#btn_save_client').click(function (event) {

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
                nom_client: nom_client,
                date_naiss_client: date_naiss_client,
                sexe_client: sexe_client,
                etat_civil_client: etat_civil_client,
                nationalite_client: nationalite_client,
                provenance_client: provenance_client,
                num_piece_identite_client: num_piece_identite_client,
                num_passeport_client: num_passeport_client,
                email_client: email_client,
                telephone_client: telephone_client,
                num_pers_contacter_client: num_pers_contacter_client,
                adresse_provenance_client: adresse_provenance_client,
                id_respo: id_respo,
                btn_save_client: btn_save_client

            }, function (data) {
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


    /*Insertion client en charge*/

    $('#btn_save_client_encharge').click(function (event) {

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
        var id_client = $('#id_client').val();
        id_reservation
        var id_reservation = $('#id_reservation').val();
        var btn_save_client_encharge = $('#btn_save_client_encharge').val();

        $.post('Traitement_reservation/client_en_chargede.php',
            {
                nom_client: nom_client,
                date_naiss_client: date_naiss_client,
                sexe_client: sexe_client,
                etat_civil_client: etat_civil_client,
                nationalite_client: nationalite_client,
                provenance_client: provenance_client,
                num_piece_identite_client: num_piece_identite_client,
                num_passeport_client: num_passeport_client,
                email_client: email_client,
                telephone_client: telephone_client,
                num_pers_contacter_client: num_pers_contacter_client,
                adresse_provenance_client: adresse_provenance_client,
                id_client: id_client,
                id_reservation: id_reservation,
                btn_save_client_encharge: btn_save_client_encharge

            }, function (data) {
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
//            $('#id_respo').val(' ');
//            $('#id_reservation').val(' ');
                alert(data);

                //$('#id_client').append('<option>'+' new client'+'</option>');


            },
            'text');

        return false;


    });

    /* Fin Insertion client en charge*/
//Suite de paiement

//<!--Ajout de paiement-->
    $('#completer_paiemen').click(function (event) {

        event.preventDefault();

        var monnaie = $('#monnaie').val();
        var mode = $('#mode').val();
        var montant = $('#montant').val();
        var montantUSD = $('#montantUSD').val();
        var montantFC = $('#montantFC').val();
        var remise = $('#remise').val();
        var majoration = $('#majoration').val();
        var justif = $('#justif').val();
        var reste = $('#reste').val();
        var id_fact = $('#id_fact').val();
        var montant_tot = $('#montant_tot').val();
        var reservation = 'reglement_suite';

        $.post('Traitement_reservation/completer_paiement.php',
            {
                monnaie: monnaie,
                mode: mode,
                montant: montant,
                montantUSD: montantUSD,
                montantFC: montantFC,
                remise: remise,
                justif: justif,
                majoration: majoration,
                reste: reste,
                id_fact: id_fact,
                montant_tot: montant_tot,
                reservation: reservation
            }, function (data) {

                alert(data);
                $('#imprimer_fact').show();


            },
            'text');

        return false;


    });

//	<!--Suppression client-->

    $('#btn_maj a:last-child').click(function (event) {

        var id_client = ('#btn_maj a:last-child').attr('class');
        event.preventDefault();

        $.post('rec_del_client.php',
            {
                id_client: id_client
            }, function (data) {

                alert(data);


            },
            'text');

        return false;

    });


    $('#imprimer_fact1').click(function (e) {
        e.preventDefault();
        location.href = 'rec_reservation_multiple.php?hebergement=1';
        window.open('../html2pdf/examples/recu.php');
    });

});