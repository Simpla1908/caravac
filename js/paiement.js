// JavaScript Document
$(document).ready(function() {
    function effacer() {

        $(':input', '#form').not(':button,:submit,:reset,:hidden,\n\
                               #optionsRadiosInline,#monnaie,#datebonentre,#optbanque')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');
    }

    $("#tb_contenu").on('click', '.btn_modal_payer', function(e) {
        e.preventDefault();
        $("#lib_mode").val($('#mode option:selected').text());
        $('#etat_fact').val($(this).attr("etat_fact"));
        $('#taux_fact').val($(this).attr("taux_fact"));
        $('#montant_fact').val($(this).attr("montant_fact"));
        $('#montant_paye').val($(this).attr("montant_paye"));
        $('.montant_fact').text($(this).attr("montant_fact_af"));
        $('#id_fact').val($(this).attr("id_fact"));
        $('#id_res').val($(this).attr("id_res"));
        $('#s').val($(this).attr("service"));
        $("#rendu").text('0.00');
    });
    $('#btnpayer').click(function(e) {
        e.preventDefault();
        var bool = false;
        var type_client, etat_fact;
        $('#etat_fact9').val($('#etat_fact1').val());
        $('#montant').val($('#montant_fact1').val());
        $('#montant_fact').val($('#montant_fact1').val());
        $('#montant_tot').val($('#montant_tot1').val());
        $('#id_res').val($('#id_res1').val());
        $('#id_fact').val($('#id_fact1').val());
        $('#id_fact').val($('#id_fact1').val());
        $('#idres_ch').val($('#idres_ch1').val());
        $('#type_client').val($('#type_client1').val());
        $('#monnaie_fact').val($('#monnaie_fact1').val());
        $('#dte').val($('#dte1').val());
        type_client = $('#type_client').val();
        etat_fact = $('#etat_fact9').val();
        if (etat_fact == 'liberer' || etat_fact == 'credit') {
            $('#myModal0').modal('hide');
            var donnees = $('.f_modal_paiement').serialize();
            $.ajax({
                url: '../paiement/paiement.php',
                type: 'POST',
                data: donnees,
                beforeSend: function() {
                    $("#loader").removeClass('hidden');
                    $("#save_reservation").addClass('hidden');
                },
                success: function(data) {
                    $('#myModal0').modal('hide');
                    bool = true;
                    location.href = data.url;
                },
                complete: function() {
                    if (bool) {
                        $("#loader").addClass('hidden');
                    } else {
                        $("#loader").removeClass('hidden');
                    }
                },
                dataType: 'json'
            });
        } else {
            $('#myModal0').modal('hide');
            $('#myModal2').modal('show');
        }
    });
    $('#btn_valider_paiement').click(function(e) {
        e.preventDefault();
        var bool = false;
        var id_res = $('#id_res').val();
        var donnees = $('.f_modal_paiement').serialize();
        $.ajax({
            url: '../paiement/paiement.php',
            type: 'POST',
            data: donnees,
            beforeSend: function() {
                $(".loader").removeClass('hidden');
                $(".btn_modal").addClass('hidden');
            },
            success: function(data) {
                if (data.reglement) {
                    $.ajax({
                        url: 'datapaiement.php',
                        type: 'POST',
                        data: donnees,
                        success: function(data) {
                            $('.montant').val('');
                            $('#tb_contenu').empty().append(data);
                            $.ajax({
                                url: 'combo_fact_datas.php?id_res=' + id_res,
                                type: 'POST',
                                success: function(html) {
                                    $("#znefact").empty().append(html);
                                    $("#myModal2").modal('hide');
                                    window.open('impression/recu_regl.php');

                                }
                            });
                        }
                    });

                } else if (data.liberation) {
                    location.href = data.url;
                } else if (data.error) {
                    alert('Veuiller entrer un montant superieur ou égal à celui de la nuité: ' + data.montant_nuite + ' pour le 1er paiement');
                } else if (data.error2) {
                    $('#msg').show().fadeOut(4000);
                    $('#msg_alert').text(data.error2_msg);
                }
                bool = true;
            },
            complete: function() {
                if (bool) {
                    $(".loader").addClass('hidden');
                    $(".btn_modal").removeClass('hidden');
                    // $("#myModal2").modal('hide');
                } else {
                    $(".loader").removeClass('hidden');
                }
            },
            dataType: 'json'
        });


    });
    //Rendu
    $("#div_montant").on('keyup', '#montant', function(e) {
        var montsaisi = $("#montant").val();
        var rendu = 0;
        if (montsaisi != '') {
            montsaisi = parseFloat(montsaisi);
            var montant_total = parseFloat($("#montant_fact").val());
            if (montsaisi >= montant_total) {
                rendu = montsaisi - montant_total;
            } else {
                rendu = '0.00';
            }
        }
        $("#rendu").text(rendu);
    });

    $('#mode').change(function(e) {
        var mode = $('#mode option:selected').text();
        var type_client = $(".tycl").val();
        if (type_client == 'occasionnel' || type_client == 'table') {
            $('option[value="3"]').hide();
        } else {
            $('option[value="3"]').show();
        }
        if (mode == 'Don') {
            $('.montant').val(0);
            $('.cachebtn').addClass('hidden');
        } else if (mode == 'Credit') {
            $('.montant').val(0);
        } else {
            $('.montant').val('');
            $('.cachebtn').removeClass('hidden');
        }
        $("#lib_mode").val(mode);

    });

    function roundDecimal(nombre) {
        var precision = 2;
        var tmp = Math.pow(10, precision);
        return Math.round(nombre * tmp) / tmp;
    }
    //Souscription
    $("#conteneur").on('click', '.btn_regler', function(e) {
        $('#affiche_montfact').text($(this).attr("mont_fact_af"));
        $('#fact_id').val($(this).attr("fact_id"));
        $('#mont_fact').val($(this).attr("mont_fact"));
        $('#modulecomp_id').val($(this).attr("modulecomp_id"));
        $('#lfp_id').val($(this).attr("lfp_id"));
        $('#pack_id').val($(this).attr("pack_id"));
        $('#activer').val($(this).attr("activer"));
        $('#regler').val($(this).attr("regler"));
        $('#id_hotel').val($(this).attr("id_hotel"));
        $('#company_id').val($(this).attr("company_id"));
        $('#statut').val($(this).attr("activer"));
        $('#pack_company_id').val($(this).attr("pack_company_id"));
        $('#type_souscript').val($(this).attr("type_souscript"));
        $('#fact1').val($(this).attr("fact1"));
        $('#id_user').val($(this).attr("id_user"));
        $('#prnom_user').val($(this).attr("prnom_user"));
        $('#nom_user').val($(this).attr("nom_user"));
        $('#mail_company').val($(this).attr("mail_company"));

        $("#myModalreglement").modal('show');
    });
    $("#conteneur").on('click', '#btn_paie_fact', function(e) {
        e.preventDefault();
        var bool = false;
        var donnees = $('.f_modal_paiement').serialize();
        var id = $('#fact_id').val();
        $.ajax({
            url: '../traitement/souscription.php',
            type: 'POST',
            data: donnees,
            beforeSend: function() {
                $(".loader").removeClass('hidden');
                $(".btn_cache").addClass('hidden');
            },
            success: function(data) {
                $.ajax({
                    url: './datareglement.php?id=' + id,
                    type: 'POST',
                    data: donnees,
                    success: function(data) {
                        $('#montant').val('');
                        $('#tb_contenu').empty().append(data);
                        $("#myModalreglement").modal('hide');
                    }
                });
                bool = true;
            },
            complete: function() {
                if (bool) {
                    $(".loader").addClass('hidden');
                    $(".btn_cache").removeClass('hidden');
                } else {
                    $(".loader").removeClass('hidden');
                }
            }
        });

    });

});