// JavaScript Document
$(document).ready(function () {
    $('#save_reclamation').click(function (event) {

        event.preventDefault();
        alert('bbbbb')
});
    // Clique sur une ligne tableau SORTIE listecommande retour
     $("#tab_com").on('click', '#commandes tr', function (e) {
        var numcom = $(this).find('td').eq(1).html();
        $('#tab_com').load('./Traitement/apercu_commande.php?numcom=' + numcom);
    });
    $('#retour').click(function (e) {
          
        $('#tab_com').load('./Traitement/listecommande.php');

    });
   
     $("#fermer").click(function (e) {
        $("#c1").show();
        $("#c2").hide();

    });
    $("#btn_table").click(function () {
        $("#affichage_tout_produit").hide();
        $('#tab_1').empty().load('liste_tbl_maj.php');
        $("#tab_1").show();
        $("#tab_2").hide();
    });
    
    $('#tab_1').on('click','#fermer_tab',function () {
        $("#affichage_tout_produit").show();
        $("#tab_1").hide();
    } );
    

    $("#btn_client").click(function () {
        $("#affichage_tout_produit").hide();
        $('#tab_2').empty().load('liste_cl_maj.php');
        $("#tab_2").show();
        $("#tab_1").hide();
    });
        $('#tab_2').on('click','#fermer_tab2',function () {
        $("#affichage_tout_produit").show();
        $("#tab_2").hide();
    } );


    $(".home").click(function () {
        $(".fam").show();
        $(".s_fam").hide();
        $(".prod").show();
    });
    $(".fam").click(function () {
        id = $(this).attr("id");
//alert(id);
        cl = "." + id;
        $(cl).show();
        $(".fam").hide();
    });
    $(".s_fam").click(function () {
        id = $(this).attr("id");
//alert(id);
        $(".prod").hide();
        cl = "." + id;
        $(cl).show();
    });


    $(".confirmModalLink").click(function (e) {
        $("#c1").hide();
        $("#c2").show();
        $("#c3").hide();


    });
    $("#fermer").click(function (e) {
        $("#c1").show();
        $("#c2").hide();

    });

    $(".listetable_client").on('click', '.client_table', function () {
        //c'est l'id du client ou table selectionné
        id1 = $(this).attr("id1");
        $("#client_id").val(id1);
        $("#client_id1").val(id1);

//c'est le nom du client ou table selectionné
        id2 = $(this).attr("id2");
        $("#cl_chxi").empty().append(id2);
        $("#id_client").val(id1);
        $("#c1").show();
        $("#c2").hide();
        $("#msd_attente").hide();
    });
    $('#produit a').click(function () {
        var donnees = '';
        var idprod = $(this).attr('id');
        var repas = $(this).attr('id2');
        var prixprod = $("#produit span[id=" + idprod + "]").html();
        var nameprod = $("#produit p[id=" + idprod + "]").html();
//        var qteprod=$("#tab_commandes td[id="+idprod+"]").html();
        $.ajax({
            url: 'Traitement/tableau_affichage_commandes.php?idprod=' + idprod + "&prixprod=" + prixprod + "&nameprod=" + nameprod + "&repas=" + repas,
            type: 'POST',
            data: donnees,
            success: function (data) {
                $("#btn_paiement_rapide").attr('disabled', false);
//                $("#btn_boncommande").remove('disabled');
                $('#affiche_commandes').html(data);
            }
        });
        return false;

//          alert(repas);
    });

    $('#btn_addition').click(function (e) {
        e.preventDefault();
        var donnees = '';
        var client = $("#client_id1").val();
        $.ajax({
            url: 'Traitement/nbr_produits.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data > 0 && client != '') {
                    $("#client_id1").val('');
                    window.open('impression/examples/recu_addition.php');
                }
                else {

                    $('#affiche_commandes').prepend('<div class="alert alert-danger text-center msg_add">Veuillez selectionner un client/table ou au moins un produit</div>');
                    $(".msg_add").fadeOut(5000);

                }
            }

        });
        return false;
    });
    $('.affichage_famille').click(function (e) {
        var idprod, affichage;
        lert(idprod);
        if ($(this).is(":checked")) {
            idprod = $(this).attr('id');
            alert(idprod);

        }


    });
    $('#btn_qte_produit').click(function () {
        var donnees = '';
        var qte_produit = $('#qte_produit').val();
        var id_produit = $('#id_produit').val();

        $.ajax({
            url: 'Traitement/tableau_affichage_commandes.php?id_produit=' + id_produit + "&qte_produit=" + qte_produit,
            type: 'POST',
            data: donnees,
            success: function (data) {
                $('#id_produit').val(' ');
                $('#qte_produit').val(' ');
                $("#qte_produit").attr('disabled', true);
                $("#btn_qte_produit").attr('disabled', true);
                $('#btn_sup_produit').attr('disabled', true);
                $('#affiche_commandes').html(data);
                $('#alert_qte').show().fadeOut(6000);
                $("#div_qte_produit").hide();
                $("#div_remise").show();
//                 alert('idprod');
            }
        });
        return false;
    });

    $('#btn_sup_produit').click(function () {

        var donnees = '';
        var id_produit;
        var qte_produit = $('#qte_produit').val();
        //var id_produit = $('#id_produit').val();
        var supprimer = 'OK';
        $('.affichage_produit:checked').each(function (i) {
            id_produit = $(this).val();
            $.ajax({
                url: 'Traitement/tableau_affichage_commandes.php?id_produit=' + id_produit + "&supprimer=" + supprimer,
                type: 'POST',
                data: donnees,
                success: function (data) {

                    $('#id_produit').val(' ');
                    $('#qte_produit').val(' ');
                    $("#qte_produit").attr('disabled', true);
                    $("#btn_qte_produit").attr('disabled', true);
                    $("#qte_produit").attr('disabled', true);
                    $("#btn_qte_produit").attr('disabled', true);
                    $('#btn_sup_produit').attr('disabled', true);
                    $("#div_qte_produit").hide();
                    $("#div_remise").show();
                    $('#affiche_commandes').html(data);
                }
            });

        });

        return false;

    });

    $('#btn_remise').click(function () {
        var donnees = '';
        var remise_val = $('#remise').val();
        var remise = 'OK';

        $.ajax({
            url: 'Traitement/tableau_affichage_commandes.php?remise_val=' + remise_val + "&remise=" + remise,
            type: 'POST',
            data: donnees,
            success: function (data) {
                $('#id_produit').val(' ');
                $('#qte_produit').val(' ');
                $('#remise').val(' ');
                $("#qte_produit").attr('disabled', true);
                $("#btn_qte_produit").attr('disabled', true);
                $("#qte_produit").attr('disabled', true);
                $("#btn_qte_produit").attr('disabled', true);
                $('#btn_sup_produit').attr('disabled', true);
                $('#affiche_commandes').html(data);
//                 alert('idprod');
            }
        });
        return false;

    });

    $('#btn_regler').click(function () {
        var mont_commande = $('#somme_commande').attr("id1");
        $('#mont_commande').val(mont_commande);
        $('#mont_fc').html(mont_commande);
        $.ajax({
            url: './Traitement/conversion.php',
            type: 'POST',
            success: function (data) {
                $('#mont_usd').html(data.mont_commande);
                $('#client_id').val($('#client_id1').val())

            }, dataType: 'json'
        });
    });


$("#valider1").click(function (e) {
        e.preventDefault();
        if ($("#client_id1").val() == '') {
            alert('vous avez oublié de selectionner une table ou un client!');
        } else {
            var donnees = $('#formpaiement').serialize();
            if ($("#id_cmd").val() != 0) {
                $.ajax({
                    url: './Traitement/reglement_attente.php',
                    async: true,
                    type: 'POST',
                    data: donnees,
                    global: false,
                    cache: false,
                    beforeSend: function () {
                        $('#loader').addClass('loader').show().fadeOut(2000, function () {
                        });
                    },
                    success: function (data) {
                        if (data.message == 'clientvide') {
                            alert('vous avez oublié de selectionner une table ou un client!');
                        } else if (data.message == 'montantInsufisant') {
                            alert('veuillez vérifier le montant saisi!');
                        } else if (data.message == 'OK') {
                            $("#myModal_paie").modal('hide');
                            $("#cl_chxi").empty().append("");
                            $("#id_cmd").val(0);
                            $("#client_id1").val("");
                            $("#affiche_commandes").empty();
//                          $("#com_id").val(data.commande_id);
                            $('#listetable_client').load('Traitement/miseenattente.php');
                            $('#affichage_tout_produit').empty().load('Traitement/affichage_tout_produit.php');
//                            $("#btn_boncommande").attr('disabled', false);
                            $('#tab_1').empty().load('liste_tbl_maj.php');
                            $('#tab_2').empty().load('liste_cl_maj.php');
                            
                            $('#affichage_boncommande').load('./Traitement/affichage_boncommande.php');
                            $('#tab_com').load('./Traitement/listecommande.php');
                            $("#btn_boncommande").show();
                            window.open('impression/examples/recu_bon_sortie.php?commande_id=' + data.commande_id);

                        }
                    },
                    complete: function () {
                    }, dataType: 'json'
                });
            } else {
                $.ajax({
                    url: './Traitement/reglement.php',
                    async: true,
                    type: 'POST',
                    data: donnees,
                    global: false,
                    cache: false,
                    beforeSend: function () {
                        $('#loader').addClass('loader').show().fadeOut(2000, function () {
                        });
                    },
                    success: function (data) {
                        if (data.message == 'clientvide') {
                            alert('vous avez oublié de selectionner une table ou un client!');
                        } else if (data.message == 'montantInsufisant') {
                            alert('veuillez vérifier le montant saisi!');
                        } else if (data.message == 'OK') {
                            $("#cl_chxi").empty().append("");
                            $("#id_cmd").val(0);
                            $("#client_id1").val("");
                            $("#myModal_paie").modal('hide');
                            $("#affiche_commandes").empty();
//                    $("#com_id").val(data.commande_id);
                            $('#listetable_client').load('Traitement/miseenattente.php');
                            $('#affichage_tout_produit').empty().load('Traitement/affichage_tout_produit.php');
                            $('#tab_1').empty().load('liste_tbl_maj.php');
                            $('#tab_2').empty().load('liste_cl_maj.php');
                            $('#tab_com').load('./Traitement/listecommande.php');
                            $('#affichage_boncommande').load('./Traitement/affichage_boncommande.php');
                            $("#btn_boncommande").show();
                            window.open('impression/examples/recu_bon_sortie.php?commande_id=' + data.commande_id);
                        }
                    },
                    complete: function () {

                    }, dataType: 'json'
                });
            }
        }

        return false;
    });

$('#btn_boncommande').click(function (e) {
        e.preventDefault();
        var donnees = '';
        var client = $("#client_id1").val();
        $.ajax({
            url: 'Traitement/nbr_produits.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data > 0 && client != '') {
//                    $("#client_id1").val('');
                    window.open('impression/examples/recu_bon_commande.php');
                }
                else {
//      alert('Veuillez selectionner un client/table ou au moins un produit'); 
                    $('#affiche_commandes').prepend('<div class="alert alert-danger text-center msg_add">Veuillez selectionner un client/table ou au moins un produit</div>');
                    $(".msg_add").fadeOut(5000);

                }
            }

        });
//        window.open('impression/examples/recu_addition.php');
        return false;
    });
//    // King


 $('#btn_attente').click(function () {
        var id_client = $("#client_id1").val();
        var id_cmd = $("#id_cmd").val();
        var donnees = " ";
        $.ajax({
            url: 'Traitement/tableau_affichage_commandes.php?id_client=' + id_client + "&id_cmd=" + id_cmd + "&attente=" + attente,
            type: 'POST',
            data: donnees,
            success: function (data) {

                $("#cl_chxi").empty().append("");
                $("#client_id1").val('');
                $("#id_cmd").val(0);
                $('#listetable_client').load('Traitement/miseenattente.php');
                $('#affichage_tout_produit').empty().load('Traitement/affichage_tout_produit.php');
//                $("#view_table").load('./Traitement/view_table.php');
                $('#affiche_commandes').html(data);
                $('#tab_1').empty().load('liste_tbl_maj.php');
                $('#tab_2').empty().load('liste_cl_maj.php');
                 $(".msg_alert1").fadeOut(5000);
            }
        });

        return false;
    });
// clique sur ticket
    $(".ticket").click(function (e) {
        $.ajax({
            url: 'Traitement/ticket_datas.php',
            async: true,
            type: 'POST',
            global: false,
            cache: false,
            success: function (html) {
                $("#c3").empty().append(html);
            }
        });
        $("#c1").hide();
        $("#c2").hide();
        $("#c3").show();

    });

    $('#famille a').on('click', 'a', function () {
        var donnees = ' ';
        var idfamille = $(this).attr('id');
        var famille = $("#famille span[id=" + idfamille + "]").html();
        $('#titre_famille').html(famille);
//        $('#famille').hide();
        $.ajax({
            url: './Traitement/sous_famille_ajax.php?famille_id=' + idfamille,
            type: 'POST',
            data: donnees,
            success: function (data) {

                $('#famille').html(data);

            }
        });

        return false;
    });
    $('#sous_famille1 a').click(function () {
        var donnees = ' ';
        var idfamille = $(this).attr('id');
        var famille = $("#famille span[id=" + idfamille + "]").html();
        $('#titre_famille').html(famille);
        $('#famille').hide();
        $.ajax({
            url: 'Traitement/sous_famille_ajax.php?famille_id=' + idfamille,
            type: 'POST',
            data: donnees,
            success: function (data) {

                $('#sous_famille').html(data);

            }
        });
        return false;
    });
    $('#home').click(function () {

        $('#sous_famille').empty().hide();
        $('#titre_famille').html(' ');
        $('#famille').show();
    });

    $('#btn_annuler').click(function () {
        var id_client = $("#client_id1").val();
        var id_cmd = $("#id_cmd").val();
        var annuler = "annuler";
        var donnees = " ";
        $.ajax({
            url: 'Traitement/tableau_affichage_commandes.php?annuler=' + annuler + "&id_cmd=" + id_cmd + "&id_client=" + id_client,
            type: 'POST',
            data: donnees,
            success: function (data) {
                $("#cl_chxi").empty().append("");
                $("#client_id1").val('');
                $("#id_cmd").val(0);
                $('#tab_1').empty().load('liste_tbl_maj.php');
                $('#tab_2').empty().load('liste_cl_maj.php');
                $('#affiche_commandes').html(data);
              


            }
        });
        return false;
    });
    $("#btn_regler").click(function (e) {
        e.preventDefault();
        var payer = "payer";
        $("#commandeID").val($("#id_cmd").val());
        var donnees = " ";
        $.ajax({
            url: 'Traitement/verifiercommande.php?payer=' + payer,
            type: 'POST',
            data: donnees,
            success: function (data) {

                if (data.message == 'OK') {
                    $("#myModal_paie").modal('hide');

                    $('#affiche_commandes').html('<div class="alert alert-warning text-center" id="alert_qte"><i class="fa fa-warning fa-fw"></i> On ne peut pas payer une commande vide</div>');
                    $('#alert_qte').show().fadeOut(5000);
                }
                else {
                    $("#myModal_paie").modal('show');
                }

            }, dataType: 'json'
        });
        return false;
    });


});

