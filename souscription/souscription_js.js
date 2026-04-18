// JavaScript Document
$(document).ready(function () {
    
    function CBPack(pack) {
        var CB = '';
        if (pack == 1) {
            CB = "cb_caisse";
        } else if (pack == 4) {
            CB = "cb_hebergement";
        } else if (pack == 2) {
            CB = "cb_stock";
        } else if (pack == 5) {
            CB = "cb_prestaurant";
        } else if (pack == 6) {
            CB = "cb_photel";
        } else if (pack == 7) {
            CB = "cb_prh";
        }
        return CB;
    }

    function CocherPackIntell(pack) {
        //  alert(pack);
        if (pack == 1) {
            if ($('#cb_photel').prop('checked')) {
                $('#' + CBPack(pack)).replaceWith('<input id="' + CBPack(pack) + '" name="modules[]" type="checkbox" class="flat elmt_checked" value="' + pack + '">');
                $('#msg1').empty().append('Le module caisse est déjà compris dans le pack hotel').show();
            } else if ($('#cb_prestaurant').prop('checked')) {
                $('#' + CBPack(pack)).replaceWith('<input id="' + CBPack(pack) + '" name="modules[]" type="checkbox" class="flat elmt_checked" value="' + pack + '">');
                $('#msg1').empty().append('Le module caisse est déjà compris dans le pack restaurant').show();
            } else {
                $('#' + CBPack(pack)).attr('checked', 'true');
            }
        } else if (pack == 2) {
            if ($('#cb_photel').prop('checked')) {
                $('#' + CBPack(pack)).replaceWith('<input id="' + CBPack(pack) + '" name="modules[]" type="checkbox" class="flat elmt_checked" value="' + pack + '">');
                $('#msg1').empty().append('Le module stock est déjà compris dans le pack hotel').show();
            } else if ($('#cb_prestaurant').prop('checked')) {
                $('#' + CBPack(pack)).replaceWith('<input id="' + CBPack(pack) + '" name="modules[]" type="checkbox" class="flat elmt_checked" value="' + pack + '">');
                $('#msg1').empty().append('Le module stock est déjà compris dans le pack restaurant').show();
            }
            else {
                $('#' + CBPack(pack)).attr('checked', 'true');
            }
        } else if (pack == 4) {
            if ($('#cb_photel').prop('checked')) {
                $('#' + CBPack(pack)).replaceWith('<input id="' + CBPack(pack) + '" name="modules[]" type="checkbox" class="flat elmt_checked" value="' + pack + '">');
                $('#msg1').empty().append('Le module hebergement est déjà compris dans le pack hotel').show();
            } else {
                $('#' + CBPack(pack)).attr('checked', 'true');
            }
        } else if (pack == 5) {
            if ($('#cb_photel').prop('checked')) {
                $('#' + CBPack(pack)).replaceWith('<input id="' + CBPack(pack) + '" name="modules[]" type="checkbox" class="flat elmt_checked" value="' + pack + '">');
                $('#msg1').empty().append('Le pack restaurant est déjà compris dans le pack hotel').show();
            } else {
                $('#' + CBPack(pack)).attr('checked', 'true');
                $("#cb_stock").replaceWith('<input id="cb_stock" name="modules[]" type="checkbox" class="flat elmt_checked" value="2">');
                $("#cb_caisse").replaceWith('<input id="cb_caisse" name="modules[]" type="checkbox" class="flat elmt_checked" value="1">');
            }
        }
        else if (pack == 6) {
            $('#' + CBPack(pack)).attr('checked', 'true');
            $("#cb_stock").replaceWith('<input id="cb_stock" name="modules[]" type="checkbox" class="flat elmt_checked" value="2">');
            $("#cb_prestaurant").replaceWith('<input id="cb_prestaurant" name="modules[]" type="checkbox" class="flat elmt_checked" value="5">');
            $("#cb_caisse").replaceWith('<input id="cb_caisse" name="modules[]" type="checkbox" class="flat elmt_checked" value="1">');
            $("#cb_hebergement").replaceWith('<input id="cb_hebergement" name="modules[]" type="checkbox" class="flat elmt_checked" value="4">');
        }
        else if (pack == 7) {
            $('#' + CBPack(pack)).attr('checked', 'true');
//            $("#cb_stock").replaceWith('<input id="cb_stock" name="modules[]" type="checkbox" class="flat elmt_checked" value="2">');
//            $("#cb_prestaurant").replaceWith('<input id="cb_prestaurant" name="modules[]" type="checkbox" class="flat elmt_checked" value="5">');
//            $("#cb_caisse").replaceWith('<input id="cb_caisse" name="modules[]" type="checkbox" class="flat elmt_checked" value="1">');
//            $("#cb_hebergement").replaceWith('<input id="cb_hebergement" name="modules[]" type="checkbox" class="flat elmt_checked" value="4">');
            
        }
    }

    function MajPrix(module) {
        var donnees = '';
        var selected = '';
        var selected_agent = '';
        var souscription = 0;
        var prix_agent = 0;
        var nombre_user = 0;
        var montant_caisse = 0;
        var montant_stock = 0;
        var montant_prestaurant = 0;
        var montant_hebergement = 0;
        var montant_photel = 0;
        var montant_prh = 0;
        var montant_tot = 0;
        var chaine = '';
        if (module == 1 && $('#cb_caisse').prop('checked')) {
            selected = $("#slt_caisse option:selected");
            souscription = selected.val();
            nombre_user = $("#txt_caisse").val();
        } else if (module == 4 && $('#cb_hebergement').prop('checked')) {
            selected = $("#slt_hebergement option:selected");
            souscription = selected.val();
            nombre_user = $("#txt_hebergement").val();
        } else if (module == 2 && $('#cb_stock').prop('checked')) {
            selected = $("#slt_stock option:selected");
            souscription = selected.val();
            nombre_user = $("#txt_stock").val();
        } else if (module == 5 && $('#cb_prestaurant').prop('checked')) {
            selected = $("#slt_prestaurant option:selected");
            souscription = selected.val();
            nombre_user = $("#txt_prestaurant").val();
        } else if (module == 6 && $('#cb_photel').prop('checked')) {
            selected = $("#slt_photel option:selected");
            souscription = selected.val();
            nombre_user = $("#txt_photel").val();
        }else if (module == 7 && $('#cb_prh').prop('checked')) {
            selected = $("#slt_prh option:selected");
            souscription = selected.val();
//            selected_agent = $("#agent_prh option:selected");
            prix_agent = $("#agent_prh").val();
            nombre_user = $("#txt_prh").val();
        }
        donnees = 'module=' + module + '&souscription=' + souscription + '&nombre_user=' + nombre_user + '&prix_agent=' + prix_agent;
        $.ajax({
            url: 'souscription/prix_utilisateur.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (module == 1 && $('#cb_caisse').prop('checked')) {
                    $("#lbl_caisse").empty().append('$' + data);
                    $("#prix_caisse").val(data);
                } else if (module == 5 && $('#cb_prestaurant').prop('checked')) {
                    $("#lbl_prestaurant").empty().append('$' + data);
                    $("#prix_prestaurant").val(data);
                } else if (module == 4 && $('#cb_hebergement').prop('checked')) {
                    $("#lbl_hebergement").empty().append('$' + data);
                    $("#prix_hebergement").val(data);
                } else if (module == 2 && $('#cb_stock').prop('checked')) {
                    $("#lbl_stock").empty().append('$' + data);
                    $("#prix_stock").val(data);
                } else if (module == 6 && $('#cb_photel').prop('checked')) {
                    $("#lbl_photel").empty().append('$' + data);
                    $("#prix_photel").val(data);
                } else if (module == 7 && $('#cb_prh').prop('checked')) {
                    $("#lbl_prh").empty().append('$' + data);
                    $("#prix_prh").val(data);
                }
                if ($('#cb_caisse').prop('checked')) {
                    montant_caisse = parseInt($("#lbl_caisse").text().slice(1))
                }
                if ($('#cb_stock').prop('checked')) {
                    montant_stock = parseInt($("#lbl_stock").text().slice(1))
                }
                if ($('#cb_prestaurant').prop('checked')) {
                    montant_prestaurant = parseInt($("#lbl_prestaurant").text().slice(1))
                }
                if ($('#cb_hebergement').prop('checked')) {
                    montant_hebergement = parseInt($("#lbl_hebergement").text().slice(1))
                }
                if ($('#cb_photel').prop('checked')) {
                    montant_photel = parseInt($("#lbl_photel").text().slice(1))
                }
                if ($('#cb_prh').prop('checked')) {
                    montant_prh = parseFloat($("#lbl_prh").text().slice(1));
                }
                montant_tot = montant_caisse + montant_stock + montant_prestaurant + montant_hebergement + montant_photel + montant_prh;
                chaine = montant_tot + ""
                $("#tot_souscri").empty().append('$' + chaine);

            }
        });
    }

    function MajPrix2(module, souscription, nombre_user, lbl, prix, prix_agent) {
        var montant_caisse = 0;
        var montant_stock = 0;
        var montant_prestaurant = 0;
        var montant_hebergement = 0;
        var montant_photel = 0;
        var montant_prh = 0;
        var montant_tot = 0;
        var chaine = '';
        var donnees;
        donnees = 'module=' + module + '&souscription=' + souscription + '&nombre_user=' + nombre_user + '&prix_agent=' + prix_agent;
        $.ajax({
            url: 'souscription/prix_utilisateur.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                //alert(data);
                $("#" + lbl).empty().append('$' + data);
                $("#" + prix).val(data);
                if ($('#cb_caisse').prop('checked')) {
                    montant_caisse = parseInt($("#lbl_caisse").text().slice(1))
                }
                if ($('#cb_stock').prop('checked')) {
                    montant_stock = parseInt($("#lbl_stock").text().slice(1))
                }
                if ($('#cb_prestaurant').prop('checked')) {
                    montant_prestaurant = parseInt($("#lbl_prestaurant").text().slice(1))
                }
                if ($('#cb_hebergement').prop('checked')) {
                    montant_hebergement = parseInt($("#lbl_hebergement").text().slice(1))
                }
                if ($('#cb_photel').prop('checked')) {
                    montant_photel = parseInt($("#lbl_photel").text().slice(1))
                }
                if ($('#cb_prh').prop('checked')) {
                    montant_prh = parseFloat($("#lbl_prh").text().slice(1));
                }
                montant_tot = montant_caisse + montant_stock + montant_prestaurant + montant_hebergement + montant_photel + montant_prh;
                chaine = montant_tot + ""
                $("#tot_souscri").empty().append('$' + chaine);

            }
        });
    }

    $('.commande').click(function () {
        var module = $(this).attr('mod');
        CocherPackIntell(module);
        MajPrix(module);
    });
    $("#contact-form").on('click', '.elmt_checked', function () {
        var module = $(this).attr('value');
        if ($('#' + CBPack(module)).prop('checked')) {
            CocherPackIntell(module);
            MajPrix(module);
            // alert(module);
        } else {
            CocherPackIntell(module);
            MajPrix(module);
        }
    });
    //Script module Caisse
    $("#txt_caisse").bind('keyup mouseup', function () {
        var selected = $("#slt_caisse option:selected");
        var module;
        var souscription;
        var nombre_user;
        var lbl;
        var prix;
        var prix_agent = 0;
        module = '1';
        souscription = selected.val();
        nombre_user = $("#txt_caisse").val();
        lbl = 'lbl_caisse';
        prix = 'prix_caisse';
        MajPrix2(module, souscription, nombre_user, lbl, prix, prix_agent);
    });
    function onSelectChange_caisse() {
        var selected = $("#slt_caisse option:selected");
        var module;
        var souscription;
        var nombre_user;
        var lbl;
        var prix;
        var prix_agent = 0;
        module = '1';
        souscription = selected.val();
        nombre_user = $("#txt_caisse").val();
        lbl = 'lbl_caisse';
        prix = 'prix_caisse';
        MajPrix2(module, souscription, nombre_user, lbl, prix, prix_agent);
    }

    $("#slt_caisse").change(onSelectChange_caisse);
    //Fin script module Caisse
    //Script pack Restaurant
    $("#txt_prestaurant").bind('keyup mouseup', function () {
        var selected = $("#slt_prestaurant option:selected");
        var module;
        var souscription;
        var nombre_user;
        var lbl;
        var prix;
        var prix_agent = 0;
        module = '5';
        souscription = selected.val();
        nombre_user = $("#txt_prestaurant").val();
        lbl = 'lbl_prestaurant';
        prix = 'prix_prestaurant';
        MajPrix2(module, souscription, nombre_user, lbl, prix, prix_agent);
    });
    function onSelectChange_prestaurant() {
        var selected = $("#slt_prestaurant option:selected");
        var module;
        var souscription;
        var nombre_user;
        var lbl;
        var prix;
        var prix_agent = 0;
        module = '5';
        souscription = selected.val();
        nombre_user = $("#txt_prestaurant").val();
        lbl = 'lbl_prestaurant';
        prix = 'prix_prestaurant';
        MajPrix2(module, souscription, nombre_user, lbl, prix, prix_agent);
    }

    $("#slt_prestaurant").change(onSelectChange_prestaurant);
    //Fin script pack Restaurant
    //Script module Stock
    $("#txt_stock").bind('keyup mouseup', function () {
        var selected = $("#slt_stock option:selected");
        var module;
        var souscription;
        var nombre_user;
        var lbl;
        var prix;
        var prix_agent = 0;
        module = 2;
        souscription = selected.val();
        nombre_user = $("#txt_stock").val();
        lbl = 'lbl_stock';
        prix = 'prix_stock';
        MajPrix2(module, souscription, nombre_user, lbl, prix, prix_agent);
    });
    function onSelectChange_stock() {
        var selected = $("#slt_stock option:selected");
        var module;
        var souscription;
        var nombre_user;
        var lbl;
        var prix;
        var prix_agent = 0;
        module = 2;
        souscription = selected.val();
        nombre_user = $("#txt_stock").val();
        lbl = 'lbl_stock';
        prix = 'prix_stock';
        MajPrix2(module, souscription, nombre_user, lbl, prix, prix_agent);
    }

    $("#slt_stock").change(onSelectChange_stock);
    //Fin script module Stock
    //Script module heberge
    $("#txt_hebergement").bind('keyup mouseup', function () {
        var selected = $("#slt_hebergement option:selected");
        var module;
        var souscription;
        var nombre_user;
        var lbl;
        var prix;
        var prix_agent = 0;
        module = 4;
        souscription = selected.val();
        nombre_user = $("#txt_hebergement").val();
        lbl = 'lbl_hebergement';
        prix = 'prix_hebergement';
        MajPrix2(module, souscription, nombre_user, lbl, prix, prix_agent);
    });
    function onSelectChange_hebergement() {
        var selected = $("#slt_hebergement option:selected");
        var module;
        var souscription;
        var nombre_user;
        var lbl;
        var prix;
        var prix_agent = 0;
        module = 4;
        souscription = selected.val();
        nombre_user = $("#txt_hebergement").val();
        lbl = 'lbl_hebergement';
        prix = 'prix_hebergement';
        MajPrix2(module, souscription, nombre_user, lbl, prix, prix_agent);
    }

    $("#slt_hebergement").change(onSelectChange_hebergement);
    //Fin script module heberge
    //Script module hotel
    $("#txt_photel").bind('keyup mouseup', function () {
        var selected = $("#slt_photel option:selected");
        var module;
        var souscription;
        var nombre_user;
        var lbl;
        var prix;
        var prix_agent = 0;
        module = 6;
        souscription = selected.val();
        nombre_user = $("#txt_photel").val();
        lbl = 'lbl_photel';
        prix = 'prix_photel';
        MajPrix2(module, souscription, nombre_user, lbl, prix, prix_agent);
    });
    function onSelectChange_photel() {
        var selected = $("#slt_photel option:selected");
        var module;
        var souscription;
        var nombre_user;
        var lbl;
        var prix;
        var prix_agent = 0;
        module = 6;
        souscription = selected.val();
        nombre_user = $("#txt_photel").val();
        lbl = 'lbl_photel';
        prix = 'prix_photel';
        MajPrix2(module, souscription, nombre_user, lbl, prix, prix_agent);
    }

    $("#slt_photel").change(onSelectChange_photel);
    //Fin script module hotel
    
    //Script module RH
    $("#txt_prh").bind('keyup mouseup', function () {
        var selected = $("#slt_prh option:selected");
        var module;
        var souscription;
        var nombre_user;
        var lbl;
        var prix;
        var prix_agent;
        var selected_agent;
        module = 7;
        souscription = selected.val();
        nombre_user = $("#txt_prh").val();
        lbl = 'lbl_prh';
        prix = 'prix_prh';
//        selected_agent = $("#agent_prh option:selected");
        prix_agent = $("#agent_prh").val();
        MajPrix2(module, souscription, nombre_user, lbl, prix, prix_agent);
    });
    function onSelectChange_rh() {
        var selected = $("#slt_prh option:selected");
        var module;
        var souscription;
        var nombre_user;
        var lbl;
        var prix;
        var prix_agent;
        var selected_agent;
        module = 7;
        souscription = selected.val();
        nombre_user = $("#txt_prh").val();
        lbl = 'lbl_prh';
        prix = 'prix_prh';
//        selected_agent = $("#agent_prh option:selected");
        prix_agent = $("#agent_prh").val();
        MajPrix2(module, souscription, nombre_user, lbl, prix, prix_agent);
    }

    $("#slt_prh").change(onSelectChange_rh);

    $("#agent_prh").bind('keyup mouseup', function () {
        var selected = $("#slt_prh option:selected");
        var module;
        var souscription;
        var nombre_user;
        var lbl;
        var prix;
        var prix_agent;
        var selected_agent;
        module = 7;
        souscription = selected.val();
        nombre_user = $("#txt_prh").val();
        lbl = 'lbl_prh';
        prix = 'prix_prh';
//        selected_agent = $("#agent_prh option:selected");
        prix_agent = $("#agent_prh").val();
        MajPrix2(module, souscription, nombre_user, lbl, prix, prix_agent);
    });
    //Fin script module RH
	
	
	var contactForm = $("#contact-form");
    //We set our own custom submit function
    contactForm.on("submit", function (e) {
        //Prevent the default behavior of a form
        e.preventDefault();
        
        if (!($('#tc').prop('checked'))) {
            $('#msg').empty().append('<i class="fa fa-info-circle"></i> Veuillez cocher Termes & conditions!').show().fadeOut(4000);
        } else {
           //Get the values from the form
            var nom = $("#nom").val();
            var prenom = $("#prenom").val();
            var tel = $("#tel").val();
            var email = $("#email").val();
            var login = $("#login").val();
            var mdp = $("#mdp").val();
            var compagnie = $("#compagnie").val();
            var pack_id = $("#pack_id").val();
            //alert(compagnie);
            var bool=false;
            //Our AJAX POST
            $.ajax({
                type: "POST",
                url: "souscription/souscription_traitement.php",
                data: {
                    nom: nom,
                    prenom: prenom,
                    tel: tel,
                    email: email,
                    login: login,
                    mdp: mdp,
                    compagnie: compagnie,
                    pack_id: pack_id,
                    //THIS WILL TELL THE FORM IF THE USER IS CAPTCHA VERIFIED.
                    captcha: grecaptcha.getResponse()
                },
                beforeSend: function () {
                    $("#loader1").removeClass('hidden');
                    $("#enregistrer_souscription").addClass('hidden');
                },
                success: function (data) {
                    bool=true;
                    if (data.message_vide =='vide') {
                        $('#msg').empty().append('Veuillez remplir les champs vides!').show().fadeOut(4000);
                    } else if (data.message_succes =='succes') {
                        $('#nom').attr('placeholder','Nom...'); 
                        $('#prenom').attr('placeholder','Prenom...'); 
                        $('#tel').attr('placeholder','Téléphone...'); 
                        $('#email').attr('placeholder','Email...'); 
                        $('#login').attr('placeholder','Login...'); 
                        $('#mdp').attr('placeholder','Mot de passe...'); 
                        $('#compagnie').attr('placeholder','Entreprise / Sotièté...'); 
                        $('.cachediv').show();
                        $('#compteform').hide(); 
                        window.open('waitActivation.php');
                    } else if (data.message_error =='error') {
						$('#msg').empty().append('This user was not verified by recaptcha!').show().fadeOut(4000);
					}
                    
                },complete: function () {
                    if (bool) {
                        $("#loader1").addClass('hidden');
                        $("#enregistrer_souscription").removeClass('hidden');

                    } else {
                        $("#loader1").removeClass('hidden');
                    }
                } , dataType: 'json'
            })
        }
        
    });
	
    
    $('#enregistrer_souscription1').click(function (e) {
        e.preventDefault();
      //  alert('ok');
          if (!($('#tc').prop('checked'))) {
            $('#msg').empty().append('<i class="fa fa-info-circle"></i> Veuillez cocher Termes & conditions!').show().fadeOut(4000);
        } else {
            
            //traitement
            var bool=false;
            var donnees = $('#contact-form').serialize();  
            $.ajax({
                url: 'souscription/souscription_traitement.php',
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader1").removeClass('hidden');
                    $("#enregistrer_souscription").addClass('hidden');
                },
                success: function (data) {
                    bool=true;
                     if (data.message_vide =='vide') {
                        $('#msg').empty().append('Veuillez remplir les champs vides!').show().fadeOut(4000);
                    } else if (data.message_succes =='succes') {
                        $('#nom').attr('placeholder','Nom...'); 
                        $('#prenom').attr('placeholder','Prenom...'); 
                        $('#tel').attr('placeholder','Téléphone...'); 
                        $('#email').attr('placeholder','Email...'); 
                        $('#login').attr('placeholder','Login...'); 
                        $('#mdp').attr('placeholder','Mot de passe...'); 
                        $('#compagnie').attr('placeholder','Entreprise / Sotièté...'); 
                        $('.cachediv').show();
                        $('#compteform').hide(); 
                        window.open('waitActivation.php');
                    }

                },complete: function () {
                    if (bool) {
                        $("#loader1").addClass('hidden');
                        $("#enregistrer_souscription").removeClass('hidden');

                    } else {
                        $("#loader1").removeClass('hidden');
                    }
                } , dataType: 'json'
                
            });
            //fin traitement
        }
        
    });
    $('#valider_souscription').click(function (e) {
        e.preventDefault();
        var donnees = '';
        var mode_paie = $('input[name="mode_paie"]:checked').val();

        $.ajax({
            url: 'souscription/valider_souscription.php?mode_paie=' + mode_paie,
            type: 'POST',
            data: donnees,
            beforeSend: function () {
                $("#loader").removeClass('hidden');
                },
            success: function (data) {
                //alert(data);
                $('.mail_activ').show();
                $('#annuler_souscription').hide();
                $('#valider_souscription').hide();
                $('#resume_souscri').hide();
                $("#loader").addClass('hidden');
            }
        });


    });
    $('#annuler_souscription').click(function (e) {
        $('#resume_souscri').hide();
        $('#form_souscri').show();
        $('.section_page').show();
        $(window).scrollTop(3000);

    });
    
    $('.btnesgrat').click(function (e) {
        $('.cachediv').hide();
        $('#compteform').show();
        var idpack = $(this).attr('id');
        $('#pack_id').val(idpack);
     
    });
       $('#renvoyermail').click(function (e) {
        var donnees='';
         e.preventDefault();
         $.ajax({
            url: 'souscription/renvoyer_mail.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
               // alert(data);
                if(data.statut='envoye'){
                    alert('msg envoyé');
                }else{
                    alert('msg non envoyé');
                }
            } , dataType: 'json'
        });

     
    });
    
});
