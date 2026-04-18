// JavaScript Document
$(document).ready(function () {
    var id;
        //Suppression famille
        $("#dataTables-example5").on('click', '.btnshowmodalfam', function (e) {
            e.preventDefault();
            var id = $(this).attr("id");
            // alert(id);
            $("#famid").val(id);
            $("#myModalFAM").modal("show");
        });
        $("#confirmModalNoFam").click(function (e) {
            $("#myModalFAM").modal("hide");
        });
        $("#confirmModalYesFam").click(function (e) {
            var id = $("#famid").val();
            $.ajax({
                url: 'Traitement/fam_rmv.php?id=' + id,
                type: 'POST',
                success: function (d) {
                    if (d.del == 'true') {
                        //   $(".msg_sup").show().fadeOut(4000);
                        window.location.href = 'familles_view.php?del=true';
    
                    } else if (d.del == 'false') {
                        $(".msg_sup_false").show().fadeOut(4000);
                    }
    
                }, dataType: 'json'
            });
            $("#myModalFAM").modal("hide");
        });
        //Suppression sous_famille
        $("#dataTables-example6").on('click', '.btnshowmodalsfam', function (e) {
            e.preventDefault();
            var id = $(this).attr("id");
            // alert(id);
            $("#sfamid").val(id);
            $("#myModalSFAM").modal("show");
        });
        $("#confirmModalNoSFam").click(function (e) {
            $("#myModalSFAM").modal("hide");
        });
        $("#confirmModalYesSFam").click(function (e) {
            $.ajax({
                url: 'Traitement/s_fam_rmv.php?id=' + id,
                type: 'POST',
                success: function (html) {
                    $(".msg_sup").show();
                    $(".barre-cmd").hide();
                }
            });
            $("#myModal").modal("hide");
        });
    
        
    // Clic sur le bouton enregistrer 
    $('#save_sous_famille').click(function (e) {
        e.preventDefault();
        var donnees = $('#form').serialize();

        $.ajax({
            url: 'Traitement/sous_famille_insertion.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data.message_succes == 'succes') {
                    effacer();
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('#msg_alert').text("L'enrégistrement s'est effectué avec succès!")
                } else if (data.message_erreur == 'erreur') {
                    $('#msg').show()
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text("Cette designation " + data.des_value + " de la sous famille existe déjà")
                } else if (data.message_vide == 'vide') {
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez remplir les champs vides!')

                }

            },
            dataType: 'json'
        });

    });

    function effacer() {

        $(':input', '#form').not(':button,:submit,:reset,:hidden,\n\
                               #optionsRadiosInline,#monnaie,#datebonentre,#optbanque')
            .val('')
            .removeAttr('checked')
            .removeAttr('selected');
    }

    // Clic sur le bouton enregistrer 
    $('#save_depot').click(function (e) {
        e.preventDefault();
        var donnees = $('#form').serialize();

        $.ajax({
            url: 'Traitement/depot_insertion.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data.message_succes == 'succes') {
                    effacer();
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('#msg_alert').text("L'enrégistrement s'est effectué avec succès!")
                } else if (data.message_erreur == 'erreur') {
                    $('#msg').show()
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text("Cette designation " + data.des_value + " de la famille existe déjà")
                } else if (data.message_vide == 'vide') {
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez remplir les champs vides!')

                }

            },
            dataType: 'json'
        });

    });

    // Clic sur le bouton enregistrer 
    $('#save_famille').click(function (e) {
        e.preventDefault();
        var donnees = $('#form').serialize();

        $.ajax({
            url: 'Traitement/famille_insertion.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data.message_succes == 'succes') {
                    effacer();
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('#msg_alert').text("L'enrégistrement s'est effectué avec succès!")
                } else if (data.message_erreur == 'erreur') {
                    $('#msg').show()
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text("Cette designation " + data.des_value + " de la famille existe déjà")
                } else if (data.message_vide == 'vide') {
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez remplir les champs vides!')

                }

            },
            dataType: 'json'
        });

    });
    // Clic sur le bouton enregistrer produit
    $('#save_produit').click(function (e) {
        e.preventDefault();
        var form = $('#form_prod')[0];
        var data = new FormData(form);
        $.ajax({
            url: 'Traitement/produit_insertion.php',
            type: 'POST',
            enctype: 'multipart/form-data',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                // alert(data);
                if (data.message_succes == 'succes') {
                    $("#famille_id").val(' ');
                    $("#s_famille_id").val(' ');
                    $("#code").val(' ');
                    $("#unite").val(' ');
                    $("#libelle").val(' ');
                    $("#qte_min").val(' ');
                    $("#prix_vente").val(' ');
                    $("#prix_achat").val(' ');
                    $(".prxventsit").val(' ');
                    $('#img-upload').attr('src', '');
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('#msg_alert').text("L'enrégistrement s'est effectué avec succès!");
                    // location.href = 'produit_view.php';
                } else if (data.message_erreur == 'erreur') {
                    $('#msg').show()
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text("Le code ou la désignation du produit saisi existe déjà")
                } else if (data.message_vide == 'vide') {
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez remplir les champs vides!')

                } else if (data.message_prix == 'nocorrect') {
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez saisir les prix de vente corrects')

                }
            }
            , dataType: 'json'
        });
        return false;
    });


    // Clic sur le bouton enregistrer de approvisionnement
    $('#save_mouvement').click(function (e) {
        e.preventDefault();
        var donnees = $('#form').serialize();
        var bool = false;
        $.ajax({
            url: 'Traitement/mouvement_insertion.php',
            type: 'POST',
            data: donnees,
            beforeSend: function () {
                $("#loader").removeClass('hidden');
                $("#save_mouvement").addClass('hidden');
            },
            success: function (data) {
                if (data.message_succes == 'succes') {
                    effacer();
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('#msg_alert').text("L'enrégistrement s'est effectué avec succès!")
                } else if (data.message_prod_qte_total == 'depassement') {
                    $('#msg').show().fadeOut(8000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('La quantité sortie saisie doit être inférieure ou égale à la quantité du stock :' + data.prod_qte_total);
                } else if (data.message_erreur == 'erreur') {
                    $('#msg').show()
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text("Ce numero de bon " + data.nb_value + " de la commande existe déjà")
                } else {
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez remplir les champs vides!')
                }
                bool = true;
            },
            complete: function () {
                if (bool) {
                    $("#loader").addClass('hidden');
                    $("#save_mouvement").removeClass('hidden');
                } else {
                    $("#loader").removeClass('hidden');
                }
            },
            dataType: 'json'
        });

    });



    $('#save_fournisseur').click(function (e) {
        e.preventDefault();
        //        alert('bbbb');
        var donnees = $('#form').serialize();

        $.ajax({
            url: 'Traitement/fournisseur_insertion.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data.message_succes == 'succes') {
                    effacer();
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('#msg_alert').text("L'enrégistrement s'est effectué avec succès!")
                } else {
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez remplir les champs vides!')

                }

            },
            dataType: 'json'
        });

    });

    //   Fiche de stock par article
    $('#valider').click(function () {
        var bool = false;
        var valider = $('#valider').val();
        var date_rapport = $("#date_rapport").val();
        var date_PF = $("#date_PF").val();
        var famille_id = $("#famille_id").val();
        var depot_id = $("#depot_id").val();
        var url = 'tableau_stock_article.php';
        if (depot_id == 0) {
            url = 'tableau_stock_article_tout.php';
        }
        $.ajax({
            url: url,
            async: true,
            type: 'POST',
            data: "valider=" + valider + "&date_rapport=" + date_rapport + "&date_PF=" + date_PF + "&famille_id=" + famille_id + "&depot_id=" + depot_id,
            global: false,
            cache: false,
            beforeSend: function () {
                $("#loader").removeClass('hidden');
                $("#valider").addClass('hidden');
            },
            success: function (html) {
                bool = true;
                $("#table_article").empty().append(html);
            }, complete: function () {
                if (bool) {
                    $("#loader").addClass('hidden');
                    $("#valider").removeClass('hidden');
                } else {
                    $("#loader").removeClass('hidden');
                }
            }
        });

        return false;
    });

    //  Inventaire
    $('#inventaire').click(function () {
        var valider = 'poster';
        var s_famille_id = $("#s_famille_id").val();
        var date_rapport = $("#date_rapport").val();
        var depot_id = $("#depot_id").val();
        $.ajax({
            url: 'tableau_inventaire_article.php',
            type: 'POST',
            data: "valider=" + valider + "&s_famille_id=" + s_famille_id + "&date_rapport=" + date_rapport + "&depot_id=" + depot_id,
            beforeSend: function () {
                $("#loader").removeClass('hidden');
                $("#inventaire").addClass('hidden');
            },
            success: function (data) {
                $("#table_article").empty().append(data);
                bool = true;
            },
            complete: function () {
                if (bool) {
                    $("#loader").addClass('hidden');
                    $("#inventaire").removeClass('hidden');

                } else {
                    $("#loader").removeClass('hidden');
                }
            }
        });

        return false;
    });

    $(function () {
        $('#liste').addClass('loader').show().fadeOut(2000, function () {
            $('#view').show();
        });

    });

    // Clique sur une ligne tableau FAMILLE
    $('#dataTables-example3 tr').click(function (e) {
        var famille = $(this).find('td').eq(1).html();
        location.href = "liste_produit_famille.php?famille=" + famille + "& module=MS";
    });
    // Clique sur une ligne tableau FAMILLE
    $('#dataTables-example5 tr .td_modif').click(function (e) {
        var idfamille = $(this).attr("v");
        // alert(idfamille);
        location.href = "famille_modif_form.php?famille_id=" + idfamille + "& module=MS";
    });
    // Clique sur une ligne tableau PRODUIT
    $("#listproduit").on('click', '#dataTables-example4 produit_detail', function (e) {
        alert('ffhf');
        //        var code = $(this).attr("id");
        //        location.href = "produit_modif_form.php?code=" +code +"& module=MS";
    });

    // Clique sur une ligne tableau sous_famille
    $('#dataTables-example6 tr .td_modif').click(function (e) {
        var id_s_famille = $(this).attr("v");
        // alert(idfamille);
        location.href = "s_famille_modif_form.php?s_famille_id=" + id_s_famille + "& module=MS";
    });

    $("#dataTables-example5").on('click', '.affichage_famille', function () {
        var idfamille, affichage;
        idfamille = $(this).val();
        if ($(this).is(":checked")) {
            idfamille = $(this).attr('id');
            affichage = 1;
            $.ajax({
                url: 'Traitement/famille_change_statut.php',
                async: true,
                type: 'POST',
                data: "idfamille=" + idfamille + "&affichage=" + affichage,
                global: false,
                cache: false,
                success: function (html) {

                }
            });
        } else {
            idfamille = $(this).attr('id');
            affichage = 0;
            $.ajax({
                url: 'Traitement/famille_change_statut.php',
                async: true,
                type: 'POST',
                data: "idfamille=" + idfamille + "&affichage=" + affichage,
                global: false,
                cache: false,
                success: function (html) {

                }
            });
        }


    });

    $('.famille_plat').click(function (e) {
        var idfamille, plat;
        idfamille = $(this).val();
        if ($(this).is(":checked")) {
            idfamille = $(this).attr('id');
            plat = 1;
            $.ajax({
                url: 'Traitement/famille_active_statut_plat.php',
                async: true,
                type: 'POST',
                data: "idfamille=" + idfamille + "&plat=" + plat,
                global: false,
                cache: false,
                success: function (html) {

                }
            });
        } else {
            idfamille = $(this).attr('id');
            plat = 0;
            $.ajax({
                url: 'Traitement/famille_active_statut_plat.php',
                async: true,
                type: 'POST',
                data: "idfamille=" + idfamille + "&plat=" + plat,
                global: false,
                cache: false,
                success: function (html) {

                }
            });
        }


    });


    $('#update_mvt').click(function (e) {
        e.preventDefault();
        var bool = false;
        var donnees = $('#form').serialize();

        $.ajax({
            url: 'Traitement/approv_modifier.php',
            type: 'POST',
            data: donnees,
            beforeSend: function () {
                $("#loader").removeClass('hidden');
                $("#update_mvt").addClass('hidden');
            },
            success: function (data) {
                if (data.message_succes == 'succes') {
                    effacer();
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('#msg_alert').text("La mise a jour s'est effectué avec succès!")
                    bool = true;
                } else if (data.message_erreur == 'erreur') {
                    $('#msg').show()
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text("Ce numero de bon " + data.nb_value + " de la commande existe déjà")
                } else {
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez remplir les champs vides!')

                }


            },
            complete: function () {
                if (bool) {
                    $("#loader").addClass('hidden');
                    $("#update_mvt").removeClass('hidden');
                } else {
                    $("#loader").removeClass('hidden');
                }
            },
            dataType: 'json'
        });

    });

    $('#update_sortie').click(function (e) {
        e.preventDefault();
        var bool = false;
        var donnees = $('#form').serialize();

        $.ajax({
            url: 'Traitement/approv_modifier.php',
            type: 'POST',
            data: donnees,
            beforeSend: function () {
                $("#loader").removeClass('hidden');
                $("#update_sortie").addClass('hidden');
            },
            success: function (data) {
                if (data.message_succes == 'succes') {
                    effacer();
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('#msg_alert').text("La mise a jour s'est effectué avec succès!")
                    bool = true;
                } else {
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez remplir les champs vides!')

                }


            },
            complete: function () {
                if (bool) {
                    $("#loader").addClass('hidden');
                    $("#update_sortie").removeClass('hidden');
                } else {
                    $("#loader").removeClass('hidden');
                }
            },
            dataType: 'json'
        });

    });
    $('#update_produit').click(function (e) {
        e.preventDefault();
        var form = $('#form_update')[0];
        var data = new FormData(form);
        $.ajax({
            url: 'Traitement/prod_modifier.php',
            type: 'POST',
            enctype: 'multipart/form-data',
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                // alert(data);
                if (data.message_succes == 'succes') {
                    effacer();
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('#msg_alert').text("La mise a jour s'est effectué avec succès!");
                    location.href = "produit_view.php";
                } else if (data.message_erreur == 'erreur') {
                    $('#msg').show()
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text("Ce code " + data.code_value + " du produit saisi existe déjà")
                } else if (data.message_vide == 'vide') {
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez remplir les champs vides!')

                } else if (data.message_prix == 'nocorrect') {
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez saisir les prix de vente corrects')

                }
            }, dataType: 'json'
        });

        return false;
    });
    // $('#update_produit').click(function (e) {
    // e.preventDefault();
    // var donnees = $('#form').serialize();

    // $.ajax({
    // url: 'Traitement/prod_modifier.php',
    // type: 'POST',
    // data: donnees,
    // success: function (data) {
    // if (data.message_succes == 'succes') {
    // effacer();
    // $('#msg').show().fadeOut(4000)
    // .addClass('alert-success')
    // .removeClass('alert-danger');
    // $('#msg_alert').text("La mise a jour s'est effectué avec succès!")
    // } else if (data.message_erreur == 'erreur') {
    // $('#msg').show()
    // .addClass('alert-danger')
    // .removeClass('alert-success');
    // $('#msg_alert').text("Ce code " + data.code_value + " du produit saisi existe déjà")
    // }
    // else if (data.message_vide== 'vide') {
    // $('#msg').show().fadeOut(4000)
    // .addClass('alert-danger')
    // .removeClass('alert-success');
    // $('#msg_alert').text('Veuilez remplir les champs vides!')

    // }

    // }
    // , dataType: 'json'
    // });

    // });
    $('#update_famille').click(function (e) {
        e.preventDefault();
        var donnees = $('#form').serialize();

        $.ajax({
            url: 'Traitement/fam_modifier.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data.message_succes == 'succes') {
                    effacer();
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('#msg_alert').text("La mise a jour s'est effectué avec succès!")
                } else if (data.message_erreur == 'erreur') {
                    $('#msg').show()
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text("Cette designation " + data.des_value + " de la famille existe déjà")
                } else if (data.message_vide == 'vide') {
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez remplir les champs vides!')
                }

            },
            dataType: 'json'
        });

    });
    $('#update_s_famille').click(function (e) {
        e.preventDefault();
        var donnees = $('#form').serialize();
        $.ajax({
            url: 'Traitement/s_fam_modifier.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data.message_succes == 'succes') {
                    effacer();
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('#msg_alert').text("La mise a jour s'est effectué avec succès!")
                } else if (data.message_erreur == 'erreur') {
                    $('#msg').show()
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text("Cette designation " + data.des_value + " de la sous famille existe déjà")
                } else if (data.message_vide == 'vide') {
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez remplir les champs vides!')
                }
            },
            dataType: 'json'
        });

    });
    // Clique sur une ligne tableau Approvisionnement
    //    $(".table-responsive").on('click', '#dataTables-example1 tr', function (e) {
    //        var id = $(this).attr("id");
    //        //var numbon = $(this).find('td').eq(1).html();
    //        var type = "appro";
    //        location.href = "operation_modif_form.php?numbon=" + id + "&type=" + type;
    //    });

    // Clique sur une ligne tableau sortie
    //     $(".table-responsive").on('click', '#dataTables-example2 tr', function (e) {
    //         var id = $(this).attr("id");
    //        //var numbon = $(this).find('td').eq(1).html();
    //        var type = "sortie";
    //        location.href = "operation_modif_form.php?numbon=" + id + "&type=" + type;
    //    });

    //Suppression approvisionnement
    var id;
    $(".confirmModalLink").click(function (e) {
        e.preventDefault();
        id = $(this).attr("id");
        //        $("#myModal").modal("show");
    });
    $("#confirmModalNo").click(function (e) {
        $("#myModal").modal("hide");
    });
    $("#confirmModalYes").click(function (e) {
        $.ajax({
            url: 'Traitement/approv_rmv.php?id=' + id,
            type: 'POST',
            success: function (html) {
                $(".msg_sup").show();
                $(".barre-cmd").hide();
            }
        });
        $("#myModal").modal("hide");
        window.location.href = "familles_view.php?module=MS";

    });
    //Suppression sortie
    var id;
    $(".confirmModalLink1").click(function (e) {
        e.preventDefault();
        id = $(this).attr("id");
        //        $("#myModal").modal("show");
    });
    $("#confirmModalNo").click(function (e) {
        $("#myModal").modal("hide");
    });
    $("#confirmModalYes").click(function (e) {
        $.ajax({
            url: 'Traitement/sortie_rmv.php?id=' + id,
            type: 'POST',
            success: function (html) {
                $(".msg_sup").show();
                $(".barre-cmd").hide();
            }
        });
        $("#myModal").modal("hide");
        //window.location.href ="approvisionnement_view.php?operation=appro";

    });
    //Suppression produit
    var id;
    $(".confirmModalLink2").click(function (e) {
        e.preventDefault();
        id = $(this).attr("id");
        //        $("#myModal").modal("show");
    });
    $("#confirmModalNo").click(function (e) {
        $("#myModal").modal("hide");
    });
    $("#confirmModalYes").click(function (e) {
        $.ajax({
            url: 'Traitement/prod_rmv.php?id=' + id,
            type: 'POST',
            success: function (html) {
                $(".msg_sup").show();
                $(".barre-cmd").hide();
            }
        });
        $("#myModal").modal("hide");
        //window.location.href ="approvisionnement_view.php?operation=appro";

    });

    //Suppression famille
    var id;
    $(".confirmModalLink3").click(function (e) {
        e.preventDefault();
        id = $(this).attr("id");
        $("#myModal").modal("show");
    });
    $("#confirmModalNo").click(function (e) {
        $("#myModal").modal("hide");
    });
    $("#confirmModalYes").click(function (e) {
        $.ajax({
            url: 'Traitement/fam_rmv.php?id=' + id,
            type: 'POST',
            success: function (html) {
                $(".msg_sup").show();
                $(".barre-cmd").hide();
            }
        });
        $("#myModal").modal("hide");
        //window.location.href ="approvisionnement_view.php?operation=appro";
    });
    //Suppression sous_famille
    var id;
    $(".confirmModalLink4").click(function (e) {
        e.preventDefault();
        id = $(this).attr("id");
        //        $("#myModal").modal("show");
    });
    $("#confirmModalNo").click(function (e) {
        $("#myModal").modal("hide");
    });
    $("#confirmModalYes").click(function (e) {
        $.ajax({
            url: 'Traitement/s_fam_rmv.php?id=' + id,
            type: 'POST',
            success: function (html) {
                $(".msg_sup").show();
                $(".barre-cmd").hide();
            }
        });
        $("#myModal").modal("hide");
        //window.location.href ="approvisionnement_view.php?operation=appro";
    });
    //affichage prix de vente
    $("#famille_id").change(onSelectChange);

    function onSelectChange() {
        var idfamille = $("#famille_id").val();
        $.ajax({
            url: 'Traitement/requete_verif_pv.php',
            async: true,
            type: 'POST',
            data: "idfamille=" + idfamille,
            global: false,
            cache: false,
            success: function (data) {
                //                alert(data.affichage);
                //                alert(data.plat);
                if (data.affichage == '0') {
                    $(".pv").hide();
                    $("#enreg").val(0);
                    if (data.plat == '0') {
                        $(".plat").show();
                    } else if (data.plat == '1') {
                        $(".plat").hide();
                    }
                } else if (data.affichage == '1') {
                    $(".pv").show();
                    $("#enreg").val(1);
                    if (data.plat == '0') {
                        $(".plat").show();
                    } else if (data.plat == '1') {
                        $(".plat").hide();
                    }
                }
            },
            dataType: 'json'
        });

        $.ajax({
            url: 'Traitement/requete_s_famille.php',
            async: true,
            type: 'POST',
            data: "idfamille=" + idfamille,
            global: false,
            cache: false,
            success: function (html) {
                $("#s_famille_id").empty().append(html);
            }
        });


    }

    $("#repass").on('click', function (e) {
        if ($(this).is(":checked")) {
            $(this).val('1');
            //                 alert($(this).val());
        } else {
            $(this).val('0');
            //                alert($(this).val());
        }

    });

    $("#produit_id").change(onSelectChangeUnity);

    function onSelectChangeUnity() {
        var produit_id = $("#produit_id").val();
        $.ajax({
            url: 'Traitement/select_code_produit.php',
            async: true,
            type: 'POST',
            data: "produit_id=" + produit_id,
            global: false,
            cache: false,
            success: function (html) {
                //alert(html);
                $("#qte_dispo").empty().append(html);
            }
        });
        $.ajax({
            url: 'Traitement/select_code_produit.php',
            async: true,
            type: 'POST',
            data: "produit_id=" + produit_id,
            global: false,
            cache: false,
            success: function (html) {
                $("#code").empty().append(html);
            }
        });


    }

    $("#add_prod").click(function () {
        var selected = $("#produit_id option:selected");
        var produit_id = selected.val();
        var designation = selected.text();
        var code = $("#code").val();
        var qte = $("#qte").val();
        //            alert(ingred_id);
        $.ajax({
            url: 'Traitement/tableau_fiche_transfert.php',
            async: true,
            type: 'POST',
            data: "produit_id=" + produit_id + "&designation=" + designation + "&code=" + code + "&qte=" + qte,
            global: false,
            cache: false,
            success: function (data) {
                $("#fiche_tranfert").empty().html(data);
                $("#modaldepot").modal('hide');
                $("#qte").val('');
            }
        });

    });


    $('#btn_supp').click(function (e) {
        var donnees = '';
        var produit_id;
        var supprimer = 'OK';
        $('.ch_prod:checked').each(function (i) {
            produit_id = $(this).val();
            $.ajax({
                url: 'Traitement/tableau_fiche_transfert.php?produit_id=' + produit_id + "&supprimer=" + supprimer,
                type: 'POST',
                data: donnees,
                success: function (data) {
                    $("#fiche_tranfert").empty().html(data);
                }
            });
        });
        return false;
    });

    $("#fiche_tranfert").on('mouseout', '.qte', function () {
        var donnees = '';
        var produit_id = $(this).attr('id');
        var qte = $(this).val();
        //            alert(qte_produit);
        var modifier = 'OK';
        $.ajax({
            url: 'Traitement/tableau_fiche_transfert.php?produit_id=' + produit_id + "&modifier=" + modifier + "&qte=" + qte,
            type: 'POST',
            data: donnees,
            success: function (data) {
                //                    alert(data);
                $("#fiche_tranfert").empty().html(data);
            }
        });
        return false;
    });

    $("#quantite_transf").on('mouseout', '#qte', function () {
        //        var donnees = '';
        var qte_dispo = $("#qte_dispo").val();
        var qte_produit = $(this).val();

        $.ajax({
            url: 'Traitement/verif_qte_transfert.php',
            async: true,
            type: 'POST',
            data: "qte_dispo=" + qte_dispo + "&qte_produit=" + qte_produit,
            global: false,
            cache: false,
            dataType: 'json',
            success: function (data) {
                if (data.test_qte_trans == '0') {
                    if (data.test_qte_dispo == '2') {
                        //            alert(qte_dispo);
                        $('#msg_popup').show().fadeOut(8000);
                        $('#msg_alert_popup').text('La quantité à transferer doit être inférieure ou égale à la quantité disponible :' + data.qte_dispo);
                        $('#add_prod').addClass('disabled');
                    } else {
                        $('#add_prod').removeClass('disabled');
                    }
                } else {
                    $('#add_prod').addClass('disabled');
                }
            }
        });

        return false;
    });

    // Clic sur le bouton enregistrer de approvisionnement
    $('#save_mouvement1').click(function (e) {
        e.preventDefault();
        var donnees = $('#form1').serialize();
        var bool = false;

        //        alert(donnees);

        $.ajax({
            url: 'Traitement/mouvement_insertion_depot.php',
            type: 'POST',
            data: donnees,
            beforeSend: function () {
                $("#loader_depot").removeClass('hidden');
                $("#save_mouvement1").addClass('hidden');
            },
            success: function (data) {
                if (data.message_succes == 'succes') {
                    effacer();
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('#msg_alert').text("L'enrégistrement s'est effectué avec succès!");
                    window.open('impression/fiche_transfert.php');

                } else if (data.message_prod_qte_total == 'depassement') {
                    $('#msg').show().fadeOut(8000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('La quantité sortie saisie doit être inférieure ou égale à la quantité du stock :' + data.prod_qte_total);
                } else if (data.message_erreur == 'erreur') {
                    $('#msg').show()
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text("Ce numero de bon " + data.nb_value + " de la commande existe déjà")
                } else {
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez remplir les champs vides!')
                }
                bool = true;
            },
            complete: function () {
                if (bool) {
                    $("#loader_depot").addClass('hidden');
                    $("#save_mouvement1").removeClass('hidden');
                } else {
                    $("#loader_depot").removeClass('hidden');
                }
            },
            dataType: 'json'
        });

    });

    // Clique sur une ligne tableau FAMILLE
    $('#dataTables-example55 tr .td_modif').click(function (e) {
        var id_depot = $(this).attr("v");
        // alert(idfamille);
        location.href = "depot_details.php?depot_id=" + id_depot + "& module=MS";
    });

    $('#update_depot').click(function (e) {
        e.preventDefault();
        var donnees = $('#form').serialize();

        $.ajax({
            url: 'Traitement/depot_modifier.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data.message_succes == 'succes') {
                    effacer();
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('#msg_alert').text("La mise a jour s'est effectué avec succès!")
                } else if (data.message_erreur == 'erreur') {
                    $('#msg').show()
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text("Ce libellé " + data.des_value + " du depot existe déjà")
                } else if (data.message_vide == 'vide') {
                    $('#msg').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez remplir les champs vides!')
                }

            },
            dataType: 'json'
        });

    });

    $("#dataTables-example5").on('click', '.famille_fiche_tech', function () {
        var idfamille, affichage;
        idfamille = $(this).val();
        // alert(idfamille);
        if ($(this).is(":checked")) {
            idfamille = $(this).attr('id');
            affichage = 1;
            $.ajax({
                url: 'Traitement/famille_change_statut_fiche.php',
                async: true,
                type: 'POST',
                data: "idfamille=" + idfamille + "&affichage=" + affichage,
                global: false,
                cache: false,
                success: function (html) {

                }
            });
        } else {
            idfamille = $(this).attr('id');
            affichage = 0;
            $.ajax({
                url: 'Traitement/famille_change_statut_fiche.php',
                async: true,
                type: 'POST',
                data: "idfamille=" + idfamille + "&affichage=" + affichage,
                global: false,
                cache: false,
                success: function (html) {

                }
            });
        }


    });

    $("#depot1_id").change(onSelectChange);

    function onSelectChange() {
        var depot1_id = $("#depot1_id").val();
        //        alert(depot1_id);
        $.ajax({
            url: 'Traitement/requete_sous_depot.php',
            async: true,
            type: 'POST',
            data: "depot1_id=" + depot1_id,
            global: false,
            cache: false,
            success: function (html) {
                $("#depot2_id").empty().append(html);
            }
        });

        $.ajax({
            url: 'Traitement/produit_combo_sous_depot.php',
            async: true,
            type: 'POST',
            data: "depot1_id=" + depot1_id,
            global: false,
            cache: false,
            success: function (html) {
                $("#produit2_id").empty().append(html);
            }
        });

    }

    $("#produit2_id").change(onSelectChangeUnity2);

    function onSelectChangeUnity2() {
        var produit_id = $("#produit2_id").val();
        var selected = $("#produit2_id option:selected");
        var depot_id = selected.attr('att1');
        var qte_dispo = selected.attr('att2');
        $("#depot_id2").val(depot_id);
        //        alert(qte_dispo);
        $.ajax({
            url: 'Traitement/select_code_produit.php',
            async: true,
            type: 'POST',
            data: "produit_id=" + produit_id,
            global: false,
            cache: false,
            success: function (html) {
                $("#code2").empty().append(html);
                $("#qte_dispo2").val(qte_dispo);

            }
        });

        //        $.ajax({
        //            url: 'Traitement/select_qte_produit.php',
        //            async: true,
        //            type: 'POST',
        //            data: "produit_id=" + produit_id,
        //            global: false,
        //            cache: false,
        //            success: function (html) {
        //                $("#qte_dispo2").val(html);
        //            }
        //        });
    }

    $("#add_prod2").click(function () {
        var selected = $("#produit2_id option:selected");
        var produit_id = selected.val();
        var designation = selected.text();
        var code = $("#code2").val();
        var qte = $("#qte2").val();
        var depot_id2 = $("#depot_id2").val();
        //            alert(ingred_id);
        $.ajax({
            url: 'Traitement/tableau_fiche_transfert_depot.php',
            async: true,
            type: 'POST',
            data: "produit_id=" + produit_id + "&designation=" + designation + "&code=" + code + "&qte=" + qte + "&depot_id2=" + depot_id2,
            global: false,
            cache: false,
            success: function (data) {
                $("#fiche_tranfert2").empty().html(data);
                $("#modaldepot2").modal('hide');
                $("#qte2").val('');
            }
        });

    });

    $('#btn_supp2').click(function (e) {
        var donnees = '';
        var produit_id;
        //            var qte_produit = $('#qte_produit').val();
        //var id_produit = $('#id_produit').val();
        var supprimer = 'OK';
        $('.ch_prod2:checked').each(function (i) {
            produit_id = $(this).val();
            $.ajax({
                url: 'Traitement/tableau_fiche_transfert_depot.php?produit_id=' + produit_id + "&supprimer=" + supprimer,
                type: 'POST',
                data: donnees,
                success: function (data) {
                    $("#fiche_tranfert2").empty().html(data);
                }
            });
        });
        return false;
    });

    $("#fiche_tranfert2").on('mouseout', '.qte2', function () {
        var donnees = '';
        var produit_id = $(this).attr('id');
        var qte = $(this).val();
        //            alert(qte_produit);
        var modifier = 'OK';
        $.ajax({
            url: 'Traitement/tableau_fiche_transfert_depot.php?produit_id=' + produit_id + "&modifier=" + modifier + "&qte=" + qte,
            type: 'POST',
            data: donnees,
            success: function (data) {
                //                    alert(data);
                $("#fiche_tranfert2").empty().html(data);
            }
        });
        return false;
    });

    //MAJ STOCK
    $("#btn_add_prod_panier").click(function () {
        var donnees = $(".frmaddprodstk").serialize();
        $.ajax({
            url: "Traitement/stock_ctrl.php?do=addprod&ajx=1",
            type: 'POST',
            data: donnees,
            success: function (data) {
                // alert(data);
                if (!data.s) {
                    $('#msg').show().fadeOut(4000).removeClass('hidden');
                    $('#msgtext').text(data.message);

                } else {
                    // Liste des produits ajoutés
                    var bloc_affiche = data.affichage;
                    var op = data.operation;
                    $.ajax({
                        url: "Traitement/stock_ctrl.php?do=voirpan&ajx=1&op=" + op,
                        type: 'POST',
                        success: function (data) {
                            $(bloc_affiche).empty().html(data);
                        }
                    });
                }
            }, dataType: 'json'
        });
        return false;
    });
    $("#btn_add_prod_panier2").click(function () {
        var donnees = $(".frmaddprodstk2").serialize();
        var bloc_affiche = '';
        var op = '';
        $.ajax({
            url: "Traitement/stock_ctrl.php?do=addprod&ajx=1",
            type: 'POST',
            data: donnees,
            success: function (data) {
                // alert(data)
                if (!data.s) {
                    $('#msg2').show().fadeOut(4000).removeClass('hidden');
                    $('#msgtext2').text(data.message);

                } else {
                    // Liste des produits ajoutés
                    bloc_affiche = data.affichage;
                    op = data.operation;
                    // alert(bloc_affiche);
                    // alert(op);
                    $.ajax({
                        url: "Traitement/stock_ctrl.php?do=voirpan&ajx=1&op=" + op,
                        type: 'POST',
                        success: function (data) {
                            //alert(data);
                            $(bloc_affiche).empty().html(data);
                        }
                    });
                }
            }, dataType: 'json'
        });
        return false;
    });
    $("#page-wrapper").on('click', '.btn_del_prod_panier', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var op = $(this).attr('op');
        var bloc_affiche = $(this).attr('affichage');
        $.ajax({
            url: "Traitement/stock_ctrl.php?do=delprod&ajx=1&id=" + id + '&op=' + op,
            type: 'GET',
            success: function (data) {
                $(bloc_affiche).empty().html(data);
            }
        });
        return false;
    });
    $(".article").change(function () {
        var unite = $(".article option:selected").attr('unite');
        var prod_nom = $(".article option:selected").attr('prod_nom');
        $(".unite").val(unite);
        $(".prod_nom").val(prod_nom);
    });
    $(".article2").change(function () {
        var unite = $(".article2 option:selected").attr('unite');
        var prod_nom = $(".article2 option:selected").attr('prod_nom');
        $(".unite2").val(unite);
        $(".prod_nom2").val(prod_nom);
    });
    $(".motif_sortie").change(function () {
        var prod_nom = $(".motif_sortie option:selected").attr('prod_nom');
        $(".motif_sortie_lib").val(prod_nom);
    });
    $(".sortie").click(function () {
        $(".type_sortie").val($(this).attr('sortie'));
        $(".do2").val($(this).attr('do2'));
    });
    $("#pos_id").change(function () {
        var posname = $("#pos_id option:selected").attr('posname');
        $("#posname").val(posname);
    });

    $("#page-wrapper").on('click', '#btn_save_mvmt', function (e) {
        e.preventDefault();
        var bool = false;
        var donnees = $(".frmstk").serialize();
        $.ajax({
            url: "Traitement/stock_ctrl.php?do=mvmt&do2=appro&ajx=1",
            type: 'POST',
            data: donnees,
            beforeSend: function () {
                $(".loader").removeClass('hidden');
                $("#btn_save_mvmt").addClass('hidden');
            },
            success: function (data) {
                //   alert(data);
                if (!data.s) {
                    $('#msg_grp').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert_grp').text(data.message);
                } else {
                    $('#msg_grp').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('#msg_alert_grp').text(data.message);
                    $("#numbon").val('');
                    // Liste des produits ajoutés
                    $.ajax({
                        url: "Traitement/stock_ctrl.php?do=voirpan&ajx=1&op=appro",
                        type: 'POST',
                        success: function (html) {
                            $("#lignesmvmt").empty().html(data);
                        }
                    });
                    window.open('./impression/bon_appro.php');
                    window.location.href = 'approvisionnement_liste.php ';

                }
                bool = true;
            },
            complete: function () {
                if (bool) {
                    $(".loader").addClass('hidden');
                    $("#btn_save_mvmt").removeClass('hidden');
                } else {
                    $(".loader").removeClass('hidden');
                }
            }, dataType: 'json'
        });
        return false;
    });
    $("#page-wrapper").on('click', '#btn_save_mvmt_update', function (e) {
        e.preventDefault();
        var bool = false;
        var donnees = $(".frmstk").serialize();
        $.ajax({
            url: "Traitement/stock_ctrl.php?do=mvmt&do2=approupdate&ajx=1",
            type: 'POST',
            data: donnees,
            beforeSend: function () {
                $(".loader").removeClass('hidden');
                $("#btn_save_mvmt_update").addClass('hidden');
            },
            success: function (data) {
                //  alert(data);
                if (!data.s) {
                    $('#msg_grp').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert_grp').text(data.message);
                } else {
                    $('#msg_grp').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('#msg_alert_grp').text(data.message);
                    $("#numbon").val('');
                    // Liste des produits ajoutés
                    $.ajax({
                        url: "Traitement/stock_ctrl.php?do=voirpan&ajx=1&op=appro",
                        type: 'POST',
                        success: function (html) {
                            $("#lignesmvmt").empty().html(data);
                        }
                    });
                    window.open('./impression/bon_appro.php');
                    window.location.href = 'approvisionnement_liste.php ';

                }
                bool = true;
            },
            complete: function () {
                if (bool) {
                    $(".loader").addClass('hidden');
                    $("#btn_save_mvmt_update").removeClass('hidden');
                } else {
                    $(".loader").removeClass('hidden');
                }
            }, dataType: 'json'
        });
        return false;
    });
    $("#page-wrapper").on('click', '.btn_del_mvmt', function (e) {
        e.preventDefault();
        var bool = false;
        var donnees = "";
        var fiche_id = $(this).attr("id");
        var op = $(this).attr("op");

        $.ajax({
            url: "Traitement/stock_ctrl.php?do=del_mvt_fiche&ajx=1&fiche_id=" + fiche_id,
            type: 'POST',
            data: donnees,
            beforeSend: function () {
                $(".loader").removeClass('hidden');
                $(".btn_del_mvmt").addClass('hidden');
            },
            success: function (data) {
                if (op == "appro") {
                    window.location.href = 'approvisionnement_liste.php ';
                } else if (op == "sortie") {
                    window.location.href = 'approvisionnement_view.php?operation=sortie';

                }
                bool = true;

            },
            complete: function () {
                if (bool) {
                    $(".loader").addClass('hidden');
                    $(".btn_del_mvmt").removeClass('hidden');
                } else {
                    $(".loader").removeClass('hidden');
                }
            }
        });
        return false;
    });
    $("#page-wrapper").on('click', '.btn_enreg_sortie', function (e) {
        e.preventDefault();
        var bool = false;
        var frmsortie = $(".type_sortie").val();
        var do2 = $(".do2").val();
        var donnees = $(frmsortie).serialize();
        $.ajax({
            url: "Traitement/stock_ctrl.php?do=mvmt&ajx=1&do2=" + do2,
            type: 'POST',
            data: donnees,
            beforeSend: function () {
                $(".loader").removeClass('hidden');
                $(".btn_enreg_sortie").addClass('hidden');
            },
            success: function (data) {
                if (!data.s) {
                    $('.msg_grp').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('.msg_alert_grp').text(data.message);
                } else {
                    $('#benef').val('');
                    $('.msg_grp').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('.msg_alert_grp').text(data.message);
                    // Liste des produits ajoutés
                    $.ajax({
                        url: "Traitement/stock_ctrl.php?do=voirpan&ajx=1&op=sortie",
                        type: 'POST',
                        success: function (html) {
                            $(data.bloc_affiche).empty().html(data);
                        }
                    });
                    window.open('./impression/bon_sortie.php');
                    window.location.href = 'approvisionnement_view.php?operation=sortie';

                }
                bool = true;

            },
            complete: function () {
                if (bool) {
                    $(".loader").addClass('hidden');
                    $(".btn_enreg_sortie").removeClass('hidden');
                } else {
                    $(".loader").removeClass('hidden');
                }
            },
            dataType: 'json'
        });
        return false;
    });
    $("#page-wrapper").on('click', '.btn_enreg_sortie2', function (e) {
        e.preventDefault();
        var bool = false;
        var donnees = $('#transfert').serialize();
        var do2 = 'transfert';
        $.ajax({
            url: "Traitement/stock_ctrl.php?do=mvmt&ajx=1&do2=" + do2,
            type: 'POST',
            data: donnees,
            beforeSend: function () {
                $(".loader2").removeClass('hidden');
                $(".btn_enreg_sortie2").addClass('hidden');
            },
            success: function (data) {
                if (!data.s) {
                    $('.msg_grp2').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('.msg_alert_grp2').text(data.message);
                } else {
                    $('.msg_grp2').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('.msg_alert_grp2').text(data.message);
                    // Liste des produits ajoutés
                    $.ajax({
                        url: "Traitement/stock_ctrl.php?do=voirpan&ajx=1&op=transfert",
                        type: 'POST',
                        success: function (html) {
                            $(data.bloc_affiche).empty().html(data);
                        }
                    });
                    window.open('./impression/bon_transfert.php');
                }
                bool = true;
            },
            complete: function () {
                if (bool) {
                    $(".loader2").addClass('hidden');
                    $(".btn_enreg_sortie2").removeClass('hidden');
                } else {
                    $(".loader2").removeClass('hidden');
                }
            },
            dataType: 'json'
        });
        return false;
    });


    $("#page-wrapper").on('click', '.btn_sortie_update', function (e) {
        e.preventDefault();
        var bool = false;
        var frmsortie = $(".type_sortie").val();
        var do2 = $(".do2").val();
        var donnees = $(frmsortie).serialize();
        $.ajax({
            url: "Traitement/stock_ctrl.php?do=mvmt&ajx=1&do2=" + do2,
            type: 'POST',
            data: donnees,
            beforeSend: function () {
                $(".loader").removeClass('hidden');
                $(".btn_sortie_update").addClass('hidden');
            },
            success: function (data) {
                //   alert(data);
                if (!data.s) {
                    $('.msg_grp').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('.msg_alert_grp').text(data.message);
                } else {
                    $('#benef').val('');
                    $('.msg_grp').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('.msg_alert_grp').text(data.message);
                    // Liste des produits ajoutés
                    $.ajax({
                        url: "Traitement/stock_ctrl.php?do=voirpan&ajx=1&op=sortie",
                        type: 'POST',
                        success: function (html) {
                            $(data.bloc_affiche).empty().html(data);
                        }
                    });
                    window.open('./impression/bon_sortie.php');
                    window.location.href = 'approvisionnement_view.php?operation=sortie';

                }
                bool = true;

            },
            complete: function () {
                if (bool) {
                    $(".loader").addClass('hidden');
                    $(".btn_sortie_update").removeClass('hidden');
                } else {
                    $(".loader").removeClass('hidden');
                }
            }, dataType: 'json'
        });
        return false;
    });
    $('#save_config').click(function (e) {
        e.preventDefault();
        var donnees = $('#form_config').serialize();

        $.ajax({
            url: 'Traitement/config_insertion.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data.message_succes == 'succes') {
                    effacer();
                    $('#msg_config').show().fadeOut(4000)
                        .addClass('alert-success')
                        .removeClass('alert-danger');
                    $('#msg_alert_config').text("La mise à jour s'est effectueé avec succès!")
                } else if (data.message_vide == 'vide') {
                    $('#msg_config').show().fadeOut(4000)
                        .addClass('alert-danger')
                        .removeClass('alert-success');
                    $('#msg_alert_config').text('Veuilez remplir les champs vides!')

                }

            },
            dataType: 'json'
        });

    });

    $("#s_famille_id").change(function () {
        var vente = $("#s_famille_id option:selected").attr('vente');
        $("#repas").val(vente);
        if (vente == "1") {
            $(".pv").removeClass('hidden');
        } else {
            $(".pv").addClass('hidden');
            $(".prxventsit").val(0);
        }
    });

    $("#emplacement_id").change(function () {
        var emplacement_id = $("#emplacement_id").val();
        $("#empl_id").val(emplacement_id);

    });
    $("#source_id").change(function () {
        var emplacement_id = $("#source_id").val();
        $("#source1").val(emplacement_id);

    });
    $(".prodpv").change(function (e) {
        if ($("input[name='venteprod']:checked").val() == 'simple') {
            $('#myTab a[href="#tab_1"]').tab('show');
            $("#grsaleprod").hide();
            $("#repas").val(0);
        } else if ($("input[name='venteprod']:checked").val() == 'groupe') {
            $("#grsaleprod").show();
            $("#repas").val(3);

        }
    });

});