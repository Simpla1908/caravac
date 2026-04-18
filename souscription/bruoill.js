/**
 * Created by DEVAPP01 on 27/07/2017.
 */

//script pour le choix du module caisse
$("#txt_caisse").bind('keyup mouseup', function () {
    //alert('focus');
    var selected = $("#slt_caisse option:selected");
    //alert(selected.val());
    var donnees = '';
    var module;
    var souscription;
    var nombre_user;
    //l'identifiant du module doit etre tire de la base de donnee
    module = '21';
    souscription = selected.val();
    nombre_user = $("#txt_caisse").val();
    // lnombre_user=(nombre_user).length;
    // alert(lnombre_user);
    // if (lnombre_user=1 && nombre_user<3 && nombre_user!='') {
    //  $("#txt_caisse").val(3);
    //  nombre_user=3;
    // };
    donnees = 'module=' + module + '&souscription=' + souscription + '&nombre_user=' + nombre_user;
    $.ajax({
        url: 'souscription/prix_utilisateur.php',
        type: 'POST',
        data: donnees,
        success: function (data) {
            //alert(data);
            $("#lbl_caisse").empty().append('$' + data);
            $("#prix_caisse").val(data);
            var montant_caisse = 0;
            var montant_stock = 0;
            var montant_restaurant = 0;
            var montant_hebergement = 0;
            var montant_tot = 0;
            var chaine = '';
            if ($('#cb_caisse').prop('checked')) {
                montant_caisse = parseInt($("#lbl_caisse").text().slice(1))
            }
            if ($('#cb_stock').prop('checked')) {
                montant_stock = parseInt($("#lbl_stock").text().slice(1))
            }
            if ($('#cb_restaurant').prop('checked')) {
                montant_restaurant = parseInt($("#lbl_restaurant").text().slice(1))
            }
            if ($('#cb_hebergement').prop('checked')) {
                montant_hebergement = parseInt($("#lbl_hebergement").text().slice(1))
            }
            montant_tot = montant_caisse + montant_stock + montant_restaurant + montant_hebergement;
            chaine = montant_tot + ""
            $("#tot_souscri").empty().append('$' + chaine);

        }
    });
});

function onSelectChange_caisse() {
    var selected = $("#slt_caisse option:selected");
    //alert(selected.val());
    var donnees = '';
    var module;
    var souscription;
    var nombre_user;
    //l'identifiant du module doit etre tire de la base de donnee
    module = '21';
    souscription = selected.val();
    nombre_user = $("#txt_caisse").val();
    donnees = 'module=' + module + '&souscription=' + souscription + '&nombre_user=' + nombre_user;
    $.ajax({
        url: 'souscription/prix_utilisateur.php',
        type: 'POST',
        data: donnees,
        success: function (data) {
            $("#lbl_caisse").empty().append('$' + data);
            $("#prix_caisse").val(data);
            var montant_caisse = 0;
            var montant_stock = 0;
            var montant_restaurant = 0;
            var montant_hebergement = 0;
            var montant_tot = 0;
            var chaine = '';
            if ($('#cb_caisse').prop('checked')) {
                montant_caisse = parseInt($("#lbl_caisse").text().slice(1))
            }
            if ($('#cb_stock').prop('checked')) {
                montant_stock = parseInt($("#lbl_stock").text().slice(1))
            }
            if ($('#cb_restaurant').prop('checked')) {
                montant_restaurant = parseInt($("#lbl_restaurant").text().slice(1))
            }
            if ($('#cb_hebergement').prop('checked')) {
                montant_hebergement = parseInt($("#lbl_hebergement").text().slice(1))
            }
            montant_tot = montant_caisse + montant_stock + montant_restaurant + montant_hebergement;
            chaine = montant_tot + ""
            $("#tot_souscri").empty().append('$' + chaine);


        }
    });
}

$("#slt_caisse").change(onSelectChange_caisse);
//script pour le choix du module restaurant
$("#txt_restaurant").bind('keyup mouseup', function () {

    var selected = $("#slt_restaurant option:selected");
    //alert(selected.val());
    var donnees = '';
    var module;
    var souscription;
    var nombre_user;
    //l'identifiant du module doit etre tire de la base de donnee
    module = '22';
    souscription = selected.val();
    nombre_user = $("#txt_restaurant").val();
    // if (nombre_user<3 && nombre_user!='') {
    //  $("#txt_restaurant").val(3);
    //  nombre_user=3;
    // };
    donnees = 'module=' + module + '&souscription=' + souscription + '&nombre_user=' + nombre_user;
    $.ajax({
        url: 'souscription/prix_utilisateur.php',
        type: 'POST',
        data: donnees,
        success: function (data) {
            $("#lbl_restaurant").empty().append('$' + data);
            $("#prix_restaurant").val(data);
            var montant_caisse = 0;
            var montant_stock = 0;
            var montant_restaurant = 0;
            var montant_hebergement = 0;
            var montant_tot = 0;
            var chaine = '';
            if ($('#cb_caisse').prop('checked')) {
                montant_caisse = parseInt($("#lbl_caisse").text().slice(1))
            }
            if ($('#cb_stock').prop('checked')) {
                montant_stock = parseInt($("#lbl_stock").text().slice(1))
            }
            if ($('#cb_restaurant').prop('checked')) {
                montant_restaurant = parseInt($("#lbl_restaurant").text().slice(1))
            }
            if ($('#cb_hebergement').prop('checked')) {
                montant_hebergement = parseInt($("#lbl_hebergement").text().slice(1))
            }
            montant_tot = montant_caisse + montant_stock + montant_restaurant + montant_hebergement;
            chaine = montant_tot + ""
            $("#tot_souscri").empty().append('$' + chaine);

        }
    });
});

function onSelectChange_restaurant() {

    var selected = $("#slt_restaurant option:selected");
    //alert(selected.val());
    var donnees = '';
    var module;
    var souscription;
    var nombre_user;
    //l'identifiant du module doit etre tire de la base de donnee
    module = '22';
    souscription = selected.val();
    nombre_user = $("#txt_restaurant").val();
    donnees = 'module=' + module + '&souscription=' + souscription + '&nombre_user=' + nombre_user;
    $.ajax({
        url: 'souscription/prix_utilisateur.php',
        type: 'POST',
        data: donnees,
        success: function (data) {
            $("#lbl_restaurant").empty().append('$' + data);
            $("#prix_restaurant").val(data);
            var montant_caisse = 0;
            var montant_stock = 0;
            var montant_restaurant = 0;
            var montant_hebergement = 0;
            var montant_tot = 0;
            var chaine = '';
            if ($('#cb_caisse').prop('checked')) {
                montant_caisse = parseInt($("#lbl_caisse").text().slice(1))
            }
            if ($('#cb_stock').prop('checked')) {
                montant_stock = parseInt($("#lbl_stock").text().slice(1))
            }
            if ($('#cb_restaurant').prop('checked')) {
                montant_restaurant = parseInt($("#lbl_restaurant").text().slice(1))
            }
            if ($('#cb_hebergement').prop('checked')) {
                montant_hebergement = parseInt($("#lbl_hebergement").text().slice(1))
            }
            montant_tot = montant_caisse + montant_stock + montant_restaurant + montant_hebergement;
            chaine = montant_tot + ""
            $("#tot_souscri").empty().append('$' + chaine);


        }
    });
}

$("#slt_restaurant").change(onSelectChange_restaurant);
//script pour le choix du module stock
$("#txt_stock").bind('keyup mouseup', function () {

    var selected = $("#slt_stock option:selected");
    //alert(selected.val());
    var donnees = '';
    var module;
    var souscription;
    var nombre_user;
    //l'identifiant du module doit etre tire de la base de donnee
    module = '24';
    souscription = selected.val();
    nombre_user = $("#txt_stock").val();
    // if (nombre_user<3 && nombre_user!='') {
    //  $("#txt_stock").val(3);
    //  nombre_user=3;
    // };
    donnees = 'module=' + module + '&souscription=' + souscription + '&nombre_user=' + nombre_user;
    $.ajax({
        url: 'souscription/prix_utilisateur.php',
        type: 'POST',
        data: donnees,
        success: function (data) {
            $("#lbl_stock").empty().append('$' + data);
            $("#prix_stock").val(data);
            var montant_caisse = 0;
            var montant_stock = 0;
            var montant_restaurant = 0;
            var montant_hebergement = 0;
            var montant_tot = 0;
            var chaine = '';
            if ($('#cb_caisse').prop('checked')) {
                montant_caisse = parseInt($("#lbl_caisse").text().slice(1))
            }
            if ($('#cb_stock').prop('checked')) {
                montant_stock = parseInt($("#lbl_stock").text().slice(1))
            }
            if ($('#cb_restaurant').prop('checked')) {
                montant_restaurant = parseInt($("#lbl_restaurant").text().slice(1))
            }
            if ($('#cb_hebergement').prop('checked')) {
                montant_hebergement = parseInt($("#lbl_hebergement").text().slice(1))
            }
            montant_tot = montant_caisse + montant_stock + montant_restaurant + montant_hebergement;
            chaine = montant_tot + ""
            $("#tot_souscri").empty().append('$' + chaine);


        }
    });
});

function onSelectChange_stock() {

    var selected = $("#slt_stock option:selected");
    //alert(selected.val());
    var donnees = '';
    var module;
    var souscription;
    var nombre_user;
    //l'identifiant du module doit etre tire de la base de donnee
    module = '24';
    souscription = selected.val();
    nombre_user = $("#txt_stock").val();
    donnees = 'module=' + module + '&souscription=' + souscription + '&nombre_user=' + nombre_user;
    $.ajax({
        url: 'souscription/prix_utilisateur.php',
        type: 'POST',
        data: donnees,
        success: function (data) {
            $("#lbl_stock").empty().append('$' + data);
            $("#prix_stock").val(data);
            var montant_caisse = 0;
            var montant_stock = 0;
            var montant_restaurant = 0;
            var montant_hebergement = 0;
            var montant_tot = 0;
            var chaine = '';
            if ($('#cb_caisse').prop('checked')) {
                montant_caisse = parseInt($("#lbl_caisse").text().slice(1))
            }
            if ($('#cb_stock').prop('checked')) {
                montant_stock = parseInt($("#lbl_stock").text().slice(1))
            }
            if ($('#cb_restaurant').prop('checked')) {
                montant_restaurant = parseInt($("#lbl_restaurant").text().slice(1))
            }
            if ($('#cb_hebergement').prop('checked')) {
                montant_hebergement = parseInt($("#lbl_hebergement").text().slice(1))
            }
            montant_tot = montant_caisse + montant_stock + montant_restaurant + montant_hebergement;
            chaine = montant_tot + ""
            $("#tot_souscri").empty().append('$' + chaine);


        }
    });
}

$("#slt_stock").change(onSelectChange_stock);
//script pour le choix du module hebergement
$("#txt_hebergement").bind('keyup mouseup', function () {

    var selected = $("#slt_hebergement option:selected");
    //alert(selected.val());
    var donnees = '';
    var module;
    var souscription;
    var nombre_user;
    //l'identifiant du module doit etre tire de la base de donnee
    module = '23';
    souscription = selected.val();
    nombre_user = $("#txt_hebergement").val();
    // if (nombre_user<3 && nombre_user!='') {
    //  $("#txt_stock").val(3);
    //  nombre_user=3;
    // };
    donnees = 'module=' + module + '&souscription=' + souscription + '&nombre_user=' + nombre_user;
    $.ajax({
        url: 'souscription/prix_utilisateur.php',
        type: 'POST',
        data: donnees,
        success: function (data) {
            $("#lbl_hebergement").empty().append('$' + data);
            $("#prix_hebergement").val(data);
            var montant_caisse = 0;
            var montant_stock = 0;
            var montant_restaurant = 0;
            var montant_hebergement = 0;
            var montant_tot = 0;
            var chaine = '';
            if ($('#cb_caisse').prop('checked')) {
                montant_caisse = parseInt($("#lbl_caisse").text().slice(1))
            }
            if ($('#cb_stock').prop('checked')) {
                montant_stock = parseInt($("#lbl_stock").text().slice(1))
            }
            if ($('#cb_restaurant').prop('checked')) {
                montant_restaurant = parseInt($("#lbl_restaurant").text().slice(1))
            }
            if ($('#cb_hebergement').prop('checked')) {
                montant_hebergement = parseInt($("#lbl_hebergement").text().slice(1))
            }
            montant_tot = montant_caisse + montant_stock + montant_restaurant + montant_hebergement;
            chaine = montant_tot + ""
            $("#tot_souscri").empty().append('$' + chaine);


        }
    });
});

function onSelectChange_hebergement() {

    var selected = $("#slt_hebergement option:selected");
    //alert(selected.val());
    var donnees = '';
    var module;
    var souscription;
    var nombre_user;
    //l'identifiant du module doit etre tire de la base de donnee
    module = '23';
    souscription = selected.val();
    nombre_user = $("#txt_hebergement").val();
    donnees = 'module=' + module + '&souscription=' + souscription + '&nombre_user=' + nombre_user;
    $.ajax({
        url: 'souscription/prix_utilisateur.php',
        type: 'POST',
        data: donnees,
        success: function (data) {
            $("#lbl_hebergement").empty().append('$' + data);
            $("#prix_hebergement").val(data);
            var montant_caisse = 0;
            var montant_stock = 0;
            var montant_restaurant = 0;
            var montant_hebergement = 0;
            var montant_tot = 0;
            var chaine = '';
            if ($('#cb_caisse').prop('checked')) {
                montant_caisse = parseInt($("#lbl_caisse").text().slice(1))
            }
            if ($('#cb_stock').prop('checked')) {
                montant_stock = parseInt($("#lbl_stock").text().slice(1))
            }
            if ($('#cb_restaurant').prop('checked')) {
                montant_restaurant = parseInt($("#lbl_restaurant").text().slice(1))
            }
            if ($('#cb_hebergement').prop('checked')) {
                montant_hebergement = parseInt($("#lbl_hebergement").text().slice(1))
            }
            montant_tot = montant_caisse + montant_stock + montant_restaurant + montant_hebergement;
            chaine = montant_tot + ""
            $("#tot_souscri").empty().append('$' + chaine);


        }
    });
}

$("#slt_hebergement").change(onSelectChange_hebergement);
$("#contact-form").on('click', '.elmt_checked', function () {

    var module = $(this).attr('value');
    // alert(module);
    if (module == 21 && $('#cb_caisse').prop('checked')) {
        var selected = $("#slt_caisse option:selected");
        var souscription;
        var nombre_user;
        souscription = selected.val();
        nombre_user = $("#txt_caisse").val();
    } else if (module == 22) {
        var selected = $("#slt_restaurant option:selected");
        var souscription;
        var nombre_user;
        souscription = selected.val();
        nombre_user = $("#txt_restaurant").val();
    } else if (module == 23) {
        var selected = $("#slt_hebergement option:selected");
        var souscription;
        var nombre_user;
        souscription = selected.val();
        nombre_user = $("#txt_hebergement").val();
    } else if (module == 24) {
        var selected = $("#slt_stock option:selected");
        var souscription;
        var nombre_user;
        souscription = selected.val();
        nombre_user = $("#txt_stock").val();
    }

});
$('#enregistrer_souscription').click(function (e) {
    e.preventDefault();
    $(".input_txt").css("border-color", "");
    var donnees = $('#contact-form').serialize();
    if ($("#txt_caisse").val() < 3 && $('#cb_caisse').prop('checked') || $("#txt_prestaurant").val() < 3 && $('#cb_prestaurant').prop('checked') || $("#txt_stock").val() < 3 && $('#cb_stock').prop('checked') || $("#txt_hebergement").val() < 3 && $('#cb_hebergement').prop('checked')|| $("#txt_photel").val() < 3 && $('#cb_photel').prop('checked')) {
        $('#msg').empty().append('Veuillez saisir les valeurs exactes!').show();
        if ($("#txt_caisse").val() < 3) $("#txt_caisse").css("border-color", "red");
        if ($("#txt_prestaurant").val() < 3) $("#txt_prestaurant").css("border-color", "red");
        if ($("#txt_stock").val() < 3) $("#txt_stock").css("border-color", "red");
        if ($("#txt_hebergement").val() < 3) $("#txt_hebergement").css("border-color", "red");
        if ($("#txt_photel").val() < 3) $("#txt_photel").css("border-color", "red");
    } else {
        $.ajax({
            url: 'souscription/souscription_traitement.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data.message_vide == 'videmodule') {
                    $('#msg1').empty().append('Veuillez choisir au moins un module!').show().fadeOut(4000);
                } else if (data.message_vide == 'vide') {
                    $('#msg1').empty().append('Veuillez remplir les champs vides!').show().fadeOut(4000);

                } else if (data.message_succes == 'succes') {
                    // effacer();
                    //$('#msg').append('enregistrement effectué avec succes!').show().fadeOut(4000);
                    donnees = '';
                    $.ajax({
                        url: 'souscription/table_resume.php',
                        type: 'POST',
                        data: donnees,
                        success: function (data) {
                            // alert(data);
                            $('#resume_tbl').empty().append(data);
                            $('#resume_souscri').show();
                            $('#form_souscri').hide();
                            $('.section_page').hide();
                            $('#annuler_souscription').show();
                            $('#valider_souscription').show();
                            //$('#resume_souscri').scrollTop(0);
                            $(window).scrollTop(0);

                        }
                    });


                }

            },
            dataType: 'json'
        });


    }
    ;

});
$('#annuler_souscription').click(function (e) {
    $('#resume_souscri').hide();
    $('#form_souscri').show();
    $('.section_page').show();
    $(window).scrollTop(3000);

});
$('#valider_souscription').click(function (e) {
    e.preventDefault();
    var donnees = '';
    var mode_paie = $('input[name="mode_paie"]:checked').val();

    $.ajax({
        url: 'souscription/valider_souscription.php?mode_paie=' + mode_paie,
        type: 'POST',
        data: donnees,
        success: function (data) {
            //alert(data);
            $('.mail_activ').show();
            $('#annuler_souscription').hide();
            $('#valider_souscription').hide();
            $('#resume_souscri').hide();
        }
    });


});