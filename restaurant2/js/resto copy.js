//JavaScript Document
$(document).ready(function () {
  // Clique sur une ligne tableau SORTIE listecommande retour
  $("#tab_com").on("click", "#commandes tr", function (e) {
    var numcom = $(this).find("td").eq(1).html();
    var etat = $(this).attr("id3");
    $("#tab_com").load(
      "./Traitement/apercu_commande.php?numcom=" + numcom + "&etat=" + etat
    );
  });
  $("#retour").click(function (e) {
    $("#tab_com").load("./Traitement/listecommande.php");
  });

  $("#fermer").click(function (e) {
    $("#c1").show();
    $("#c2").hide();
  });
  $("#btn_table").click(function () {
    var url = "Traitement/tableajax.php";
    $.ajax({
      url: url,
      type: "POST",
      success: function (data) {
        $("#produit1").empty().append(data);
        $("#affichage_tout_produit").hide();
        $("#tab_1").show();
        $("#tab_2").hide();
        $("#tab_3").hide();
      },
    });
    return false;
  });
  $("#btn_table_caisse").click(function () {
    var url = "Traitement/tableajaxcaisse.php";
    $.ajax({
      url: url,
      type: "POST",
      success: function (data) {
        $("#produit1").empty().append(data);
        $("#affichage_tout_produit").hide();
        $("#tab_1").show();
        $("#tab_2").hide();
        $("#tab_3").hide();
      },
    });
    return false;
  });
  $("#tab_1").on("click", "#fermer_tab", function () {
    $("#affichage_tout_produit").show();
    $("#tab_1").hide();
  });

  $("#btn_client").click(function (e) {
    e.preventDefault();
    $("#affichage_tout_produit").hide();
    $("#tab_2").show().empty().load("liste_cl_maj.php");
    $("#tab_1").hide();
    $("#tab_3").hide();
  });
  $("#btn_client_caisse").click(function (e) {
    e.preventDefault();
    $("#affichage_tout_produit").hide();
    $("#tab_2").show().empty().load("liste_cl_maj_caisse.php");
    $("#tab_1").hide();
    $("#tab_3").hide();
  });
  $("#btn_serveur").click(function () {
    $("#affichage_tout_produit").hide();
    $("#tab_3").show();
    $("#tab_1").hide();
    $("#tab_2").hide();
  });
  $("#tab_3").on("click", "#fermer_tab3", function () {
    $("#affichage_tout_produit").show();
    $("#tab_3").hide();
  });
  $("#tab_2").on("click", "#fermer_tab2", function () {
    $("#affichage_tout_produit").show();
    $("#tab_2").hide();
  });

  $(".home").click(function () {
    $("#blc_categorie_produit_vente").removeClass("hidden");
    $("#blc_produit_vente").addClass("hidden");
    $("#sorte_search").val("categorie");
    $("#product_search").val("");
    var motif = "";
    var sorte_search = $("#sorte_search").val("categorie");
    var url = "Traitement/categorie_produit_vente2.php?motif=" + motif;
    var blc_af_cat = "#blc_categorie_produit_vente";
    $.ajax({
      url: url,
      type: "POST",
      success: function (data) {
        $(blc_af_cat).empty().append(data);
      },
    });
    return false;
  });
  $(".fam").click(function () {
    //        id = $(this).attr("id");
    //        cl = "." + id;
    //        $(cl).show();
    //        $(".fam").hide();
  });
  $(".s_fam").click(function () {
    id = $(this).attr("id");
    // alert(id);
    $(".prod").hide();
    cl = "." + id;
    $(cl).show();
  });

  $(".confirmModalLink").click(function (e) {
    var bool = false;
    var donnees = $("#frmdte").serialize();
    $("#fermer").removeClass("hidden");
    $("#btn_retour_liste_commande").addClass("hidden");

    var donnees1 = $("#frmdte_annul").serialize();
    $("#btn_retour_liste_commande_annul").addClass("hidden");

    var donnees2 = $("#frmdte_tva").serialize();
    $("#btn_retour_liste_commande_tva").addClass("hidden");
    $(".mdplus").modal("hide");

    $.ajax({
      url: "datalistcommande.php",
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $(".loader_list").removeClass("hidden");
        $("#c1").hide();
        $("#c2").show();
        $("#c3").hide();
        $("#c4").hide();
      },
      success: function (data) {
        bool = true;
        $("#example1").empty().append(data);
      },
      complete: function () {
        if (bool) {
          $(".loader_list").addClass("hidden");
        } else {
          $(".loader_list").removeClass("hidden");
        }
      },
    });

    $.ajax({
      url: "datalistcommande_annul.php",
      type: "POST",
      data: donnees1,
      beforeSend: function () {
        $(".loader_list").removeClass("hidden");
        $("#c1").hide();
        $("#c2").show();
        $("#c3").hide();
        $("#c4").hide();
      },
      success: function (data) {
        bool = true;
        $("#example11").empty().append(data);
      },
      complete: function () {
        if (bool) {
          $(".loader_list").addClass("hidden");
        } else {
          $(".loader_list").removeClass("hidden");
        }
      },
    });
  });

  $("#btn_filter_date_tva").click(function (e) {
    e.preventDefault();
    var bool = false;
    var donnees = $("#frmdte_tva").serialize();
    $.ajax({
      url: "datalistcommande_tva.php",
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $(".loader_list").removeClass("hidden");
      },
      success: function (data) {
        bool = true;
        $("#example12").empty().append(data);
      },
      complete: function () {
        if (bool) {
          $(".loader_list").addClass("hidden");
        } else {
          $(".loader_list").removeClass("hidden");
        }
      },
    });
  });

  $("#btn_filter_date").click(function (e) {
    e.preventDefault();
    var bool = false;
    var donnees = $("#frmdte").serialize();
    $.ajax({
      url: "datalistcommande.php",
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $(".loader_list").removeClass("hidden");
      },
      success: function (data) {
        bool = true;
        $("#example1").empty().append(data);
      },
      complete: function () {
        if (bool) {
          $(".loader_list").addClass("hidden");
        } else {
          $(".loader_list").removeClass("hidden");
        }
      },
    });
  });

  $("#btn_filter_date_annul").click(function (e) {
    e.preventDefault();
    var bool = false;
    var donnees = $("#frmdte_annul").serialize();
    $.ajax({
      url: "datalistcommande_annul.php",
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $(".loader_list").removeClass("hidden");
      },
      success: function (data) {
        bool = true;
        $("#example11").empty().append(data);
      },
      complete: function () {
        if (bool) {
          $(".loader_list").addClass("hidden");
        } else {
          $(".loader_list").removeClass("hidden");
        }
      },
    });
  });

  // Clique sur btn details commande
  $("#bloc_tout_commande").on("click", ".btn_details_com", function (e) {
    var id = $(this).attr("id");
    var bool = false;
    $.ajax({
      url: "datadetailscommande.php?id=" + id,
      type: "POST",
      beforeSend: function () {
        $(".loader_list").removeClass("hidden");
        $("#fermer").addClass("hidden");
        $("#btn_retour_liste_commande").removeClass("hidden");
        $(".list_all_commande").addClass("hidden");
        $(".details_commande").removeClass("hidden");
      },
      success: function (data) {
        bool = true;
        $("#bloc_affiche_details_commande").html(data);
      },
      complete: function () {
        if (bool) {
          $(".loader_list").addClass("hidden");
        } else {
          $(".loader_list").removeClass("hidden");
        }
      },
    });
  });

  // Clique sur btn details commande (annulées)
  $("#bloc_tout_commande_annul").on(
    "click",
    ".btn_details_com_annul",
    function (e) {
      var id = $(this).attr("id");
      var bool = false;
      $.ajax({
        url: "datadetailscommande_annul.php?id=" + id,
        type: "POST",
        beforeSend: function () {
          $(".loader_list").removeClass("hidden");
          $("#fermer").addClass("hidden");
          $("#btn_retour_liste_commande_annul").removeClass("hidden");
          $(".list_all_commande_annul").addClass("hidden");
          $(".details_commande_annul").removeClass("hidden");
        },
        success: function (data) {
          bool = true;
          $("#bloc_affiche_details_commande_annul").html(data);
        },
        complete: function () {
          if (bool) {
            $(".loader_list").addClass("hidden");
          } else {
            $(".loader_list").removeClass("hidden");
          }
        },
      });
    }
  );

  $("#btn_retour_liste_commande").click(function (e) {
    $(".list_all_commande").removeClass("hidden");
    $(".details_commande").addClass("hidden");
    $("#fermer").removeClass("hidden");
    $("#btn_retour_liste_commande").addClass("hidden");
  });

  $("#btn_retour_liste_commande_annul").click(function (e) {
    $(".list_all_commande_annul").removeClass("hidden");
    $(".details_commande_annul").addClass("hidden");
    $("#fermer").removeClass("hidden");
    $("#btn_retour_liste_commande_annul").addClass("hidden");
  });

  $("#fermer").click(function (e) {
    $("#c1").show();
    $("#c2").hide();
    $("#c4").hide();
  });
  $("#finance").click(function (e) {
    $("#myModal").modal("hide");
    $("#c1").hide();
    $("#c2").hide();
    $("#c3").hide();
    $("#c4").show();
    //        alert('ok');
  });
  $("#fermer_finance").click(function (e) {
    $("#c1").show();
    $("#c2").hide();
    $("#c4").hide();
  });

  $(".panel_client_table").on("click", ".client_table", function () {
    //c'est l'id du client ou table selectionné
    var table_id = $(this).attr("id1");
    var type_client = $(this).attr("tp-cl");
    var clresto = $(this).attr("clresto");
    var etat_table = $(this).attr("etat_table");
    var statut_tbl = $("#statut_tbl").val();

    if (etat_table == "occupe") {
      var id1 = $(this).attr("id1");
      var nbrcouvert = $(this).attr("nbrcouvert");
      var id_sousresto = $(this).attr("id_sousresto");
      var user_attente = $(this).attr("user_attente");
      $("#id_sousresto").val(id_sousresto);
      $("#nbrcouvert").val(nbrcouvert);
      $("#user_attente").val(user_attente);
      $("#text_couvert")
        .empty()
        .append("Nombre de couverts : " + nbrcouvert)
        .show();
      var id2 = $(this).attr("id2");
      statut_tbl = "occupe";
      $("#statut_tbl").val(statut_tbl);
      $.ajax({
        url: "Traitement/ticket_datas2.php?table_id=" + table_id,
        async: true,
        type: "POST",
        global: false,
        cache: false,
        success: function (html) {
          $("#cl_chxi").empty().append(id2);
          $("#affiche_commandes").empty().append(html);
          $("#c1").show();
          $("#c3").hide();
          $("#id_cmd").val($("#id4x").val());
          $("#client_id1").val(table_id);
          $("#idfactcl").val($("#id4x").val());
          $("#attente").val("attente");
          $("#type_client").val($("#id5x").val());
          $("#dte_edite").val($("#id6x").val());
          $("#id_client").val(id1);
        },
      });
    } else {
      $("#nbrcouvert").val(0);
      $("#text_couvert").empty().append("Nombre de couverts : 0").show();
      var id1 = $(this).attr("id1");
      var type_client = $(this).attr("tp-cl");
      var clresto = $(this).attr("clresto");
      $(".tycl").val(type_client);
      $("#type_client").val(type_client);
      $("#clresto").val(clresto);
      $("#client_id").val(id1);
      $("#client_id1").val(id1);
      //c'est le nom du client ou table selectionné
      var id2 = $(this).attr("id2");
      $("#cl_chxi").empty().append(id2);
      $("#nom_client").val(id2);
      //c'est id de la table t_reserve_chambre
      id4 = $(this).attr("id4");
      id5 = $(this).attr("id5");
      //id reservation
      $("#res_ch_id3").val(id4);
      $("#reservechambre_id").val(id4);
      $("#id_res").val(0);
      $("#idrescl").val(0);
      $("#id_client").val(id1);
      $("#c1").show();
      $("#c2").hide();
      $("#msd_attente").hide();
      $("#nbrcouvertpopup").val(0);
      $("#myModalCouvert").modal("show");
      if (statut_tbl == "occupe") {
        statut_tbl = "libre";
        $("#statut_tbl").val(statut_tbl);
        $.ajax({
          url: "Traitement/tableau_affichage_commandes.php?action=initialiser",
          async: true,
          type: "POST",
          global: false,
          cache: false,
          success: function (html) {
            $("#id_cmd").val(0);
            //important pour orienter le reglement
            $("#attente").val("");
            $("#affiche_commandes").html(html);
          },
        });
      }
    }
  });

  $("#affichage_tout_produit").on(
    "click",
    "#blc_produit_vente a",
    function (e) {
      e.preventDefault();
      var bool_addition = $("#bool_addition").val();
      if (bool_addition == 1) {
        $("#avertissement-modal").modal("show");
      } else {
        var bool = false;
        var donnees = "";
        var idprod = $(this).attr("id");
        var repas = $(this).attr("id2");
        var pa = $(this).attr("pa");
        $("#repas_resto").val(repas);
        var prixprod = $("#blc_produit_vente span[id=" + idprod + "]").html();
        var nameprod = $("#blc_produit_vente p[id=" + idprod + "]").html();
        var prod_pan_added = $("#prod_pan_added").val();
        //$("#text_couvert").show();

        $.ajax({
          url:
            "Traitement/tableau_affichage_commandes.php?idprod=" +
            idprod +
            "&prixprod=" +
            prixprod +
            "&nameprod=" +
            nameprod +
            "&repas=" +
            repas +
            "&pa=" +
            pa,
          type: "POST",
          data: donnees,
          beforeSend: function () {
            $(".loader_cmd_h").addClass("hidden");
            $(".loader_cmd").removeClass("hidden");
          },
          success: function (data) {
            $("#btn_paiement_rapide").attr("disabled", false);
            $("#affiche_commandes").html(data);
            var accpgmt = $("#accpgmt").val();
            var nom_plat = $("#nom_plat").val();
            var plat_cpt_id = $("#plat_cpt_id").val();
            $("#prod_pan_added").val(idprod);
            if (repas == 1) {
              $.ajax({
                url: "Traitement/listeaccompagns1.php?idprod=" + idprod,
                type: "POST",
                data: donnees,
                success: function (data) {
                  if (data.pop == 1) {
                    $.ajax({
                      url: "Traitement/listeaccompagns.php?idprod=" + idprod,
                      type: "POST",
                      data: donnees,
                      success: function (data) {
                        $(".titre_mod_details_plat").html(nameprod);
                        $("#lib_repas").val(nameprod);
                        $("#pa_repas").val(pa);
                        $("#pv_repas").val(prixprod);
                        $("#idrepas").val(idprod);
                        $("#plat_cpt_id2").val(plat_cpt_id);
                        $("#datasaccompagn").html(data);
                        $("#myModalCHXACC").modal("show");
                      },
                    });
                  }
                },
                dataType: "json",
              });
            }
            bool = true;
            $(".loader_cmd_h").removeClass("hidden");
          },
          complete: function () {
            if (bool) {
              $(".loader_cmd").addClass("hidden");
            } else {
              $(".loader_cmd_h").removeClass("hidden");
            }
          },
        });
      }

      return false;
    }
  );
  $("#btn_valider_reglement").click(function (e) {
    e.preventDefault();
    var user_type = $("#user_type").val();
    var mode = $("#mode").val();
    if (user_type == 3 && mode == 3) {
      $(".div_txt").hide();
      $(".div_frm").show();
      $("#myModal2").modal("hide");
      $("#validate-code-modal-credit").modal("show");
    } else {
      validatePaiement();
    }

    return false;
  });

  $("#btn_addition").click(function (e) {
    e.preventDefault();
    var donnees = "";
    var client = $("#client_id1").val();
    var nom_client = $("#cl_chxi").text();
    $.ajax({
      url: "Traitement/nbr_produits.php",
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $("#btn_addition").addClass("hidden");
        $("#btn_addition_loader").removeClass("hidden");
      },
      success: function (data) {
        if (data > 0 && client != "") {
          window.open(
            "impression/examples/recu_addition.php?nom_client=" + nom_client
          );
        } else {
          $("#affiche_commandes").prepend(
            '<div class="alert alert-danger text-center msg_add">Veuillez selectionner un client/table ou au moins un produit</div>'
          );
          $(".msg_add").fadeOut(5000);
        }
        bool = true;
      },
      complete: function () {
        if (bool) {
          $("#btn_addition_loader").addClass("hidden");
          $("#btn_addition").removeClass("hidden");
        }
      },
    });
    return false;
  });
  $(".affichage_famille").click(function (e) {
    var idprod, affichage;
    if ($(this).is(":checked")) {
      idprod = $(this).attr("id");
    }
  });
  $("#btn_qte_produit1").click(function () {
    var donnees = "";
    var qte_produit = $("#qte_produit").val();
    var id_produit = $("#id_produit2").val();
    var repas_resto = $("#repas_resto").val();
    var id_produit1 = $("#id_produit").val();
    $.ajax({
      url:
        "Traitement/tableau_affichage_commandes.php?id_produit=" +
        id_produit +
        "&qte_produit=" +
        qte_produit +
        "&repas_resto=" +
        repas_resto +
        "&id_produit1=" +
        id_produit1,
      type: "POST",
      data: donnees,
      success: function (data) {
        $("#id_produit").val(" ");
        $("#qte_produit").val(" ");
        $("#qte_produit").attr("disabled", true);
        $("#btn_qte_produit").attr("disabled", true);
        $("#btn_sup_produit").attr("disabled", true);
        $("#affiche_commandes").html(data);
        $("#alert_qte").show().fadeOut(6000);
        $("#div_qte_produit").hide();
        $("#div_remise").show();
      },
    });
    return false;
  });

  $("#btn_sup_produit").click(function (e) {
    e.preventDefault();
    var bool_addition = $("#bool_addition").val();
    var user_type = $("#user_type").val();
    var id_cmd = $("#id_cmd").val();
    if (bool_addition == 1) {
      $("#avertissement-modal").modal("show");
    } else {
      if (user_type == 1 || user_type == 5) {
        $(".div_txt").show();
        $(".div_frm").hide();
      } else if ((user_type != 1 || user_type != 5) && id_cmd > 0) {
        $(".div_txt").hide();
        $(".div_frm").show();
        $(".code").val("");
      } else {
        $(".div_txt").show();
        $(".div_frm").hide();
      }
      $("#suppression-modal").modal("show");
    }
    return false;
  });

  $("#btn_sup_produit_ok").click(function (e) {
    e.preventDefault();
    var donnees = $(".frmcode").serialize();
    var id_cmd = $("#id_cmd").val();
    var pn = $(".affichage_produit:checked").attr("pn");
    var pd = $(".affichage_produit:checked").attr("pd");
    var pq = $(".affichage_produit:checked").attr("pq");
    var pt = $(".affichage_produit:checked").attr("pt");
    var repas = $(".affichage_produit:checked").attr("repas");
    var idp = $(".affichage_produit:checked").attr("idp");
    var idfactcl = $("#idfactcl").val();

    $.ajax({
      url: "Traitement/verifcode.php?id_cmd=" + id_cmd+"&pn=" +
                    pn +
                    "&pd=" +
                    pd +
                    "&pq=" +
                    pq +
                    "&pt=" +
                    pt +
                    "&repas=" +
                    repas +
                    "&idp=" +
                    idp+"&idfactcl=" +
                    idfactcl,
      type: "POST",
      data: donnees,
      success: function (d) {
       // alert(d)
        if (d.message == "succes") {
          $(".code").val("");
          var id_client = $("#client_id1").val();
          var res_ch_id = $("#res_ch_id3").val();
          var idrescl = $("#idrescl").val();
          var montant_tot = $("#mont_tot_panier_devise").val();
          var nom_client = $("#cl_chxi").text();
          $("#nom_client").val(nom_client);
          var attente = "attente";
          var nbrcouvert = $("#nbrcouvert").val();
          var user_attente = $("#user_attente").val();
          var id_produit = $("#id_produit").val();
          var qte_produit = $("#qte_produit").val();
          var supprimer = "OK";
          
          //alert(id_produit);
          $.ajax({
            url:
              "Traitement/tableau_affichage_commandes.php?id_produit=" +
              id_produit +
              "&supprimer=" +
              supprimer,
            type: "POST",
            data: donnees,
            success: function (data) {
              //  alert(data);
              $("#id_produit").val(" ");
              $("#qte_produit").val(" ");
              //                    $("#qte_produit").attr('disabled', true);
              $("#btn_qte_produit").attr("disabled", true);
              $("#btn_sup_produit").attr("disabled", true);
              //                    $("#div_qte_produit").hide();
              //                    $("#div_remise").show();
              $("#affiche_commandes").html(data);
              $("#suppression-modal").modal("hide");
              if (id_cmd > 0) {
                window.open(
                  "impression/examples/bon_suppression.php?pn=" +
                    pn +
                    "&pd=" +
                    pd +
                    "&pq=" +
                    pq +
                    "&pt=" +
                    pt +
                    "&repas=" +
                    repas +
                    "&idp=" +
                    idp +
                    "&idfactcl=" +
                    idfactcl+"&agent=" +
                    d.agent
                );
                //Maj auto bon_commande
                url =
                  "Traitement/maj_auto_bc.php?id_client=" +
                  id_client +
                  "&id_cmd=" +
                  id_cmd +
                  "&res_ch_id=" +
                  res_ch_id +
                  "&montant_tot=" +
                  montant_tot +
                  "&idfactcl=" +
                  idfactcl +
                  "&attente=" +
                  attente +
                  "&idrescl=" +
                  idrescl +
                  "&nom_client=" +
                  nom_client +
                  "&nbrcouvert=" +
                  nbrcouvert +
                  "&user_attente=" +
                  user_attente;
                $.ajax({
                  url: url,
                  type: "POST",
                  success: function (data) {},
                });
                //Maj auto bon_commande
              }
            },
          });
        } else if (d.message == "vide") {
          $(".code").val("");
          $(".msgcode").show().fadeOut(4000);
        }
      },  dataType: "json",
    });

    return false;
  });

  $("#btn_remise").click(function () {
    var donnees = "";
    var remise_val = $("#kremise").val();
    var remise = "OK";
    $.ajax({
      url:
        "Traitement/tableau_affichage_commandes.php?remise_val=" +
        remise_val +
        "&remise=" +
        remise,
      type: "POST",
      data: donnees,
      success: function (data) {
        $("#id_produit").val(" ");
        $("#qte_produit").val(" ");
        $("#remise").val(" ");
        $("#qte_produit").attr("disabled", true);
        $("#btn_qte_produit").attr("disabled", true);
        $("#qte_produit").attr("disabled", true);
        $("#btn_qte_produit").attr("disabled", true);
        $("#btn_sup_produit").attr("disabled", true);
        $("#affiche_commandes").html(data);
        $("#myModal2").modal("hide");
      },
    });
    return false;
  });
  $("#btn_boncommande").click(function (e) {
    e.preventDefault();
    var bool = false;
    var id_client = $("#client_id1").val();
    var idfactcl = $("#idfactcl").val();
    var id_cmd = $("#id_cmd").val();
    var res_ch_id = $("#res_ch_id3").val();
    var idrescl = $("#idrescl").val();
    var montant_tot = $("#mont_tot_panier_devise").val();
    var nom_client = $("#cl_chxi").text();
    $("#nom_client").val(nom_client);
    var attente = "attente";
    var nbrcouvert = $("#nbrcouvert").val();
    var user_attente = $("#user_attente").val();
    var note_cmd = $("#note_cmd").val();
    var id_serveur = $("#id_serveur").val();
    var name_serveur = $("#name_serveur").val();
    var donnees = " ";
    if (id_serveur == 0) {
      alert("Veuillez choisir un serveur!");
    } else {
      $.ajax({
        url:
          "Traitement/attente2.php?id_client=" +
          id_client +
          "&id_cmd=" +
          id_cmd +
          "&res_ch_id=" +
          res_ch_id +
          "&montant_tot=" +
          montant_tot +
          "&idfactcl=" +
          idfactcl +
          "&attente=" +
          attente +
          "&idrescl=" +
          idrescl +
          "&nom_client=" +
          nom_client +
          "&nbrcouvert=" +
          nbrcouvert +
          "&user_attente=" +
          user_attente +
          "&note_cmd=" +
          note_cmd +
          "&id_serveur=" +
          id_serveur +
          "&name_serveur=" +
          name_serveur,
        type: "POST",
        data: donnees,
        beforeSend: function () {
          $("#btn_boncommande").addClass("hidden");
          $("#btn_boncommande_loader").removeClass("hidden");
        },
        success: function (data) {
          if (data.succes) {
            $("#cl_chxi").empty().append("");
            $("#client_id1").val("");
            $("#id_cmd").val(0);
            //important pour orienter le reglement
            $("#attente").val("");
            //$('#listetable_client').load('Traitement/miseenattente.php');
            //$('#affichage_tout_produit').empty().load('Traitement/affichage_tout_produit.php');
            $("#affiche_commandes").html(data);
            // $('.listetable_client').empty().load('Traitement/tableajax.php');
            //$('#tab_2').empty().load('liste_cl_maj.php');
            //$(".msg_alert1").fadeOut(5000);

            $("#affichage_tout_produit").show();
            $("#blc_produit_vente").addClass("hidden");
            $("#blc_categorie_produit_vente").removeClass("hidden");
            $(".panel_client_table").hide();
            $("#nbrcouvert").val(1);
            $("#text_couvert").hide();
            $("#text_serveur").empty().append("");
            $("#id_serveur").val(0);
            if (data.bar) {
              window.open(
                "impression/examples/bcbar.php?nom_client=" +
                  nom_client +
                  "&boncommande_id=" +
                  data.idcommande +
                  "&id_cmd=" +
                  id_cmd
              );
            }
            if (data.bc) {
              window.open(
                "impression/examples/recu_bon_commande.php?nom_client=" +
                  nom_client +
                  "&boncommande_id=" +
                  data.idcommande +
                  "&id_cmd=" +
                  id_cmd
              );
            }
          }

          bool = true;
        },
        complete: function () {
          if (bool) {
            $("#btn_boncommande_loader").addClass("hidden");
            $("#btn_boncommande").removeClass("hidden");
          }
        },
        dataType: "json",
      });
    }
  });
  // King

  $("#btn_attente").click(function () {
    var bool = false;
    var id_client = $("#client_id1").val();
    var idfactcl = $("#idfactcl").val();
    var id_cmd = $("#id_cmd").val();
    var res_ch_id = $("#res_ch_id3").val();
    var idrescl = $("#idrescl").val();
    var montant_tot = $("#mont_tot_panier_devise").val();
    var nom_client = $("#cl_chxi").text();
    $("#nom_client").val(nom_client);
    var attente = "attente";
    var donnees = " ";
    $.ajax({
      url:
        "Traitement/tableau_affichage_commandes.php?id_client=" +
        id_client +
        "&id_cmd=" +
        id_cmd +
        "&res_ch_id=" +
        res_ch_id +
        "&montant_tot=" +
        montant_tot +
        "&idfactcl=" +
        idfactcl +
        "&attente=" +
        attente +
        "&idrescl=" +
        idrescl +
        "&nom_client=" +
        nom_client,
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $("#btn_attente").addClass("hidden");
        $("#btn_attente_loader").removeClass("hidden");
      },
      success: function (data) {
        $("#cl_chxi").empty().append("");
        $("#client_id1").val("");
        $("#id_cmd").val(0);
        //important pour orienter le reglement
        $("#attente").val("");
        //                $('#listetable_client').load('Traitement/miseenattente.php');
        //$('#affichage_tout_produit').empty().load('Traitement/affichage_tout_produit.php');
        $("#affiche_commandes").html(data);
        $("#tab_1").empty().load("liste_tbl_maj.php");
        //                 $('#tab_2').empty().load('liste_cl_maj.php');
        $(".msg_alert1").fadeOut(5000);
        bool = true;
      },
      complete: function () {
        if (bool) {
          $("#btn_attente_loader").addClass("hidden");
          $("#btn_attente").removeClass("hidden");
        }
      },
    });
  });

  // clique sur ticket
  $(".ticket").click(function (e) {
    $.ajax({
      url: "Traitement/ticket_datas.php",
      async: true,
      type: "POST",
      global: false,
      cache: false,
      success: function (html) {
        $("#c3").empty().append(html);
        $("#monitoring_bloc").hide();
      },
    });
    $("#c1").hide();
    $("#c2").hide();
    $("#c3").show();
  });

  $("#famille a").on("click", "a", function () {
    var donnees = " ";
    var idfamille = $(this).attr("id");
    var famille = $("#famille span[id=" + idfamille + "]").html();
    $("#titre_famille").html(famille);
    $.ajax({
      url: "./Traitement/sous_famille_ajax.php?famille_id=" + idfamille,
      type: "POST",
      data: donnees,
      success: function (data) {
        $("#famille").html(data);
      },
    });

    return false;
  });
  $("#sous_famille1 a").click(function () {
    var donnees = " ";
    var idfamille = $(this).attr("id");
    var famille = $("#famille span[id=" + idfamille + "]").html();
    $("#titre_famille").html(famille);
    $("#famille").hide();
    $.ajax({
      url: "Traitement/sous_famille_ajax.php?famille_id=" + idfamille,
      type: "POST",
      data: donnees,
      success: function (data) {
        $("#sous_famille").html(data);
      },
    });
    return false;
  });
  $("#home").click(function () {
    //        $('#sous_famille').empty().hide();
    //        $('#titre_famille').html(' ');
    //        $('#famille').show();
  });

  $("#btn_regler").click(function (e) {
    e.preventDefault();
    $("#div_bkg").addClass("hidden");
    $("#commandeID").val($("#id_cmd").val());
    $("#client_id2").val($("#client_id1").val());
    $("#id_cmd2").val($("#id_cmd").val());
    $("#attente2").val($("#attente").val());
    $(".montant_fact").text($("#mont_tot_panier_af").val());
    $("#montant_fact").val($("#mont_tot_panier").val());
    $("#mont_equivalent").text($("#mont_tot_panier_devise_af").val());
    $("#montant_tot").val($("#mont_tot_panier").val());
    $("#montant_tot_af").val($("#mont_tot_panier_devise_af").val());
    $("#fusion_frm").val($("#fusion_ticket").val());
    $("#id_fact_fus").val($("#id_fact_fus_frm").val());
    $("#id_tbl_fus2").val($("#id_tbl_fus").val());
    var type_client = $(".idclrp").val();
    $('option[value="3"]').hide();
    if (type_client == "client") {
      $('option[value="3"]').show();
    }
    $(".blocqte").addClass("hidden");
    $(".blocoffre").addClass("hidden");
    $(".blocprix").addClass("hidden");
    $(".blocdepense").addClass("hidden");
    $(".blocpaie").removeClass("hidden");
    $("#myModal2").modal("show");
    return false;
  });

  //initialisation donnees suivie activites
  $(".suivi_activite_cmd").click(function () {
    $(".cash_usd")
      .empty()
      .append($("#tot_usd_cash").val() + "  USD");
    $(".cash_cdf")
      .empty()
      .append($("#tot_cdf_cash").val() + "  CDF");
    $(".credit")
      .empty()
      .append($("#tot_credit").val() + " " + $("#monaie_aff").val());
    $(".credit_eq")
      .empty()
      .append($("#tot_credit_eq").val() + " " + $("#monaie_aff_eq").val());
  });
  //
  //Mise à jour du Taux
  $("#maj_btn").click(function (e) {
    e.preventDefault();
    var bool = false;
    var taux_op = $("#taux_op").val();
    var donnees = " ";
    //        $("#loader_taux").removeClass('hidden');
    //        alert(taux_op);
    $.ajax({
      url: "Traitement/miseajour_taux.php?taux_op=" + taux_op,
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $("#loader_taux").removeClass("hidden");
        $("#maj_btn").addClass("hidden");
      },
      success: function (data) {
        $("#taux_jr").text(data);
        bool = true;
      },
      complete: function () {
        if (bool) {
          $("#loader_taux").addClass("hidden");
          $("#maj_btn").removeClass("hidden");
        } else {
          $("#loader_taux").removeClass("hidden");
        }
      },
    });
  });

  //Création sous-resto
  $("#save_sresto").click(function (e) {
    e.preventDefault();
    var sous_resto = $("#sous_resto").val();
    var affect = 1;
    var donnees = " ";
    $.ajax({
      url:
        "Traitement/insertion_sous_resto.php?sous_resto=" +
        sous_resto +
        "&affect=" +
        affect,
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $("#loader_sresto").removeClass("hidden");
        $("#save_sresto").addClass("hidden");
      },
      success: function (data) {
        $("#sous_resto").val("");
        $("#data_id").empty().append(data);
        bool = true;
      },
      complete: function () {
        if (bool) {
          $("#loader_sresto").addClass("hidden");
          $("#save_sresto").removeClass("hidden");
        } else {
          $("#loader_sresto").removeClass("hidden");
        }
      },
    });
  });

  //Atualiser liste sous-resto
  $("#btn_actu").click(function (e) {
    e.preventDefault();
    var sous_resto = "vide";
    var affect = 0;
    var donnees = " ";
    $.ajax({
      url:
        "Traitement/insertion_sous_resto.php?sous_resto=" +
        sous_resto +
        "&affect=" +
        affect,
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $("#loader_actu").removeClass("hidden");
        $("#btn_actu").addClass("hidden");
      },
      success: function (data) {
        $("#list_affect").empty().append(data);
        bool = true;
      },
      complete: function () {
        if (bool) {
          $("#loader_actu").addClass("hidden");
          $("#btn_actu").removeClass("hidden");
        } else {
          $("#loader_actu").removeClass("hidden");
        }
      },
    });
  });

  $("#btn_affect1").click(function (e) {
    e.preventDefault();
    var donnees = " ";
    $.ajax({
      url: "./Traitement/liste_affect_sous_resto.php",
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $("#loader_listeaff").removeClass("hidden");
        $("#btn_affect1").addClass("hidden");
      },
      success: function (data) {
        $("#modal_affect").empty().append(data);
        $("#myModal_affect").modal("show");
        bool = true;
      },
      complete: function () {
        if (bool) {
          $("#loader_listeaff").addClass("hidden");
          $("#btn_affect1").removeClass("hidden");
        } else {
          $("#loader_listeaff").removeClass("hidden");
        }
      },
    });
  });

  //Save affectation sous-resto
  $("#btn_affect").click(function (e) {
    e.preventDefault();
    var user_id = $("#user_id").val();
    var sous_resto = $('input[name="optionsRadios"]:checked').val();
    var donnees = " ";
    $.ajax({
      url:
        "Traitement/insertion_affect_sresto.php?sous_resto=" +
        sous_resto +
        "&user_id=" +
        user_id,
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $("#loader_aff").removeClass("hidden");
        $("#btn_affect").addClass("hidden");
      },
      success: function (data) {
        if (data.message_succes == "succes") {
          $("#user_id").removeAttr("selected");
          $('input[name="optionsRadios"]').removeAttr("checked");
          $("#msg").show().fadeOut(4000);
          bool = true;
        }
      },
      complete: function () {
        if (bool) {
          $("#loader_aff").addClass("hidden");
          $("#btn_affect").removeClass("hidden");
        } else {
          $("#loader_aff").removeClass("hidden");
        }
      },
      dataType: "json",
    });
  });

  //GESTION RENDU
  $(".mp").keyup(function (e) {
    e.preventDefault();
    var bool = false;
    var donnees = $(".f_modal_paiement").serialize();
    var urlpg = "./Traitement/reglement2.php?do=rendu";

    $.ajax({
      url: urlpg,
      type: "POST",
      data: donnees,
      beforeSend: function () {},
      success: function (data) {
        if (data.succes) {
          $("#rendu_usd").val(data.rendu_usd);
          $("#rendu_cdf").val(data.rendu_cdf);
          $("#totrendu").val(data.totrendu);
          if (data.boolrendu) {
            $(".blrendu").removeClass("hidden");
          } else {
            $(".blrendu").addClass("hidden");
          }
        }
        bool = true;
      },
      complete: function () {
        //                if (bool) {
        //                    $(".loader").addClass('hidden');
        //                    $(".btn_modal").removeClass('hidden');
        //                } else {
        //                   $(".loader").removeClass('hidden');
        //                }
      },
      error: function (error) {
        console(error);
      },
      dataType: "json",
    });
    return false;
  });

  //KING
  $("#tab_2").on("click", "#btn_add_client", function (e) {
    e.preventDefault();
    $("#myModalAddClient").modal("show");
    return false;
  });

  function effacer() {
    $(":input", ".form")
      .not(
        ":button,:submit,:reset,:hidden,\n\
                                 #optionsRadiosInline,#monnaie,#datebonentre,#optbanque"
      )
      .val("")
      .removeAttr("checked")
      .removeAttr("selected");
  }
  $("#btn_add_client_conf").click(function (e) {
    e.preventDefault();
    var donnees = $("#formaddclient").serialize();
    $.ajax({
      url: "./Traitement/addclient.php",
      type: "POST",
      data: donnees,
      success: function (data) {
        if (data.message == "succes") {
          effacer();
          $.ajax({
            url: "liste_cl_maj.php",
            type: "POST",
            success: function (data2) {
              $("#tab_2").empty().append(data2);
              $("#myModalAddClient").modal("hide");
            },
          });
        } else if (data.message == "vide") {
          $("#msgclpopup")
            .show()
            .fadeOut(4000)
            .addClass("alert-danger")
            .removeClass("alert-success");
          $("#msgcl_alertpopup").text("Veuilez remplir les champs vides!");
        }
      },
      dataType: "json",
    });
    return false;
  });
  $("#save_fdc").click(function (e) {
    e.preventDefault();
    var donnees = $("#formfdc").serialize();
    var bool = false;
    $.ajax({
      url: "Traitement/insertion_fond_caisse.php",
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $("#loader_fdc").removeClass("hidden");
        $("#save_fdc").addClass("hidden");
      },
      success: function (data) {
        bool = true;
        if (data.message == "succes") {
          $("#grpmontantusd")
            .empty()
            .append(
              '<input type="text" name="montantusd" id="montantusd" class="form-control" value="" placeholder="Montant en USD">'
            );
          $("#grpmontantcdf")
            .empty()
            .append(
              '<input type="text" name="montantcdf" id="montantcdf" class="form-control" value="" placeholder="Montant en CDF">'
            );
          $("#msgcl")
            .show()
            .fadeOut(4000)
            .addClass("alert-success")
            .removeClass("alert-danger");
          $("#msgcl_alert").text("Succès!");
        } else if (data.message == "vide") {
          $("#msgcl")
            .show()
            .fadeOut(4000)
            .addClass("alert-danger")
            .removeClass("alert-success");
          $("#msgcl_alert").text("Valeurs incorrectes!");
        }
      },
      complete: function () {
        if (bool) {
          $("#loader_fdc").addClass("hidden");
          $("#save_fdc").removeClass("hidden");
        } else {
          $("#loader_fdc").removeClass("hidden");
        }
      },
      dataType: "json",
    });
  });
  $("#save_ml").click(function (e) {
    e.preventDefault();
    var donnees = $("#formml").serialize();
    var bool = false;
    $.ajax({
      url: "Traitement/insertion_mention_legale.php",
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $("#loader_ml").removeClass("hidden");
        $("#save_ml").addClass("hidden");
      },
      success: function (data) {
        bool = true;
        if (data.s) {
          $("#nom_ssite").text(data.nom_ssite);
          $("#msgml")
            .show()
            .fadeOut(4000)
            .addClass("alert-success")
            .removeClass("alert-danger");
          $("#msgml_alert").text("Succès!");
        } else {
          $("#msgml")
            .show()
            .fadeOut(4000)
            .addClass("alert-danger")
            .removeClass("alert-success");
          $("#msgml_alert").text(data.message);
        }
      },
      complete: function () {
        if (bool) {
          $("#loader_ml").addClass("hidden");
          $("#save_ml").removeClass("hidden");
        } else {
          $("#loader_ml").removeClass("hidden");
        }
      },
      dataType: "json",
    });
  });

  $("#tab_2").on("keyup", "#custom_search", function (e) {
    e.preventDefault();
    var motif = $(this).val();
    $.ajax({
      url: "Traitement/custom_search_datas.php?motif=" + motif,
      type: "POST",
      success: function (data) {
        $("#produit2").empty().append(data);
      },
    });
    return false;
  });

  $("#affichage_tout_produit").on("keyup", "#product_search", function (e) {
    e.preventDefault();
    var motif = $(this).val();
    var sorte_search = $("#sorte_search").val();
    var blc_af_cat = "#blc_produit_vente";
    var url = "Traitement/product_search_datas.php?motif=" + motif;
    if (sorte_search == "categorie") {
      var url = "Traitement/categorie_produit_vente2.php?motif=" + motif;
      var blc_af_cat = "#blc_categorie_produit_vente";
    }
    $.ajax({
      url: url,
      type: "POST",
      success: function (data) {
        $(blc_af_cat).empty().append(data);
      },
    });
    return false;
  });

  $("#blc_main").on("click", ".facture", function (e) {
    e.preventDefault();
    var mode = $(this).attr("mode");
    $("#mode").val(mode);
  });

  $("#blc_main").on("click", "#print_fact", function (e) {
    e.preventDefault();
    var mode = $("#mode").val();
    window.open("./impression/examples/factures.php?mode=" + mode);
  });

  $("#btn_offert").click(function () {
    var donnees = "";
    var user_type = $("#user_type").val();
    if (user_type == 1 || user_type == 5) {
      var qte_produit = $("#qte_produit").val();
      var id_produit2 = $("#id_produit2").val();
      var id_produit = $("#id_produit").val();
      $(".blocdepense").addClass("hidden");
      $(".blocpaie").addClass("hidden");
      $(".blocqte").addClass("hidden");
      $(".blocprix").addClass("hidden");
      $(".blocoffre").removeClass("hidden");
      $("#myModal2").modal("show");
    } else {
      $(".code").val("");
      $("#offre-confirm-modal").modal("show");
    }

    return false;
  });

  $("#btn_offre_confirm").click(function (e) {
    e.preventDefault();
    var donnees = $(".frmcodeoffre").serialize();
    var id_cmd = $("#id_cmd").val();
    $.ajax({
      url: "Traitement/verifcode.php?id_cmd=" + id_cmd,
      type: "POST",
      data: donnees,
      success: function (d) {
        if (d.message == "succes") {
          var qte_produit = $("#qte_produit").val();
          var id_produit2 = $("#id_produit2").val();
          var id_produit = $("#id_produit").val();
          $(".blocdepense").addClass("hidden");
          $(".blocpaie").addClass("hidden");
          $(".blocqte").addClass("hidden");
          $(".blocprix").addClass("hidden");
          $(".blocoffre").removeClass("hidden");
          $("#myModal2").modal("show");
          $("#offre-confirm-modal").modal("hide");
        } else if (d.message == "vide") {
          $(".code").val("");
          $(".msgcode").show().fadeOut(4000);
        }
      },
      dataType: "json",
    });

    return false;
  });

  $("#btn_offert2").click(function () {
    var donnees = "";
    var qte_produit = $("#qte_produit").val();
    var id_produit2 = $("#id_produit2").val();
    var id_produit = $("#id_produit").val();
    var qteofferte = $("#qteofferte").val();
    $.ajax({
      url:
        "Traitement/tableau_affichage_commandes.php?id_produit=" +
        id_produit +
        "&offert=1&id_produit2=" +
        id_produit2 +
        "&qteofferte=" +
        qteofferte +
        "&qte_produit=" +
        qte_produit,
      type: "POST",
      data: donnees,
      success: function (data) {
        $("#id_produit").val(" ");
        $("#id_produit2").val(" ");
        $("#qte_produit").val(" ");
        $("#qteofferte").val(" ");
        $("#qte_produit").attr("disabled", true);
        $("#btn_qte_produit").attr("disabled", true);
        $("#btn_sup_produit").attr("disabled", true);
        $("#affiche_commandes").html(data);
        $("#alert_qte").show().fadeOut(6000);
        $("#div_qte_produit").hide();
        $("#div_remise").show();
        //                $("#mdoffre").modal('hide');
        $("#myModal2").modal("hide");
      },
    });
    return false;
  });
  $("#btn_update_price").click(function () {
    var donnees = "";
    var qte_produit = $("#qte_produit").val();
    var id_produit2 = $("#id_produit2").val();
    var id_produit = $("#id_produit").val();
    //        $("#mdupdateprice").modal('show');
    $(".blocdepense").addClass("hidden");
    $(".blocpaie").addClass("hidden");
    $(".blocoffre").addClass("hidden");
    $(".blocqte").addClass("hidden");
    $(".blocprix").removeClass("hidden");
    $("#myModal2").modal("show");
    return false;
  });
  $("#btn_update_price2").click(function () {
    var donnees = "";
    var qte_produit = $("#qte_produit").val();
    var id_produit2 = $("#id_produit2").val();
    var id_produit = $("#id_produit").val();
    var prix = $("#prix").val();
    $.ajax({
      url:
        "Traitement/tableau_affichage_commandes.php?id_produit=" +
        id_produit +
        "&price=1&id_produit2=" +
        id_produit2 +
        "&prix=" +
        prix,
      type: "POST",
      data: donnees,
      success: function (data) {
        $("#id_produit").val(" ");
        $("#id_produit2").val(" ");
        $("#qte_produit").val(" ");
        $("#qteofferte").val(" ");
        $("#qte_produit").attr("disabled", true);
        $("#btn_qte_produit").attr("disabled", true);
        $("#btn_sup_produit").attr("disabled", true);
        $("#affiche_commandes").html(data);
        $("#alert_qte").show().fadeOut(6000);
        $("#div_qte_produit").hide();
        $("#div_remise").show();
        //                $("#mdupdateprice").modal('hide');
        $("#myModal2").modal("hide");
      },
    });
    return false;
  });
  $("#btn_qte_produit").click(function (e) {
    e.preventDefault();
    var bool_addition = $("#bool_addition").val();
    if (bool_addition == 1) {
      $("#avertissement-modal").modal("show");
    } else {
      $(".blocdepense").addClass("hidden");
      $(".blocpaie").addClass("hidden");
      $(".blocoffre").addClass("hidden");
      $(".blocprix").addClass("hidden");
      $(".blocqte").removeClass("hidden");
      $("#myModal2").modal("show");
    }
    return false;
  });
  $("#btn_qte_produit2").click(function () {
    var donnees = "";
    var qte_produit = $("#qte_produit").val();
    var id_produit = $("#id_produit2").val();
    var repas_resto = $("#repas_resto").val();
    var id_produit1 = $("#id_produit").val();
    //  alert(qte_produit);
    $.ajax({
      url:
        "Traitement/tableau_affichage_commandes.php?id_produit=" +
        id_produit +
        "&qte_produit=" +
        qte_produit +
        "&repas_resto=" +
        repas_resto +
        "&id_produit1=" +
        id_produit1,
      type: "POST",
      data: donnees,
      success: function (data) {
        //   alert(data);
        $("#id_produit").val(" ");
        $("#qte_produit").val(" ");
        $("#qte_produit").attr("disabled", true);
        $("#btn_qte_produit").attr("disabled", true);
        $("#btn_sup_produit").attr("disabled", true);
        $("#affiche_commandes").html(data);
        $("#alert_qte").show().fadeOut(6000);
        $("#div_qte_produit").hide();
        // $("#div_remise").show();
        $("#myModal2").modal("hide");
      },
    });
    return false;
  });
  $("#affichage_tout_produit").on(
    "keyup",
    "#product_search_code",
    function (e) {
      e.preventDefault();
      var motif = $(this).val();

      $.ajax({
        url: "Traitement/product_search_datas_code.php?motif=" + motif,
        type: "POST",
        success: function (data) {
          var donnees = "";
          var idprod = data.idprod;
          var repas = data.repas;
          var prixprod = data.prix;
          var nameprod = data.designation;
          var pa = data.pa;
          $.ajax({
            url:
              "Traitement/tableau_affichage_commandes.php?idprod=" +
              idprod +
              "&prixprod=" +
              prixprod +
              "&nameprod=" +
              nameprod +
              "&repas=" +
              repas +
              "&pa=" +
              pa,
            type: "POST",
            data: donnees,
            success: function (data) {
              $("#affiche_commandes").html(data);
              $("#product_search_code").val(" ");
            },
          });
        },
        dataType: "json",
      });
      return false;
    }
  );
  $("#btn_addition2").click(function (e) {
    e.preventDefault();
    var bool = false;
    var id_client = $("#client_id1").val();
    var idfactcl = $("#idfactcl").val();
    var id_cmd = $("#id_cmd").val();
    var res_ch_id = $("#res_ch_id3").val();
    var idrescl = $("#idrescl").val();
    var montant_tot = $("#mont_tot_panier_devise").val();
    var nom_client = $("#cl_chxi").text();
    $("#nom_client").val(nom_client);
    var attente = "attente";
    var nbrcouvert = $("#nbrcouvert").val();
    var donnees = " ";
    $.ajax({
      url:
        "Traitement/attente3.php?id_client=" +
        id_client +
        "&id_cmd=" +
        id_cmd +
        "&res_ch_id=" +
        res_ch_id +
        "&montant_tot=" +
        montant_tot +
        "&idfactcl=" +
        idfactcl +
        "&attente=" +
        attente +
        "&idrescl=" +
        idrescl +
        "&nom_client=" +
        nom_client +
        "&nbrcouvert=" +
        nbrcouvert,
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $("#btn_attente").addClass("hidden");
        $("#btn_attente_loader").removeClass("hidden");
      },
      success: function (data) {
        if (data.succes) {
          $("#cl_chxi").empty().append("");
          $("#client_id1").val("");
          $("#id_cmd").val(0);
          //important pour orienter le reglement
          $("#attente").val("");
          //                $('#listetable_client').load('Traitement/miseenattente.php');
          //$('#affichage_tout_produit').empty().load('Traitement/affichage_tout_produit.php');
          $("#affiche_commandes").html(data);
          // $('.listetable_client').empty().load('Traitement/tableajax.php');
          //$('#tab_2').empty().load('liste_cl_maj.php');
          //                $(".msg_alert1").fadeOut(5000);

          $("#affichage_tout_produit").show();
          $("#blc_produit_vente").addClass("hidden");
          $("#blc_categorie_produit_vente").removeClass("hidden");
          $(".panel_client_table").hide();
          $("#nbrcouvert").val(0);
          $("#text_couvert").hide();
          window.open(
            "impression/examples/recu_addition.php?nom_client=" +
              nom_client +
              "&boncommande_id=" +
              data.idcommande
          );
        }

        bool = true;
      },
      complete: function () {
        if (bool) {
          $("#btn_attente_loader").addClass("hidden");
          $("#btn_attente").removeClass("hidden");
        }
      },
      dataType: "json",
    });
  });
  $("#btn_addition3").click(function (e) {
    e.preventDefault();
    var bool = false;
    var id_client = $("#client_id1").val();
    var idfactcl = $("#idfactcl").val();
    var id_cmd = $("#id_cmd").val();
    var res_ch_id = $("#res_ch_id3").val();
    var idrescl = $("#idrescl").val();
    var montant_tot = $("#mont_tot_panier_devise").val();
    var nom_client = $("#cl_chxi").text();
    $("#nom_client").val(nom_client);
    var attente = "attente";
    var nbrcouvert = $("#nbrcouvert").val();
    var user_attente = $("#user_attente").val();
    var donnees = " ";
    $.ajax({
      url:
        "Traitement/attente3.php?id_client=" +
        id_client +
        "&id_cmd=" +
        id_cmd +
        "&res_ch_id=" +
        res_ch_id +
        "&montant_tot=" +
        montant_tot +
        "&idfactcl=" +
        idfactcl +
        "&attente=" +
        attente +
        "&idrescl=" +
        idrescl +
        "&nom_client=" +
        nom_client +
        "&nbrcouvert=" +
        nbrcouvert +
        "&user_attente=" +
        user_attente,
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $("#btn_attente").addClass("hidden");
        $("#btn_attente_loader").removeClass("hidden");
      },
      success: function (data) {
        if (data.succes) {
          $("#cl_chxi").empty().append("");
          $("#client_id1").val("");
          $("#id_cmd").val(0);
          //important pour orienter le reglement
          $("#attente").val("");
          $("#affiche_commandes").html("");
          $(".listetable_client")
            .empty()
            .load("Traitement/tableajaxcaisse.php");
          $("#nbrcouvert").val(0);
          $("#text_couvert").hide();
          window.open(
            "impression/examples/recu_addition.php?nom_client=" +
              nom_client +
              "&boncommande_id=" +
              data.idcommande
          );
        }
        bool = true;
      },
      complete: function () {
        if (bool) {
          $("#btn_attente_loader").addClass("hidden");
          $("#btn_attente").removeClass("hidden");
        }
      },
      dataType: "json",
    });
  });
  //DEPENSE
  $("#btn_depense").click(function (e) {
    e.preventDefault();
    $("#div_bkg").addClass("hidden");
    $(".blocqte").addClass("hidden");
    $(".blocoffre").addClass("hidden");
    $(".blocprix").addClass("hidden");
    $(".blocpaie").addClass("hidden");
    $(".blocdepense").removeClass("hidden");
    $("#myModal2").modal("show");
    return false;
  });
  $("#add_libelledep_btn").click(function (e) {
    e.preventDefault();
    var url_def = "./controllers/main2.php?";
    var donnees = $(".pers_frm").serialize();
    var urlpg = url_def + "p=depense&d=addlibelle&ajx=1";
    var url2 = url_def + "p=depense&d=selectlibelle&ajx=1";
    var method = "POST";
    $.ajax({
      url: urlpg,
      type: method,
      data: donnees,
      success: function (data) {
        if (data.s) {
          $("#notifpers")
            .show()
            .removeClass("hidden callout-danger")
            .addClass("callout-success")
            .html(data.message);
          $("#notifpers").fadeOut(4000);
          $("#mdlibelle").modal("hide");
          $.ajax({
            url: url2,
            type: method,
            data: donnees,
            success: function (data) {
              $("#libellediv").empty().html(data);
              $(".example1").DataTable();
            },
          });
        } else {
          $("#notifpers")
            .show()
            .removeClass("hidden callout-success")
            .addClass("callout-danger")
            .html(data.message);
          $("#notifpers").fadeOut(4000);
        }
      },
      dataType: "json",
    });
  });
  $("#btn_vld_depense").click(function (e) {
    e.preventDefault();
    var url_def = "./controllers/main2.php?";
    var donnees = $(".f_modal_paiement").serialize();
    var urlpg = url_def + "p=depense&d=adddepense&ajx=1";
    var method = "POST";
    $.ajax({
      url: urlpg,
      type: method,
      data: donnees,
      success: function (data) {
        if (data.s) {
          $(".mt").val("");
          $("#myModal2").modal("hide");
          window.open(
            "impression/examples/depensebon.php?id=" + data.depense_id
          );
        } else {
          $("#sp_bkg").text(data.message);
          $("#div_bkg")
            .removeClass("hidden")
            .addClass("alert-danger")
            .show()
            .fadeOut(4000);
        }
      },
      dataType: "json",
    });
  });
  $("#filter_depense_btn").click(function (e) {
    e.preventDefault();
    var bool = false;
    var donnees = $(".filter_frm").serialize();
    var sousresto_id = $("#sousresto_id").val();
    var urlpg =
      "./controllers/main2.php?p=depense&d=listeajx&ajx=1&ss=" + sousresto_id;
    $.ajax({
      url: urlpg,
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $(".loader").removeClass("hidden");
      },
      success: function (data) {
        $("#alldatafact").empty().append(data);
        $(".example1").DataTable();
        bool = true;
      },
      complete: function () {
        if (bool) {
          $(".loader").addClass("hidden");
          $(".btn_modal").removeClass("hidden");
        } else {
          $(".loader").removeClass("hidden");
        }
      },
    });
    return false;
  });

  //CLIC CATEGORIE PRODUIT
  $("#blc_categorie_produit_vente").on("click", ".catprod", function (e) {
    var bool = false;
    var donnees = "";
    var sfam_id = $(this).attr("id");

    $.ajax({
      url: "Traitement/produits_sousresto_categorie.php?sfam_id=" + sfam_id,
      type: "GET",
      data: donnees,

      success: function (data) {
        $("#blc_categorie_produit_vente").addClass("hidden");
        $("#blc_produit_vente").removeClass("hidden");
        $("#blc_produit_vente").html(data);
        $("#sorte_search").val("produit");
      },
    });
    return false;
  });

  $("#btn-confirm-validate-credit").click(function (e) {
    e.preventDefault();
    var donnees = $(".frmcode").serialize();
    var id_cmd = $("#id_cmd").val();
    $.ajax({
      url: "Traitement/verifcode2.php?id_cmd=" + id_cmd,
      type: "POST",
      data: donnees,
      success: function (data) {
       // alert(data);
        validatePaiement();
        $("#validate-code-modal-credit").modal("hide");
      }
      , dataType: "json",
    });

    return false;
  });

  //VERSEMENT
  $(".modal_versement").click(function (e) {
    e.preventDefault();
    var donnees = "";
    var method = "POST";
    var url = "./Traitement/dataspopup.php";
    $.ajax({
      url: url,
      type: method,
      data: donnees,
      success: function (data) {
        $("#myModal_versement").html(data);
        $("#myModal_versement").modal("show");
      },
    });
  });

  $("#myModal_versement").on("click", "#verser_montant", function (e) {
    e.preventDefault();
    var bool = false;
    var donnees = $("#formversement").serialize();
    var url_def = "./controllers/main2.php?";
    var url_def2 = "main.php?";
    $.ajax({
      url: "./Traitement/versement.php",
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $(".loader").removeClass("hidden");
        $("#verser_montant").addClass("hidden");
      },
      success: function (data) {
        if (data.message == "usernoselect" || data.message == "montantvide") {
          $("#msg")
            .show()
            .fadeOut(4000)
            .addClass("alert-danger")
            .removeClass("alert-success");
          $("#msg_alert").text("Veuilez remplir les champs vides!");
        } else if (data.message == "montantnocorrectcdf") {
          $("#msg")
            .show()
            .fadeOut(4000)
            .addClass("alert-danger")
            .removeClass("alert-success");
          $("#msg_alert").text("Le montant en CDF doit etre positif");
        } else if (data.message == "montantnocorrectusd") {
          $("#msg")
            .show()
            .fadeOut(4000)
            .addClass("alert-danger")
            .removeClass("alert-success");
          $("#msg_alert").text("Le montant en USD doit etre positif");
        } else if (data.message == "montantnocorrectcdf1") {
          $("#msg")
            .show()
            .fadeOut(4000)
            .addClass("alert-danger")
            .removeClass("alert-success");
          $("#msg_alert").text("Le montant en CDF doit etre egal au solde CDF");
        } else if (data.message == "montantnocorrectusd1") {
          $("#msg")
            .show()
            .fadeOut(4000)
            .addClass("alert-danger")
            .removeClass("alert-success");
          $("#msg_alert").text("Le montant en USD doit etre egal au solde USD");
        } else if (data.message == "OK") {
          $("#msg")
            .show()
            .fadeOut(4000)
            .addClass("alert-danger")
            .removeClass("alert-success");
          $("#msg_alert").text("Versement effectué avec succes!");
          effacer();
          var donnees = "";
          var urlpg = url_def + "p=versement&d=listeajx&ajx=1";
          $.ajax({
            url: urlpg,
            type: "POST",
            data: donnees,
            success: function (data) {
              $("#alldatafact").empty().append(data);
              $(".example1").DataTable();
            },
          });
          $("#myModal_versement").modal("hide");
          window.open("./impression/examples/recu_repartition.php");
        }
        bool = true;
      },
      complete: function () {
        if (bool) {
          $(".loader").addClass("hidden");
          $("#verser_montant").removeClass("hidden");
        } else {
          $(".loader").removeClass("hidden");
        }
      },
      dataType: "json",
    });
  });
  //BON DE BAR
  $("#btn_bc_bar").click(function (e) {
    e.preventDefault();
    var bool = false;
    var id_client = $("#client_id1").val();
    var idfactcl = $("#idfactcl").val();
    var id_cmd = $("#id_cmd").val();
    var res_ch_id = $("#res_ch_id3").val();
    var idrescl = $("#idrescl").val();
    var montant_tot = $("#mont_tot_panier_devise").val();
    var nom_client = $("#cl_chxi").text();
    $("#nom_client").val(nom_client);
    var attente = "attente";
    var donnees = " ";
    $.ajax({
      url:
        "Traitement/attente2.php?id_client=" +
        id_client +
        "&id_cmd=" +
        id_cmd +
        "&res_ch_id=" +
        res_ch_id +
        "&montant_tot=" +
        montant_tot +
        "&idfactcl=" +
        idfactcl +
        "&attente=" +
        attente +
        "&idrescl=" +
        idrescl +
        "&nom_client=" +
        nom_client,
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $("#btn_attente").addClass("hidden");
        $("#btn_attente_loader").removeClass("hidden");
      },
      success: function (data) {
        if (data.succes) {
          $("#cl_chxi").empty().append("");
          $("#client_id1").val("");
          $("#id_cmd").val(0);
          //important pour orienter le reglement
          $("#attente").val("");
          //                $('#listetable_client').load('Traitement/miseenattente.php');
          //$('#affichage_tout_produit').empty().load('Traitement/affichage_tout_produit.php');
          $("#affiche_commandes").html(data);
          $("#tab_1").empty().load("liste_tbl_maj.php");
          $("#tab_2").empty().load("liste_cl_maj.php");
          //                $(".msg_alert1").fadeOut(5000);
          window.open(
            "impression/examples/bcbar.php?nom_client=" +
              nom_client +
              "&boncommande_id=" +
              data.idcommande
          );
        }

        bool = true;
      },
      complete: function () {
        if (bool) {
          $("#btn_attente_loader").addClass("hidden");
          $("#btn_attente").removeClass("hidden");
        }
      },
      dataType: "json",
    });
  });

  //KING
  $(".panel_client_table").on("keyup", "#table_search", function (e) {
    e.preventDefault();
    // alert('okkkk');
    var motif = $(this).val();
    var url = "Traitement/table_search_datas.php?motif=" + motif;
    $.ajax({
      url: url,
      type: "POST",
      success: function (data) {
        $(".listetable_client").empty().append(data);
      },
    });
    return false;
  });
  $("#myModal_transfer").on("keyup", "#table_search2", function (e) {
    e.preventDefault();
    var motif = $(this).val();
    var url = "Traitement/table_search_datas.php?motif=" + motif;
    $.ajax({
      url: url,
      type: "POST",
      success: function (data) {
        $("#datatranfertid").empty().append(data);
      },
    });
    return false;
  });
  $("#btn_acc_boisson").click(function (e) {
    e.preventDefault();
    $("#iddataaccboisson").empty().load("modal_accboisson_data.php");
    $("#myModal_acc_boisson").modal("show");
    return false;
  });
  $("#btn_val_acc_boisson").click(function (e) {
    e.preventDefault();
    var accboissonvalues = $("input:checkbox:checked.accboisson_class")
      .map(function () {
        return this.value;
      })
      .get()
      .join(",");
    var id_produit = $("#id_produit2").val();
    var idtab = $("#id_client").val();
    var accboissonaction = "accboissonaction";
    // alert(idtab);
    var donnees = "";
    $.ajax({
      url:
        "Traitement/tableau_affichage_commandes.php?action=" +
        accboissonaction +
        "&accboissonvalues=" +
        accboissonvalues +
        "&id_produit=" +
        id_produit +
        "&idtab=" +
        idtab,
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $("#btn_val_acc_boisson").addClass("hidden");
        $("#btn_val_acc_boisson_loader").removeClass("hidden");
      },
      success: function (data) {
        // alert(data);
        $("#affiche_commandes").html(data);
        $("#myModal_acc_boisson").modal("hide");
        bool = true;
      },
      complete: function () {
        if (bool) {
          $("#btn_val_acc_boisson_loader").addClass("hidden");
          $("#btn_val_acc_boisson").removeClass("hidden");
        }
      },
    });
    return false;
  });
  $("#btn_couvert").click(function () {
    var donnees = "";
    $("#nbrcouvertpopup").val(0);
    $("#myModalCouvert").modal("show");
    return false;
  });
  $("#btn_couvert_proc").click(function (e) {
    e.preventDefault();
    var nbrcouvertpopup = $("#nbrcouvertpopup").val();
    var id_client = $("#id_client").val();
    //serveur
    var serveur_id = $("#serveur_id").val();
    var serveur_name = $("#serveur_id option:selected").text();
    if (nbrcouvertpopup < 0) {
      $("#sp_bkg_couvert").text("Le nombre de couverts n'est pas correct.");
      $("#div_bkg_couvert")
        .removeClass("hidden")
        .addClass("alert-danger")
        .show()
        .fadeOut(4000);
    } else {
      var url =
        "Traitement/nbrcouvertpopup_update.php?nbrcouvert=" +
        nbrcouvertpopup +
        "&id_client=" +
        id_client +
        "&serveur_id=" +
        serveur_id +
        "&serveur_name=" +
        serveur_name;
      $.ajax({
        url: url,
        type: "POST",
        success: function (data) {
          $("#nbrcouvert").val(nbrcouvertpopup);
          // $("#text_couvert").empty().append("Nombre de couverts : " + nbrcouvertpopup);
          $("#myModalCouvert").modal("hide");
          $("#affichage_tout_produit").show();
          $("#tab_1").hide();
          $("#tab_2").hide();

          $("#text_serveur").show();
          $("#text_serveur")
            .empty()
            .append("SERVEUR: " + serveur_name);
          $("#id_serveur").val(serveur_id);
          $("#name_serveur").val(serveur_name);
        },
      });
    }
    return false;
  });
  $("#filter_couverts_btn").click(function (e) {
    e.preventDefault();
    var bool = false;
    var donnees = $(".filter_frm").serialize();
    var sousresto_id = $("#sousresto_id").val();
    var urlpg =
      "./controllers/main2.php?p=couverts&d=listeajx&ajx=1&ss=" + sousresto_id;
    $.ajax({
      url: urlpg,
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $(".loader").removeClass("hidden");
      },
      success: function (data) {
        $("#alldatacouverts").empty().append(data);
        $(".example1").DataTable();
        bool = true;
      },
      complete: function () {
        if (bool) {
          $(".loader").addClass("hidden");
          $(".btn_modal").removeClass("hidden");
        } else {
          $(".loader").removeClass("hidden");
        }
      },
    });
    return false;
  });
  $("#blc_main").on("click", "#print_liste_couverts", function (e) {
    e.preventDefault();
    window.open("./impression/examples/couverts.php");
  });

  $("#modal_transfer").click(function (e) {
    e.preventDefault();
    $("#datatranfertid").empty().load("datatransfertfile.php");
    $("#myModal_transfer").modal("show");
    return false;
  });
  $("#btn_transfer").click(function (e) {
    e.preventDefault();
    var donnees = " ";
    var tbdest = $("#tabtransfert2span").text();
    $.ajax({
      url: "Traitement/transfert.php",
      type: "POST",
      data: donnees,
      success: function (data) {
        if (data.succes) {
          $("#table_search2").val("");
          $("#tabtransfert1span").empty().append("");
          $("#tabtransfert2span").empty().append("");
          $("#myModal_transfer").modal("hide");
          $(".listetable_client").empty().load("Traitement/tableajax.php");
          $("#cl_chxi").empty().append(tbdest);
        }
      },
      dataType: "json",
    });

    return false;
  });
  $("#datatranfertid").on("click", ".tabtransfert1", function (e) {
    e.preventDefault();
    var tabtransfert1 = $(this).attr("id1");
    var tabtransfert1des = $(this).attr("id2");
    // var id_fact = $(this).attr('id_fact');
    var id_fact = $("#idfactcl").val();
    var fact_id = $("#idfactcl").val();
    var nbrcouvert = $(this).attr("nbrcouvert");
    var url =
      "Traitement/tabtransfert1.php?tabtransfert1=" +
      tabtransfert1 +
      "&id_fact=" +
      id_fact +
      "&nbrcouvert=" +
      nbrcouvert;
    $.ajax({
      url: url,
      type: "POST",
      success: function (data) {
        //  alert(data.test);
        $("#transfer_idclient").val(fact_id);
        $("#tabtransfert1span").empty().append(tabtransfert1des);
        //   $("#tabtransfert1span").empty().append(fact_id);

        $("#datatranfertid").empty().load("datatransfertfile2.php");
      },
    });
    return false;
  });
  $("#datatranfertid").on("click", ".tabtransfert2", function (e) {
    e.preventDefault();
    var tabtransfert2 = $(this).attr("id1");
    var tabtransfert1des = $(this).attr("id2");
    var $id_fact = $(this).attr("id_fact");
    var url =
      "Traitement/tabtransfert2.php?tabtransfert2=" +
      tabtransfert2 +
      "&tabtransfert1des=" +
      tabtransfert1des;
    $.ajax({
      url: url,
      type: "POST",
      success: function (data) {
        $("#tabtransfert2span").empty().append(tabtransfert1des);
        $("#transfer_idfact").val(tabtransfert2);
      },
    });
    return false;
  });
  $("#btn_transfer_annuler").click(function (e) {
    e.preventDefault();
    $("#tabtransfert1span").empty().append("");
    $("#tabtransfert2span").empty().append("");
    $("#myModal_transfer").modal("hide");
    return false;
  });
  $(".filterproduits").click(function () {
    var bool = false;
    var donnees = "";
    var sfam_id = $(this).attr("id");

    $.ajax({
      url: "Traitement/produits_all_categories.php",
      type: "GET",
      data: donnees,

      success: function (data) {
        $("#blc_categorie_produit_vente").addClass("hidden");
        $("#blc_produit_vente").removeClass("hidden");
        $("#blc_produit_vente").html(data);
        $("#sorte_search").val("produit");
      },
    });
    return false;
  });

  $("#btn_moins_qte").click(function (e) {
    e.preventDefault();
    var bool_addition = $("#bool_addition").val();
    var user_type = $("#user_type").val();
    var id_cmd = $("#id_cmd").val();
    if (user_type == 3 && id_cmd > 0) {
      $("#decrementeQte-confirm-modal").modal("show");
    } else {
      decrementeQteProduit();
    }
    return false;
  });
  $(".panel_client_table").on("click", ".client_table2", function () {
    //c'est l'id du client ou table selectionné
    var table_id = $(this).attr("id1");
    var type_client = $(this).attr("tp-cl");
    var clresto = $(this).attr("clresto");
    var etat_table = $(this).attr("etat_table");
    var statut_tbl = $("#statut_tbl").val();
    var fusion = $(this).attr("fusion");
    if (fusion == 0) {
      if (etat_table == "occupe") {
        var id1 = $(this).attr("id1");
        var nbrcouvert = $(this).attr("nbrcouvert");
        var id_sousresto = $(this).attr("id_sousresto");
        var user_attente = $(this).attr("user_attente");
        $("#id_sousresto").val(id_sousresto);
        $("#nbrcouvert").val(nbrcouvert);
        $("#user_attente").val(user_attente);
        $(".idclrp").val(type_client);
        //$("#text_couvert").empty().append("Nombre de couverts : " + nbrcouvert).show();
        var id2 = $(this).attr("id2");
        statut_tbl = "occupe";
        $("#statut_tbl").val(statut_tbl);
        $.ajax({
          url: "Traitement/ticket_datas2.php?table_id=" + table_id,
          async: true,
          type: "POST",
          global: false,
          cache: false,
          success: function (html) {
            $("#cl_chxi").empty().append(id2);
            $("#affiche_commandes").empty().append(html);
            $("#c1").show();
            $("#c3").hide();
            $("#id_cmd").val($("#id4x").val());
            $("#client_id1").val(table_id);
            $("#idfactcl").val($("#id4x").val());
            $("#attente").val("attente");
            $("#type_client").val($("#id5x").val());
            $("#dte_edite").val($("#id6x").val());
            $("#id_client").val(id1);
            $("#id_serveur").val($("#id7x").val());
            $("#name_serveur").val($("#id8x").val());
            $("#text_serveur")
              .empty()
              .append("SERVEUR: " + $("#id8x").val())
              .show();
            $("#affichage_tout_produit").show();
            $("#tab_1").hide();
            $("#tab_2").hide();
          },
        });
      } else {
        $("#nbrcouvert").val(0);
        // $("#text_couvert").empty().append("Nombre de couverts : 0").show();
        $("#text_serveur").empty().append("");
        var id1 = $(this).attr("id1");
        var type_client = $(this).attr("tp-cl");
        var clresto = $(this).attr("clresto");
        $(".tycl").val(type_client);
        $("#type_client").val(type_client);
        $("#clresto").val(clresto);
        $("#client_id").val(id1);
        $("#client_id1").val(id1);
        //c'est le nom du client ou table selectionné
        var id2 = $(this).attr("id2");
        $("#cl_chxi").empty().append(id2);
        $("#nom_client").val(id2);
        //c'est id de la table t_reserve_chambre
        id4 = $(this).attr("id4");
        id5 = $(this).attr("id5");
        //id reservation
        $("#res_ch_id3").val(id4);
        $("#reservechambre_id").val(id4);
        $("#id_res").val(0);
        $("#idrescl").val(0);
        $("#id_client").val(id1);
        $("#c1").show();
        $("#c2").hide();
        $("#msd_attente").hide();
        $("#nbrcouvertpopup").val(0);
        $("#myModalCouvert").modal("show");
        $.ajax({
          url:
            "Traitement/tableau_affichage_commandes.php?action=initialiser&client_id=" +
            id1 +
            "&typecl=" +
            type_client,
          async: true,
          type: "POST",
          global: false,
          cache: false,
          success: function (data) {
            $("#id_cmd").val(0);
            //important pour orienter le reglement
            $("#attente").val("");
            $("#affiche_commandes").html(data);
            $("#affichage_tout_produit").show();
            $("#tab_1").hide();
            $("#tab_2").hide();
          },
        });
      }
    } else {
      var id1 = $(this).attr("id1");
      var id_sousresto = $(this).attr("id_sousresto");
      $("#id_sousresto").val(id_sousresto);
      var id2 = $(this).attr("id2");
      $.ajax({
        url: "Traitement/ticket_datas_caisse_fusion.php?table_id=" + table_id,
        async: true,
        type: "POST",
        global: false,
        cache: false,
        success: function (html) {
          $("#cl_chxi").empty().append(id2);
          $("#affiche_commandes").empty().append(html);
          $("#c1").show();
          $("#c3").hide();
          $("#client_id1").val(table_id);
          $("#id_client").val(id1);
          $("#affichage_tout_produit").show();
          $("#tab_1").hide();
          $("#tab_2").hide();
          $.ajax({
            url: "Traitement/datanombrecouvert.php",
            type: "POST",
            success: function (data) {
              //                             alert(data.nbrcouvert);
              var nbrcouvert = data.nbrcouvert;
              $("#text_couvert")
                .empty()
                .append("Nombre de couverts : " + nbrcouvert)
                .show();
            },
            dataType: "json",
          });
        },
      });
    }
  });

  //Caisse
  $(".panel_client_table").on("click", ".client_table_caisse", function () {
    //c'est l'id du client ou table selectionné
    var table_id = $(this).attr("id1");
    var type_client = $(this).attr("tp-cl");
    var clresto = $(this).attr("clresto");
    var etat_table = $(this).attr("etat_table");
    var statut_tbl = $("#statut_tbl").val();
    var fusion = $(this).attr("fusion");
    if (fusion == 0) {
      if (etat_table == "occupe") {
        var id1 = $(this).attr("id1");
        var nbrcouvert = $(this).attr("nbrcouvert");
        var id_sousresto = $(this).attr("id_sousresto");
        var user_attente = $(this).attr("user_attente");
        $("#id_sousresto").val(id_sousresto);
        $("#nbrcouvert").val(nbrcouvert);
        $("#user_attente").val(user_attente);
        $("#text_couvert")
          .empty()
          .append("Nombre de couverts : " + nbrcouvert)
          .show();
        var id2 = $(this).attr("id2");
        statut_tbl = "occupe";
        $("#statut_tbl").val(statut_tbl);
        $.ajax({
          url: "Traitement/ticket_datas_caisse.php?table_id=" + table_id,
          async: true,
          type: "POST",
          global: false,
          cache: false,
          success: function (html) {
            $("#cl_chxi").empty().append(id2);
            $("#affiche_commandes").empty().append(html);
            $("#c1").show();
            $("#c3").hide();
            $("#id_cmd").val($("#id4x").val());
            $("#client_id1").val(table_id);
            $("#idfactcl").val($("#id4x").val());
            $("#attente").val("attente");
            $("#type_client").val($("#id5x").val());
            $("#dte_edite").val($("#id6x").val());
            $("#id_client").val(id1);
            /* if (type_client == 'client') {
                            $(".selectmodeclient").show();
                            $(".selectmodetable").hide();
                        } else {
                            $(".selectmodeclient").hide();
                            $(".selectmodetable").show();
                        } */
          },
        });
      } else {
        $("#nbrcouvert").val(0);
        $("#text_couvert").empty().append("Nombre de couverts : 0").show();
        var id1 = $(this).attr("id1");
        var type_client = $(this).attr("tp-cl");
        var clresto = $(this).attr("clresto");
        $(".tycl").val(type_client);
        $("#type_client").val(type_client);
        $("#clresto").val(clresto);
        $("#client_id").val(id1);
        $("#client_id1").val(id1);
        //c'est le nom du client ou table selectionné
        var id2 = $(this).attr("id2");
        $("#cl_chxi").empty().append(id2);
        $("#nom_client").val(id2);
        //c'est id de la table t_reserve_chambre
        id4 = $(this).attr("id4");
        id5 = $(this).attr("id5");
        //id reservation
        $("#res_ch_id3").val(id4);
        $("#reservechambre_id").val(id4);
        $("#id_res").val(0);
        $("#idrescl").val(0);
        $("#id_client").val(id1);
        $("#c1").show();
        $("#c2").hide();
        $("#msd_attente").hide();
        $("#nbrcouvertpopup").val(0);
        $("#myModalCouvert").modal("show");
        if (statut_tbl == "occupe") {
          statut_tbl = "libre";
          $("#statut_tbl").val(statut_tbl);
          $.ajax({
            url: "Traitement/tableau_affichage_commandes.php?action=initialiser",
            async: true,
            type: "POST",
            global: false,
            cache: false,
            success: function (html) {
              $("#id_cmd").val(0);
              //important pour orienter le reglement
              $("#attente").val("");
              $("#affiche_commandes").html(html);
            },
          });
        }
      }
    } else {
      var id1 = $(this).attr("id1");
      var id_sousresto = $(this).attr("id_sousresto");
      $("#id_sousresto").val(id_sousresto);
      var id2 = $(this).attr("id2");
      $.ajax({
        url: "Traitement/ticket_datas_caisse_fusion.php?table_id=" + table_id,
        async: true,
        type: "POST",
        global: false,
        cache: false,
        success: function (html) {
          $("#cl_chxi").empty().append(id2);
          $("#affiche_commandes").empty().append(html);
          $("#c1").show();
          $("#c3").hide();
          $("#client_id1").val(table_id);
          $("#id_client").val(id1);
          $.ajax({
            url: "Traitement/datanombrecouvert.php",
            type: "POST",
            success: function (data) {
              //                             alert(data.nbrcouvert);
              var nbrcouvert = data.nbrcouvert;
              $("#text_couvert")
                .empty()
                .append("Nombre de couverts : " + nbrcouvert)
                .show();
            },
            dataType: "json",
          });
        },
      });
    }
  });
  $("#modal_fusion").click(function (e) {
    e.preventDefault();
    $("#datafusionid").empty().load("datafusion.php");
    $("#myModal_fusion").modal("show");
    return false;
  });

  $("#btn_fusion").click(function (e) {
    e.preventDefault();
    var url = "";
    $("input:checkbox:checked.tbl_occ_class").map(function () {
      var id_fact = $(this).attr("id_fact");
      var mont_ttc = $(this).attr("mont_ttc");
      var taux = $(this).attr("taux");
      var id_client = $(this).attr("id1");
      var nom_client = $(this).attr("id2");
      var type_cl = $(this).attr("type_cl");
      var serveur_id = $(this).attr("serveur_id");
      var serveur_name = $(this).attr("serveur_name");
      url =
        "Traitement/loaddatasfusion.php?id_client=" +
        id_client +
        "&nom_client=" +
        nom_client +
        "&id_fact=" +
        id_fact +
        "&mont_ttc=" +
        mont_ttc +
        "&taux=" +
        taux +
        "&type_cl=" +
        type_cl +
        "&serveur_id=" +
        serveur_id +
        "&serveur_name=" +
        serveur_name;
      $.ajax({
        url: url,
        type: "POST",
        success: function (d) {
      /*     if (
            confirm(
              "Etes vous sure de fusionner les tables vers la table" +
                nom_client
            )
          ) {
            // User clicked 'OK'
            $("#myModal_fusion").modal("hide");
            $("#modal_confirm_fusion").modal("show");
          } else {
            // User clicked 'Cancel'
            return false;
          } */
          swal({
            title: "Etes vous sure de fusionner les tables vers la table"+ nom_client,
            icon: "warning",
            buttons: true,
            dangerMode: true,
          }).then((willDelete) => {
            if (willDelete) {
              $("#myModal_fusion").modal("hide");
              $("#modal_confirm_fusion").modal("show");
            } else {
              swal("La fusion est annulée avec succès!");
            }
          });
        },
      });
    });
    /*  $("#myModal_fusion").modal("hide");
    $("#modal_confirm_fusion").modal("show"); */
    return false;
  });
  $("#btn_fusion_confirm_yes").click(function (e) {
    e.preventDefault();
    var url = "";
    url = "Traitement/fusion_process.php";
    $.ajax({
      url: url,
      type: "POST",
      success: function (data) {
        var id_fact_fus = data.id_fact_fus;
        $(".listetable_client").empty().load("Traitement/tableajax.php");
        window.open(
          "impression/examples/bon_de_fusion.php?id_fact_fus=" + id_fact_fus
        );
        //  window.open('impression/examples/recu_addition_fusion.php?id_fact_fus=' + id_fact_fus);
        //  location.reload();
      },
      dataType: "json",
    });
    $("#modal_confirm_fusion").modal("hide");

    return false;
  });
  $("#btn_fusion_confirm_no").click(function (e) {
    e.preventDefault();
    $("#modal_confirm_fusion").modal("hide");
    $("#myModal_fusion").modal("show");
    return false;
  });
  $("#btn_eclater").click(function (e) {
    e.preventDefault();
    var id_client = $("#id3x").val();
    $.ajax({
      url: "Traitement/data_re_impression_eclat.php?id_client=" + id_client,
      async: true,
      type: "POST",
      global: false,
      cache: false,
      success: function (html) {
        $("#data_eclatement").empty().append(html);
        $("#modal_eclatement").modal("show");
      },
    });
    return false;
  });
  // la defusion de table
  /*   
  $("#defusionner").click(function () {
    var id_fact_fus_frm = $("#id_fact_fus_frm").val();
    // alert(id_fact_fus_frm);
    $.ajax({
      url: 'Traitement/defusionner.php',
      type: "POST",
      data: id_fact_fus_frm,
      success: function (data) {
        if (data.success) {
          alert(data.id_merge);
        }
      },
    });
  }); */

  $("#btn_eclatement_valider").click(function () {
    var donnees = "";
    var boncommande_id = $("#id_cmd").val();
    $("input:checkbox:checked.affichage_produit").map(function () {
      var id = $(this).attr("cpt");
      var qte = $("#Q" + id).val();
      // alert(id);
      // alert(qte);
      url = "Traitement/loaddataseclat.php?id=" + id + "&qte=" + qte;
      $.ajax({
        url: url,
        type: "POST",
        success: function (data) {},
      });
    });
    window.open(
      "impression/examples/recu_addition_eclat.php?boncommande_id=" +
        boncommande_id
    );
    return false;
  });
  //Caisse

  //Ajustement Annulation
  $("#btn_annuler").click(function (e) {
    e.preventDefault();
    var bool_addition = $("#bool_addition").val();
    var user_type = $("#user_type").val();
    var id_cmd = $("#id_cmd").val();
    if (bool_addition == 1) {
      $("#avertissement-modal").modal("show");
    } else {
      if (user_type == 1 || user_type == 5) {
        $(".div_txt").show();
        $(".div_frm").hide();
      } else if ((user_type != 1 || user_type != 5) && id_cmd > 0) {
        $(".div_txt").hide();
        $(".div_frm").show();
        $(".code").val("");
      } else {
        $(".div_txt").show();
        $(".div_frm").hide();
      }
      $("#annulation-modal").modal("show");
    }
    return false;
  });

  $("#btn-confirm-annulation").click(function (e) {
    e.preventDefault();
    var donnees = $(".frmcodeannul").serialize();
    var id_cmd = $("#id_cmd").val();
    $.ajax({
      url: "Traitement/verifcode.php?id_cmd=" + id_cmd,
      type: "POST",
      data: donnees,
      success: function (d) {
        if (d.message == "succes") {
          $(".code").val("");
          var bool = false;
          var id_client = $("#client_id1").val();
          var reservechambre_id = $("#reservechambre_id").val();
          var id_fact = $("#idfactcl").val();
          var nom_client = $("#cl_chxi").text();
          var annuler = "annuler";
          var donnees = " ";
          $("#fusion_frm").val($("#fusion_ticket").val());
          var fusion_frm = $("#fusion_frm").val();
          if (fusion_frm == 1) {
            $.ajax({
              url: "Traitement/annulerfusion.php?id_client=" + id_client,
              type: "POST",
              data: donnees,
              beforeSend: function () {
                $("#btn_annuler").addClass("hidden");
                $("#btn_annuler_loader").removeClass("hidden");
              },
              success: function (data) {
                if (data.succes) {
                  $("#cl_chxi").empty().append("");
                  $("#client_id1").val("");
                  $("#id_cmd").val(0);
                  $("#nbrcouvert").val(0);
                  $("#text_couvert").hide();
                  $("#affiche_commandes").html("");
                  $(".listetable_client")
                    .empty()
                    .load("Traitement/tableajaxcaisse.php");
                }
                $("#annulation-modal").modal("hide");
                bool = true;
              },
              complete: function () {
                if (bool) {
                  $("#btn_annuler_loader").addClass("hidden");
                  $("#btn_annuler").removeClass("hidden");
                }
              },
              dataType: "json",
            });
          } else {
            $.ajax({
              url:
                "Traitement/annuler2.php?id_cmd=" +
                id_cmd +
                "&id_client=" +
                id_client +
                "&reservechambre_id=" +
                reservechambre_id +
                "&id_fact=" +
                id_fact,
              type: "POST",
              data: donnees,
              beforeSend: function () {
                $("#btn_annuler").addClass("hidden");
                $("#btn_annuler_loader").removeClass("hidden");
              },
              success: function (data) {
                if (data.succes) {
                  $("#cl_chxi").empty().append("");
                  $("#client_id1").val("");
                  $("#id_cmd").val(0);
                  $("#nbrcouvert").val(0);
                  $("#text_couvert").hide();
                  $("#affiche_commandes").html("");
                  $(".listetable_client")
                    .empty()
                    .load("Traitement/tableajaxcaisse.php");
                  if (data.bar) {
                    window.open(
                      "impression/examples/bon_annulation_bar.php?nom_client=" +
                        nom_client +
                        "&boncommande_id=" +
                        data.idcommande +
                        "&id_cmd=" +
                        id_cmd
                    );
                  }
                  if (data.bc) {
                    window.open(
                      "impression/examples/bon_annulation_cuisine.php?nom_client=" +
                        nom_client +
                        "&boncommande_id=" +
                        data.idcommande +
                        "&id_cmd=" +
                        id_cmd
                    );
                  }
                } else {
                  $("#affiche_commandes").html(data.message);
                }
                $("#annulation-modal").modal("hide");
                bool = true;
              },
              complete: function () {
                if (bool) {
                  $("#btn_annuler_loader").addClass("hidden");
                  $("#btn_annuler").removeClass("hidden");
                }
              },
              dataType: "json",
            });
          }
        } else if (d.message == "vide") {
          $(".code").val("");
          $(".msgcode").show().fadeOut(4000);
        }
      },
      dataType: "json",
    });

    return false;
  });

  $("#btn_re_imprimer").click(function (e) {
    e.preventDefault();
    var id_client = $("#id3x").val();

    $.ajax({
      url: "Traitement/data_re_impression.php?id_client=" + id_client,
      async: true,
      type: "POST",
      global: false,
      cache: false,
      success: function (html) {
        //Pour reinitiliser bon reimpression
        $.ajax({
          url: "Traitement/reinitialisercmdreimpr.php",
          type: "POST",
        });
        //Pour reinitiliser bon reimpression
        $("#data_re_impression").empty().append(html);
        $("#modal_re_imprimer").modal("show");
      },
    });
    return false;
  });
  $("#btn_re_imprimer_valider").click(function (e) {
    e.preventDefault();
    var url = "";
    $("input:checkbox:checked.affichage_produit").map(function () {
      var id = $(this).attr("id");
      var idp = $(this).attr("idp");
      var pn = $(this).attr("pn");
      var pd = $(this).attr("pd");
      var cpt = $(this).attr("cpt");
      var pq = $("#Q" + cpt).val();
      var idlgcmd = $(this).attr("idlgcmd");
      url =
        "Traitement/loaddatasreimpression.php?idp=" +
        idp +
        "&pq=" +
        pq +
        "&idlgcmd=" +
        idlgcmd;
      $.ajax({
        url: url,
        type: "POST",
        success: function (d) {
          //    alert(d)
          $("#IsChecked").val(1);
        },
      });
    });
    $("#modal_re_imprimer").modal("hide");
    $("#modal_confirm_reimpression").modal("show");

    return false;
  });
  $("#btn_confirm_reimpression").click(function (e) {
    e.preventDefault();
    var bool = false;
    var id_client = $("#client_id1").val();
    var idfactcl = $("#idfactcl").val();
    var id_cmd = 0;
    var res_ch_id = $("#res_ch_id3").val();
    var idrescl = $("#idrescl").val();
    var montant_tot = $("#mont_tot_panier_devise").val();
    var nom_client = $("#cl_chxi").text();
    $("#nom_client").val(nom_client);
    var attente = "attente";
    var nbrcouvert = $("#nbrcouvert").val();
    var user_attente = $("#user_attente").val();
    var IsChecked = $("#IsChecked").val();
    var donnees = " ";
    if (IsChecked == 1) {
      $.ajax({
        url:
          "Traitement/reimpression_process.php?id_client=" +
          id_client +
          "&id_cmd=" +
          id_cmd +
          "&res_ch_id=" +
          res_ch_id +
          "&montant_tot=" +
          montant_tot +
          "&idfactcl=" +
          idfactcl +
          "&attente=" +
          attente +
          "&idrescl=" +
          idrescl +
          "&nom_client=" +
          nom_client +
          "&nbrcouvert=" +
          nbrcouvert +
          "&user_attente=" +
          user_attente,
        type: "POST",
        data: donnees,
        beforeSend: function () {
          $("#btn_re_imprimer_valider").addClass("hidden");
          $("#btn_re_imprimer_valider_loader").removeClass("hidden");
        },
        success: function (data) {
          if (data.succes) {
            $("#cl_chxi").empty().append("");
            $("#client_id1").val("");
            $("#id_cmd").val(0);
            $("#attente").val("");
            $("#affiche_commandes").html("");
            $("#affichage_tout_produit").show();
            $("#blc_produit_vente").addClass("hidden");
            $("#blc_categorie_produit_vente").removeClass("hidden");
            $(".panel_client_table").hide();
            $("#nbrcouvert").val(0);
            $("#text_couvert").hide();

            if (data.bar) {
              window.open(
                "impression/examples/bcbar1908.php?nom_client=" +
                  nom_client +
                  "&boncommande_id=" +
                  idfactcl +
                  "&id_cmd=" +
                  id_cmd +
                  "&IsChecked=" +
                  IsChecked
              );
            }
            if (data.bc) {
              window.open(
                "impression/examples/recu_bon_commande1908.php?nom_client=" +
                  nom_client +
                  "&boncommande_id=" +
                  idfactcl +
                  "&id_cmd=" +
                  id_cmd +
                  "&IsChecked=" +
                  IsChecked
              );
            }

            $("#modal_confirm_reimpression").modal("hide");
            $("#IsChecked").val(0);
          }

          bool = true;
        },
        complete: function () {
          if (bool) {
            $("#btn_re_imprimer_valider_loader").addClass("hidden");
            $("#btn_re_imprimer_valider").removeClass("hidden");
          }
        },
        dataType: "json",
      });
    } else {
      $.ajax({
        url:
          "Traitement/reimpression_process2.php?id_client=" +
          id_client +
          "&id_cmd=" +
          id_cmd +
          "&res_ch_id=" +
          res_ch_id +
          "&montant_tot=" +
          montant_tot +
          "&idfactcl=" +
          idfactcl +
          "&attente=" +
          attente +
          "&idrescl=" +
          idrescl +
          "&nom_client=" +
          nom_client +
          "&nbrcouvert=" +
          nbrcouvert +
          "&user_attente=" +
          user_attente,
        type: "POST",
        data: donnees,
        beforeSend: function () {
          $("#btn_re_imprimer_valider").addClass("hidden");
          $("#btn_re_imprimer_valider_loader").removeClass("hidden");
        },
        success: function (data) {
          // alert(data);
          if (data.succes) {
            $("#cl_chxi").empty().append("");
            $("#client_id1").val("");
            $("#id_cmd").val(0);
            $("#attente").val("");
            $("#affiche_commandes").html("");
            $("#affichage_tout_produit").show();
            $("#blc_produit_vente").addClass("hidden");
            $("#blc_categorie_produit_vente").removeClass("hidden");
            $(".panel_client_table").hide();
            $("#nbrcouvert").val(0);
            $("#text_couvert").hide();
            if (data.bar) {
              window.open(
                "impression/examples/bcbar1908.php?nom_client=" +
                  nom_client +
                  "&boncommande_id=" +
                  idfactcl +
                  "&id_cmd=" +
                  id_cmd +
                  "&IsChecked=" +
                  IsChecked
              );
            }
            if (data.bc) {
              window.open(
                "impression/examples/recu_bon_commande1908.php?nom_client=" +
                  nom_client +
                  "&boncommande_id=" +
                  idfactcl +
                  "&id_cmd=" +
                  id_cmd +
                  "&IsChecked=" +
                  IsChecked
              );
            }
            $("#modal_confirm_reimpression").modal("hide");
            $("#IsChecked").val(0);
          }

          bool = true;
        },
        complete: function () {
          if (bool) {
            $("#btn_re_imprimer_valider_loader").addClass("hidden");
            $("#btn_re_imprimer_valider").removeClass("hidden");
          }
        },
        dataType: "json",
      });
    }
  });

  $("#modal_reserver").click(function (e) {
    e.preventDefault();
    $("#datareservid").empty().load("datareserv.php");
    $("#myModal_reserv").modal("show");
    return false;
  });
  $("#btn_reserv_confirm").click(function (e) {
    e.preventDefault();
    var donnees = $("#form_res").serialize();
    $.ajax({
      url: "Traitement/insertion_res_table.php",
      async: true,
      type: "POST",
      data: donnees,
      global: false,
      cache: false,
      success: function (data) {
        // alert(data);
        $(".dateres").val(" ");
        $(".listetable_client").empty().load("Traitement/tableajax.php");
        $("#modal_reserv_confirm").modal("hide");
      },
    });
  });
  $("#btn-exonerer-tva").click(function (e) {
    e.preventDefault();
    var id_cmd = $("#id_cmd").val();
    $("#btn-exonerer-tva").addClass("hidden");
    $.ajax({
      url: "Traitement/exonerertva.php?id_cmd=" + id_cmd,
      async: true,
      type: "POST",
      global: false,
      cache: false,
      success: function (html) {
        $("#btn-appliquer-tva").removeClass("hidden");
        $("#cl_chxi").empty().append($("#id2x").val());
        $("#affiche_commandes").empty().append(html);
        $("#c1").show();
        $("#c3").hide();
        $("#id_cmd").val($("#id4x").val());
        $("#client_id1").val(table_id);
        $("#idfactcl").val($("#id4x").val());
        $("#attente").val("attente");
        $("#type_client").val($("#id5x").val());
        $("#dte_edite").val($("#id6x").val());
        $("#id_client").val(id1);
      },
    });
    return false;
  });

  $("#btn-appliquer-tva").click(function (e) {
    e.preventDefault();
    var id_cmd = $("#id_cmd").val();
    $("#btn-appliquer-tva").addClass("hidden");
    $.ajax({
      url: "Traitement/appliquertva.php?id_cmd=" + id_cmd,
      async: true,
      type: "POST",
      global: false,
      cache: false,
      success: function (html) {
        $("#btn-exonerer-tva").removeClass("hidden");
        $("#cl_chxi").empty().append($("#id2x").val());
        $("#affiche_commandes").empty().append(html);
        $("#c1").show();
        $("#c3").hide();
        $("#id_cmd").val($("#id4x").val());
        $("#client_id1").val(table_id);
        $("#idfactcl").val($("#id4x").val());
        $("#attente").val("attente");
        $("#type_client").val($("#id5x").val());
        $("#dte_edite").val($("#id6x").val());
        $("#id_client").val(id1);
      },
    });
    return false;
  });

  $("#btn_regler2").click(function (e) {
    e.preventDefault();
    $("#div_bkg2").addClass("hidden");
    $("#commandeID").val($("#id_cmd").val());
    $("#client_id22").val($("#client_id1").val());
    $("#id_cmd22").val($("#id_cmd").val());
    $("#attente2").val($("#attente").val());
    $(".montant_fact2").text($("#mont_tot_panier_af").val());
    $("#montant_fact2").val($("#mont_tot_panier").val());
    $("#mont_equivalent2").text($("#mont_tot_panier_devise_af").val());
    $("#montant_tot2").val($("#mont_tot_panier").val());
    $("#montant_tot_af2").val($("#mont_tot_panier_devise_af").val());
    var type_client = $("#type_client").val();
    /* if (type_client == 'occasionnel' || type_client == 'table') {
            $('option[value="3"]').hide();
        } else {
            $('option[value="3"]').show();
        } */
    $(".blocqte").addClass("hidden");
    $(".blocoffre").addClass("hidden");
    $(".blocprix").addClass("hidden");
    $(".blocdepense").addClass("hidden");
    $(".blocpaie").removeClass("hidden");
    $("#myModalPaie2").modal("show");
    return false;
  });
  $("#btn_valider_reglement2").click(function (e) {
    e.preventDefault();
    var bool = false;
    var donnees = $(".f_modal_paiement2").serialize();
    var typepaie = $("#attente").val();
    var nbrcouvert = $("#nbrcouvert").val();
    var id_sousresto = $("#id_sousresto").val();
    var urlpg =
      "./Traitement/reglement2.php?do=payer1&nbrcouvert=" +
      nbrcouvert +
      "&id_sousresto=" +
      id_sousresto;
    if (typepaie == "attente") {
      var idfactcl = $("#idfactcl").val();
      var urlpg =
        "./Traitement/reglement2.php?do=payer2&idfactcl=" +
        idfactcl +
        "&nbrcouvert=" +
        nbrcouvert +
        "&id_sousresto=" +
        id_sousresto;
    }

    $.ajax({
      url: urlpg,
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $(".btn_modal").addClass("hidden");
        $(".loader").removeClass("hidden");
      },
      success: function (data) {
        //alert(data);
        if (data.succes) {
          $(".montant").val("");
          $("#myModalPaie2").modal("hide");
          $("#cl_chxi").empty().append("");
          $("#id_cmd").val(0);
          $("#client_id1").val("");
          $("#affiche_commandes").empty();
          $(".listetable_client")
            .empty()
            .load("Traitement/tableajaxcaisse.php");
          $("#nbrcouvert").val(0);
          $("#text_couvert").hide();
          // $('#affichage_tout_produit').empty().load('Traitement/affichage_tout_produit.php');
          // $('#tab_1').empty().load('liste_tbl_maj.php');
          // $('#tab_2').empty().load('liste_cl_maj.php');

          if (typepaie == "attente") {
            $("#attente").val("");
          }
          $(".blrendu").addClass("hidden");
          window.open(
            "impression/examples/ticket.php?num_cmd=" + data.num_commande
          );
          $("#sp_bkg2").text(data.message);
          $("#div_bkg2")
            .removeClass("hidden")
            .addClass("alert-danger")
            .show()
            .fadeOut(4000);
        }
        bool = true;
      },
      complete: function () {
        if (bool) {
          $(".loader").addClass("hidden");
          $(".btn_modal").removeClass("hidden");
        } else {
          $(".loader").removeClass("hidden");
        }
      },
      dataType: "json",
    });
    return false;
  });

  //Filtrage des produits

  $(".filterfamilles").click(function () {
    $("#blc_categorie_produit_vente").removeClass("hidden");
    $("#blc_produit_vente").addClass("hidden");
    $("#sorte_search").val("categorie");
    $("#product_search").val("");
    var motif = "";
    var sorte_search = $("#sorte_search").val("categorie");
    var url = "Traitement/famille_espace_vente.php?motif=" + motif;
    var blc_af_cat = "#blc_categorie_produit_vente";
    $.ajax({
      url: url,
      type: "POST",
      success: function (data) {
        $(blc_af_cat).empty().append(data);
      },
    });
    return false;
  });
  // clic sur button famille service affiche
  $("#blc_categorie_produit_vente").on(
    "click",
    ".famserviceprod",
    function (e) {
      var bool = false;
      var donnees = "";
      var sfam_id = $(this).attr("id");

      var motif = "getcateg";
      var sorte_search = $("#sorte_search").val("categorie");
      var url =
        "Traitement/famille_espace_vente.php?motif=" + motif + "&id=" + sfam_id;
      var blc_af_cat = "#blc_categorie_produit_vente";

      $.ajax({
        url: url,
        type: "POST",
        success: function (data) {
          $(blc_af_cat).empty().append(data);
        },
      });

      return false;
    }
  );

  $(".filterfavoris").click(function () {
    var bool = false;
    var donnees = "";

    $.ajax({
      url: "Traitement/produitsfavoris.php",
      type: "GET",
      data: donnees,

      success: function (data) {
        // console.log(data);
        $("#blc_categorie_produit_vente").addClass("hidden");
        $("#blc_produit_vente").removeClass("hidden");
        $("#blc_produit_vente").html(data);
        $("#sorte_search").val("produit");
      },
    });
    return false;
  });

  $("#myModal_versement").on("keyup", ".usd", function (e) {
    e.preventDefault();
    var totusd = 0;
    $(".usd").each(function () {
      var billet = $(this).attr("billet");
      var nbr_billet = $(this).val();
      var mont = Number(billet * nbr_billet);
      totusd += mont;
      var str = totusd.toString();
      $("#totusd").html(str);
      $("#montant_usd").val(totusd);
    });
  });

  $("#myModal_versement").on("keyup", ".cdf", function (e) {
    e.preventDefault();
    var totcdf = 0;
    $(".cdf").each(function () {
      var billet = $(this).attr("billet");
      var nbr_billet = $(this).val();
      var mont = Number(billet * nbr_billet);
      totcdf += mont;
      var str = totcdf.toString();
      $("#totcdf").html(str);
      $("#montant_cdf").val(totcdf);
    });
  });

  $("#btn_decremente_confirm").click(function (e) {
    e.preventDefault();
    var donnees = $(".frmdecremente").serialize();
    var id_cmd = $("#id_cmd").val();
    $.ajax({
      url: "Traitement/verifcode.php?id_cmd=" + id_cmd,
      type: "POST",
      data: donnees,
      success: function (d) {
        if (d.message == "succes") {
          decrementeQteProduit();
          $(".code").val("");
          $("#decrementeQte-confirm-modal").modal("hide");
        } else if (d.message == "vide") {
          $(".code").val("");
          $(".msgcode").show().fadeOut(4000);
        }
      },
      dataType: "json",
    });

    return false;
  });
  $("#alldatafact").on("click", "#print_fact_all", function (e) {
    e.preventDefault();
    var donnees = $(".filter_frm").serialize();
    var idclient = $("#idclient").val();
    $.ajax({
      url: "Traitement/filtrerdates.php",
      type: "POST",
      data: donnees,
      success: function (d) {
        var param =
          "?d1=" + d.date_bd1 + "&d2=" + d.date_bd2 + "&idclient=" + idclient;
        window.open("./impression/examples/allcredit.php" + param);
      },
      dataType: "json",
    });
    return false;
  });
  $("#blc_main").on("click", "#print_fact_alls", function (e) {
    e.preventDefault();
    var donnees = $(".filter_frm").serialize();
    $.ajax({
      url: "Traitement/filtrerdates.php",
      type: "POST",
      data: donnees,
      success: function (d) {
        // alert(d.date_bd1);
        // alert(d.date_bd2);
        var param = "?d1=" + d.date_bd1 + "&d2=" + d.date_bd2;
        window.open("./impression/examples/allsup.php" + param);
      },
      dataType: "json",
    });
    return false;
  });
  function validatePaiement() {
    var bool = false;
    var donnees = $(".f_modal_paiement").serialize();
    var typepaie = $("#attente").val();
    var nbrcouvert = $("#nbrcouvert").val();
    var id_sousresto = $("#id_sousresto").val();
    var fusion_frm = $("#fusion_frm").val();
    var id_fact_fus = $("#id_fact_fus").val();
    var id_tbl_fus = $("#id_tbl_fus2").val();
    var urlpg =
      "./Traitement/reglement.php?do=payer1&nbrcouvert=" +
      nbrcouvert +
      "&id_sousresto=" +
      id_sousresto;
    if (typepaie == "attente") {
      var idfactcl = $("#idfactcl").val();
      // alert(idfactcl);
      var urlpg =
        "./Traitement/reglement.php?do=payer2&idfactcl=" +
        idfactcl +
        "&nbrcouvert=" +
        nbrcouvert +
        "&id_sousresto=" +
        id_sousresto;
    }
    if (fusion_frm == 1) {
      var idfactcl = $("#idfactcl").val();
      var urlpg =
        "./Traitement/reglementfusion.php?idfactcl=" +
        idfactcl +
        "&nbrcouvert=" +
        nbrcouvert +
        "&id_sousresto=" +
        id_sousresto +
        "&fusion_frm=" +
        fusion_frm +
        "&id_fact_fus=" +
        id_fact_fus +
        "&id_tbl_fus=" +
        id_tbl_fus;
    }

    $.ajax({
      url: urlpg,
      type: "POST",
      data: donnees,
      beforeSend: function () {
        $(".btn_modal").addClass("hidden");
        $(".loader").removeClass("hidden");
      },
      success: function (data) {
        if (data.succes) {
          $(".montant").val("");
          $("#myModal2").modal("hide");
          $("#cl_chxi").empty().append("");
          $("#id_cmd").val(0);
          $("#client_id1").val("");
          $("#affiche_commandes").empty();
          $(".listetable_client")
            .empty()
            .load("Traitement/tableajaxcaisse.php");
          $("#nbrcouvert").val(0);
          $("#text_couvert").hide();
          // $('#affichage_tout_produit').empty().load('Traitement/affichage_tout_produit.php');
          // $('#tab_1').empty().load('liste_tbl_maj.php');
          // $('#tab_2').empty().load('liste_cl_maj.php');

          if (typepaie == "attente") {
            $("#attente").val("");
          }
          $(".blrendu").addClass("hidden");
          if (fusion_frm == 1) {
            window.open(
              "impression/examples/recu_addition_fusion.php?id_fact_fus=" +
                id_fact_fus
            );
          } else {
            window.open(
              "impression/examples/ticket.php?num_cmd=" + data.num_commande
            );
          }
        } else {
          $("#sp_bkg").text(data.message);
          $("#div_bkg")
            .removeClass("hidden")
            .addClass("alert-danger")
            .show()
            .fadeOut(4000);
        }
        bool = true;
      },
      complete: function () {
        if (bool) {
          $(".loader").addClass("hidden");
          $(".btn_modal").removeClass("hidden");
        } else {
          $(".loader").removeClass("hidden");
        }
        $(".blocoffre").addClass("hidden");
        $(".blocprix").addClass("hidden");
        $(".blocqte").addClass("hidden");
        $(".blocdepense").addClass("hidden");
      },
      dataType: "json",
    });
  }
  function decrementeQteProduit() {
    var qte_produit = -1;
    var id_produit = $("#id_produit2").val();
    var repas_resto = $("#repas_resto").val();
    var id_produit1 = $("#id_produit").val();
    var action = "moins";
    var donnees = "";
    if (id_produit1 !== "") {
      $.ajax({
        url:
          "Traitement/tableau_affichage_commandes.php?id_produit=" +
          id_produit +
          "&qte_produit=" +
          qte_produit +
          "&repas_resto=" +
          repas_resto +
          "&id_produit1=" +
          id_produit1 +
          "&action=" +
          action,
        type: "POST",
        data: donnees,
        success: function (data) {
          // alert(data);
          $("#affiche_commandes").html(data);
          $("#alert_qte").show().fadeOut(6000);
          // $("#div_remise").show();
        },
      });
    }
  }
  function deconnexionAuto() {
    setTimeout(function () {
      $.ajax({
        url: "Traitement/autologout.php",
        type: "GET",
        success: function (data) {
          if (data.bool) {
            window.location.href = "../Authentification/logout.php ";
          }
        },
        dataType: "json",
      });
      deconnexionAuto();
    }, 1800000);
  }
  deconnexionAuto();
});
