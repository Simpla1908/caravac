<?php include('Gerant_global.php'); ?>
<?php include('head.php'); ?>
<?php include('menu_Rec_config.php'); ?>
<?php include("../bdd/connexion.php"); ?>
<?php include("../FUNCTION/hebergement.php");
    $pack_id = 31;
    $prix_user =0;
    $requete= $bdd->prepare("SELECT prix_user FROM prix 
                            WHERE module_id=:pack_id");
    $requete->BindParam(':pack_id', $pack_id);
    $requete->execute();
    while ($donnees = $requete->fetch()) {
        $prix_user = $donnees['prix_user'];
    } 
?>

<div id="page-wrapper">
   
    <div class="row">
         <br>
     <div class="status alert alert-danger col-md-12" id='msg1' style="display:none">
    <i class="fa fa-info-circle"></i> Veuillez remplir ces champs vides
    </div>
        <div class="col-lg-12">
            <h3 class="page-header">Mes souscriptions<?php // echo $_SESSION['lastload']?></h3>

           
            <div class="panel panel-default">
          <div class="panel-heading">
                    <h4>
                        Liste 
                        <div class="btn-group btn-group-sm pull-right">
                            <a href="#" data-toggle="modal" data-target="#appstore" class="btn btn-danger listingpack" title="Ajouter un module"><i class="fa fa-th"></i> Ajouter module</a>
                            <a href="#" data-toggle="modal" data-target="#adduser" class="btn btn-primary" title="Ajouter le nombre d'utilisateur"><i class="fa fa-user-plus"></i> Ajouter nbre utilisateur</a>
                        </div>
                    </h4>
                </div>

                <!-- /.panel-heading -->
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Désignation</th>
                                    <th>Période</th>
                                    <th>Statut</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="majdatasouscript">
                                <?php
                        $i = 1;
                        $requete= $bdd->prepare("SELECT *
                                                FROM souscription 
                                                WHERE site_id=:site_id
                                                ORDER BY id");
                        $requete->BindParam(':site_id', $_SESSION['id_hotel']);
                        $requete->execute();
                        while ($donnees = $requete->fetch()) {
                            $id = $donnees['id'];
                            $libelle = $donnees['libelle'];
                            $type_souscription = $donnees['type_souscription'];
                            $date1 = $donnees['date_activ'];
                            $statut = $donnees['statut'];
                            $etat=$donnees['etat'];
                            $date2 = $donnees['dte_echeance'];
                            $dtesous = dateAffiche($donnees['date_sous']);
                            $periode='Du '.dateAffiche($date1).' au '.dateAffiche($date2);
                        ?>
                                <tr>
                                    <td> <?php echo $i;?> </td>
                                    <td><a href="#" statut="<?php echo $statut;?>" dtesous="<?php echo $dtesous;?>" id="<?php echo $id;?>" lib="<?php echo $libelle;?>" type="<?php echo $type_souscription;?>" title="détails souscription" class="detail_souscript" data-toggle="modal" data-target="#detail_souscription"> <?php echo $libelle;?> </a></td>
                                    <td><?php echo $periode;?></td>
                                    <td>
                                <?php
                                if($statut=='demo'){  
                                    if($etat==1){
                                ?> 
                                <span class="label label-info">Démo</span>
                                <?php
                                }else{
                                ?> 
                                <span class="label label-danger">Désactivé</span>
                                 <?php
                                }
                                ?>
                                <?php
                                }elseif($statut=='abonne'){     
                                    if($etat==1){
                                ?> 
                                <span class="label label-success">Abonné</span>
                                <?php
                                }else{
                                ?> 
                                <span class="label label-danger">Désactivé</span>
                                 <?php
                                }
                                }
                                ?> 
                                    </td>
                                    <td align="center"><a href="factures_company.php?souscription_id=<?php echo $id;?>" class="btn btn-primary btn-xs" ><i class="fa fa-files-o"></i> Factures</a></td>
                                    <td align="center"><a href="#" id="<?php echo $id;?>" lib="<?php echo $libelle;?>" <?php if($statut!='demo'){ ?> disabled="disabled" <?php } ?> class="btn btn-success btn-xs upgrade_souscript" data-toggle="modal" data-target="#upgrade">Upgrade <i class="fa fa-external-link"></i></a></td>
                                </tr>
                               <?php
                               $i++;
                                }
                                ?> 
                            </tbody>
                        </table>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>  <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper 

<!-- Modal AJOUTER MODULE -->
<div class="modal fade" id="appstore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form id="frmsouscript" name="frmsouscript" method="post" action="Traitement/save_souscript_trait.php">
    <div class="modal-dialog modal-lgs">
        <div class="modal-content" id="modalcontentappstore">
            <div class="feature-2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><span class="fa fa-shopping-cart"></span> <b>EBU - App Store</b></h4>
                Décuplez vos activités en cochant sur un ou plusieurs modules et cliquez sur le button Essai gratuit !!!
            </div>
              <div class="status alert alert-danger col-md-12" id='msg2' style="display:none">
                                <i class="fa fa-info-circle"></i> Veuillez remplir ces champs vides
                            </div>
            <div class="modal-body">
                  <input type="hidden"  id="existepackdssite" name="existepackdssite" value="0">
                 <input type="hidden"  id="id_pack" name="id_pack" value="0">

                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-list-alt"></i>    
                            <h4><input type="radio"  id="1" name="packs[]" value="1" class="flat-red choice_pack"> Comptabilité</h4>
                        </div>
                    </div><!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-home"></i>    
                            <h4><input type="radio" id="4" name="packs[]" value="4" class="flat-red choice_pack"> Hebergement</h4>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-user"></i>    
                            <h4><input type="radio" id="7" name="packs[]" value="7" class="flat-red choice_pack"> Ress. Humaines</h4>
                        </div>
                    </div><!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-database"></i>    
                            <h4><input type="radio" id="2" name="packs[]" value="2" class="flat-red choice_pack"> Stock</h4>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-hospital-o"></i>    
                            <h4><input type="radio" id="6" name="packs[]" value="6" class="flat-red choice_pack"> EBU - Hôtel</h4>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-cutlery"></i>    
                            <h4><input type="radio" id="5" name="packs[]" value="5" class="flat-red choice_pack"> EBU - Restaurant</h4>
                        </div>
                    </div><!-- /.col-md-3 -->

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-clipboard"></i>    
                            <h4><input type="radio" id="30" name="packs[]" value="30" class="flat-red choice_pack"> EBU - Pos</h4>
                        </div>
                    </div><!-- /.col-md-3 -->
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="feature-2">
                            <i class="fa fa-file-text-o"></i>    
                            <h4><input type="radio" id="29" name="packs[]" value="29" class="flat-red choice_pack"> EBU - Facturation</h4>
                        </div>
                    </div><!-- /.col-md-3 -->

                </div><!-- /.row -->
            </div>
            <div class="modal-footer feature-2">
                <a href="#" id="save_souscript" class="btn1 btn-lg btn-main">Essai Gratuit</a>
                  <span class="btn btn-danger hidden" id="loader1">
                  <i class="fa fa-refresh fa-spin fa-1x"></i> exécution en cours
                  </span>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
     </form>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Modal UPGRADE -->
<div class="modal fade" id="upgrade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lgm">
        <div class="modal-content" id="modalcontentupgrade">
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Modal AJOUTER UTILISATEUR-->
<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="feature-2">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><span class="fa fa-user"></span> <b>EBU - Users</b> </h4>
                Ajouter le nombre d'utilisateur dans votre site moyenant un paiemant. <br> 1 utilisateur = 2.5$
            </div>
            <form method="post" id="add_user_form" action="" data-parsley-validate class="form-horizontal form-label-left">
                <div class="modal-body" id="user_bloc">
                    <?php 
                        $pack_id = 31;
                        $prix_user =0;
                        $requete= $bdd->prepare("SELECT prix_user FROM prix 
                                                WHERE module_id=:pack_id");
                        $requete->BindParam(':pack_id', $pack_id);
                        $requete->execute();
                        while ($donnees = $requete->fetch()) {
                            $prix_user = $donnees['prix_user'];
                        }
                    ?>
                    <div class="row">
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="nbre_user">Nombre utilisateur :
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input value="" type="text" id="nbre_user" name="nbre_user" required class="form-control col-md-7 col-xs-12">
                                <input type="text" id="prix_user" name="prix_user" value="<?php echo $prix_user;?>" class="form-control col-md-7 col-xs-12 hidden">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12" for="montant">Montant à payer :
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="input-group">
                                    <input value="" type="text" id="montant" name="montant" required disabled="disabled" class="form-control col-md-7 col-xs-12">
                                    <span class="input-group-addon">$</span>
                                </div>
                                <input value="" type="text" id="mont_payer" name="mont_payer" class="form-control col-md-7 col-xs-12 hidden">
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <p id='msg_err' class="text-muted alert alert-danger no-shadow" style="margin-top: 10px; display:none">
                                Veuillez passez dans nos installations pour payer l'activation de nombres d'utilisateur que vous venez d'ajouter dans votre système. Merci!!!
                            </p>
                        </div>

                    </div>
                </div>
                <div class="modal-footer btn-center">
                    <button class="btn btn-danger hidden" id="loader">
                        <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                    </button>
                    <button type="submit" name="valider" id="valider" class="btn btn-success"><i class="fa fa-check-circle"></i> Valider</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- Modal UPGRADE -->
<div class="modal fade" id="detail_souscription" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content" id="modalcontentdetail">
            
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- jQuery -->
<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {        
//        alert("ok");
        $('#dataTables-example').dataTable();
        $('.setting-module').click(function (e) {
            e.preventDefault();
            var url = $(this).attr('href');
            var params = url.split("?");
            $.ajax({
                url: 'Traitement/maj-id-site.php?' + params[1],
                type: 'POST',
                success: function (data) {
                    window.location.href = url;
                }
            });

        });
    $("#modalcontentappstore").on('click', '#save_souscript', function (e) {
        e.preventDefault();
         //traitement
        // alert('ok');
            var bool=false;
            var donnees = $('#frmsouscript').serialize();  
            $.ajax({
                url: 'Traitement/save_souscript_trait.php',
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#loader1").removeClass('hidden');
                    $("#save_souscript").addClass('hidden');
                },
                success: function (data) {
                    bool=true;
                    //alert(data);
                     if (data.message =='aucun') {
                     $('#msg2').empty().append('Veuillez cocher au moins un module et/ou pack').show().fadeOut(4000);
                    } else if (data.message=='doublon') {
                        alert('doublon');
                    }else if (data.message=='succes') {
                        $.ajax({
                            url: 'datas_souscript.php',
                            type: 'POST',
                            success: function (data) {
                                //mise a jour
                                $("#appstore").modal('hide');
                                $('#majdatasouscript').empty().append(data);
                                $.ajax({
                                    url: 'listingdataappstore.php',
                                    type: 'POST',
                                    success: function (d) {
                                        $('#modalcontentappstore').empty().append(d);
                                    }

                                });
                                 $('#msg1').empty().append('Souscription effectuée avec succes').show().fadeOut(4000);


                            }

                        });

                    }

                },complete: function () {
                    if (bool) {
                        $("#loader1").addClass('hidden');
                        $("#save_souscript").removeClass('hidden');

                    } else {
                        $("#loader1").removeClass('hidden');
                    }
                } , dataType: 'json'
                
            });
            //fin traitement
        
    }); 
    $("#majdatasouscript").on('click','.upgrade_souscript', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var lib = $(this).attr('lib');
         $.ajax({
                url: 'tableau_upgrade.php?id=' + id + '&lib=' + lib,
                type: 'POST',
                success: function (data) {
                    //mise a jour
                    $('#modalcontentupgrade').empty().append(data);

                }

            });
         });
    
        $("#majdatasouscript").on('click','.detail_souscript', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        var lib = $(this).attr('lib');
        var type = $(this).attr('type');
        var dtesous=$(this).attr('dtesous');
        var statut=$(this).attr('statut');
         $.ajax({
                url: 'detail_souscription.php?id=' + id + '&type=' + type + '&lib=' + lib + '&dtesous=' + dtesous + '&statut=' + statut,
                type: 'POST',
                success: function (data) {
                    //mise a jour
                    $('#modalcontentdetail').empty().append(data);

                }

            });
         });
        $("#modalcontentupgrade").on('change','#mode_souscription', function (e) {
        e.preventDefault();
            var id = $("#id").val();
            var type =$('#mode_souscription option:selected').val();
            $.ajax({
                url: 'tableau_upgrade_maj.php?id=' + id + '&type=' + type,
                type: 'POST',
                success: function (data) {
                    //mise a jour
                    $('#tabmajupgrad').empty().append(data);

                }

            });
        });
        $("#modalcontentupgrade").on('click', '#valider_upgrade', function (e) {
        e.preventDefault();
        var id = $("#id").val();
        var type =$("#mode_souscription option:selected").val();
        var tot = $("#tot").val();
        var donnees ='';
        // alert(id);
        // alert(type);
        var method = 'POST';
        var url = 'Traitement/upgrade_traitement.php?id=' + id + '&type=' + type+ '&tot=' + tot;
        $.ajax({
            url: url,
            type: method,
            data: donnees,
            success: function (data) {
                // alert(data);
                  $.ajax({
                            url: 'datas_souscript.php',
                            type: 'POST',
                            success: function (data) {
                                //mise a jour
                                $("#upgrade").modal('hide');
                                $('#majdatasouscript').empty().append(data);
                                $('#msg1').empty().append('Upgrade effectué avec succes').show().fadeOut(4000);


                            }

                        });
            }//, dataType: 'json'

        });
   });


  $("#user_bloc").on('keyup', '#nbre_user', function (e) {
            var nbr_use = $(this).val();
            var prix_user = $("#prix_user").val();
            var montant = nbr_use * prix_user;
            $("#montant").val(montant);
            $("#mont_payer").val(montant);
            $("#nbre_user").css("border-color","black");
//            alert(nbr_use*2.5);
        });
        
        $('#valider').click(function (e) {
            e.preventDefault();
            var nombre_user = $("#nbre_user").val();
            var montant = $("#montant").val();
            
            if (nombre_user=='') {
                $('#msg_err').empty().append('Veuillez remplir le champ vide').show().fadeOut(8000);
                $("#nbre_user").css("border-color","red");
            }else{
                var bool=false;
                var donnees=$('#add_user_form').serialize();
//                alert(donnees);
                $.ajax({
                url:'Traitement/update_nbre_users.php',
                type: 'POST',
                data: donnees,
                beforeSend: function () {
                    $("#valider").addClass('hidden');
                    $("#loader").removeClass('hidden');
                },
                success: function (data) {
//                        alert(data.message);
                    if(data.succes){
                        $("#nbre_user").val(" ");
                        $("#montant").val(" ");
                        $("#mont_payer").val(" ");
                        $('#msg_err').show().fadeOut(9000);
                        $("#adduser").modal('hide');
                        window.open('impression/bon_add_user.php?montant='+montant+ '&nombre_user=' + nombre_user);
                    }else{
                      $('#div_message').removeClass('hidden'); 
                    }
                    $('#message').text(data.message);
                    bool = true;
                },
                complete: function () {
                    if (bool) {
                        $("#loader").addClass('hidden');
                        $("#valider").removeClass('hidden');
                    } else {
                       $("#loader").removeClass('hidden');
                    }
                },dataType:'json'
            });
                
            }
        });
        
    $("#modalcontentappstore").on('click', '.choice_pack', function (e) {
    e.preventDefault();
    var id_pack = $(this).val();
//    alert(id_pack);
    var existepackdssite=$('#existepackdssite').val();
    var id_pack_old=$('#id_pack').val();
    var donnees ='';
    var method = 'POST';
    var url = 'controle_choix_pack.php?id_pack=' + id_pack;
    // alert(id_pack);
    $.ajax({
        url: url,
        type: method,
        data: donnees,
        success: function (data) {
//            alert(data);
           if(data.message=='existepas'){

            if(existepackdssite=='ko'){
            $('#'+id_pack).replaceWith('<input type="radio"  id="'+id_pack+'" name="packs[]" value="'+id_pack+'" class="flat-red choice_pack" checked="checked">');

            }else if(existepackdssite=='ok'){

             if(id_pack==5||id_pack==6||id_pack==29||id_pack==30){
             $('#msg2').empty().append('Veuillez créer un autre site pour ajouter ce pack.').show().fadeOut(8000); 
             }else{

            if(id_pack_old==6&&id_pack==1){
            $('#'+id_pack).replaceWith('<input type="radio"  id="'+id_pack+'" name="packs[]" value="'+id_pack+'" class="flat-red choice_pack" checked="checked">');
            }else if(id_pack_old==6&&id_pack==7){
            $('#'+id_pack).replaceWith('<input type="radio"  id="'+id_pack+'" name="packs[]" value="'+id_pack+'" class="flat-red choice_pack" checked="checked">');
            }else if(id_pack_old==5&&id_pack==1){
            $('#'+id_pack).replaceWith('<input type="radio"  id="'+id_pack+'" name="packs[]" value="'+id_pack+'" class="flat-red choice_pack" checked="checked">');
            }else if(id_pack_old==5&&id_pack==7){
            $('#'+id_pack).replaceWith('<input type="radio"  id="'+id_pack+'" name="packs[]" value="'+id_pack+'" class="flat-red choice_pack" checked="checked">');
            }else if(id_pack_old==5&&id_pack==4){
            $('#'+id_pack).replaceWith('<input type="radio"  id="'+id_pack+'" name="packs[]" value="'+id_pack+'" class="flat-red choice_pack" checked="checked">');
            }else if(id_pack_old==30&&id_pack==1){
            $('#'+id_pack).replaceWith('<input type="radio"  id="'+id_pack+'" name="packs[]" value="'+id_pack+'" class="flat-red choice_pack" checked="checked">');
            }else if(id_pack_old==30&&id_pack==7){
            $('#'+id_pack).replaceWith('<input type="radio"  id="'+id_pack+'" name="packs[]" value="'+id_pack+'" class="flat-red choice_pack" checked="checked">');
            }else if(id_pack_old==29&&id_pack==1){
            $('#'+id_pack).replaceWith('<input type="radio"  id="'+id_pack+'" name="packs[]" value="'+id_pack+'" class="flat-red choice_pack" checked="checked">');
            }else if(id_pack_old==29&&id_pack==7){
            $('#'+id_pack).replaceWith('<input type="radio"  id="'+id_pack+'" name="packs[]" value="'+id_pack+'" class="flat-red choice_pack" checked="checked">');
            }else if(id_pack_old!=5 && id_pack_old!=6 &&id_pack_old!=29 && id_pack_old!=30){
            $('#'+id_pack).replaceWith('<input type="radio"  id="'+id_pack+'" name="packs[]" value="'+id_pack+'" class="flat-red choice_pack" checked="checked">');
            }else{
            $('#msg2').empty().append("Impossible d'ajouter ce pack.").show().fadeOut(8000); 
            }

             }

            }

           }else if(data.message=='existe'){
           $('#msg2').empty().append('Ce pack existe dejà dans votre site.').show().fadeOut(8000);
           }
        }
        , dataType: 'json'

    });   
     });
$('.listingpack').click(function (e) { 
  $.ajax({
        url: 'listing_pack_site.php',
        type: 'POST',
        success: function (data) {
            $('#existepackdssite').val(data.boolexistepack);
            $('#id_pack').val(data.id_pack);
        }, dataType: 'json'

    });
    });
    
    });
        
</script>
</body>

</html>
