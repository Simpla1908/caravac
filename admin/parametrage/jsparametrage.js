// JavaScript Document
$(document).ready(function () {
    $('.edit_prix').click(function (e) {
        var module;
        var moduleid;
        var souscription;
        var prixuser;
        var prixid;
        module = $(this).attr('module');
        moduleid = $(this).attr('moduleid');
        souscription = $(this).attr('souscription');
        prixuser = $(this).attr('prixuser');
        prixpuser = $(this).attr('prixpuser');
        prixid = $(this).attr('prixid');
        $('#moduleid').val(moduleid);
        $('.nom_module').val(module);
        $('#licence').val(module);
        $('#module').val(module);
        $('.sous_module').val(souscription);
        $('#moduleprix').val(prixuser);
        $('#moduleprix_user').val(prixpuser);
        $('#souscription').val(souscription);
        $('#prixid').val(prixid);


    });
    $('#save_changes').click(function (e) {
        prixid = $('#prixid').val();
        e.preventDefault();
        var donnees = $('#form_prix').serialize();
        var prixuser = $('#moduleprix').val();
        var prixpuser = $('#moduleprix_user').val();
        if (prixuser > 0 && prixpuser > 0) {
            $.ajax({
                url: '../parametrage/phpparametrage.php',
                type: 'POST',
                data: donnees,
                success: function (data) {
                    // alert(data);
                    $('#modal_prix').modal('hide');
                    $('#prix' + prixid).empty().append('$' + prixuser);
                    $('#prixp' + prixid).empty().append('$' + prixpuser);
                    $('#td_content' + prixid).empty().append(data);

                }
            });
        } else {
            $('#msg').empty().append('Veuillez remplir ces champs vides').show().fadeOut(4000);
        }
        ;


    });
    $('#maj_tva').click(function (e) {
        e.preventDefault();
        var donnees = $('#form_tva').serialize();
            $.ajax({
                url: '../parametrage/majtva.php',
                type: 'POST',
                data: donnees,
                success: function (data) {
                    // alert(data);
                    $('#myModaltva').modal('hide');
                }
            });
    });


});