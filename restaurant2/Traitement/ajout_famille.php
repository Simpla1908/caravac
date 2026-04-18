<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
//$_SESSION['id_hotel']=1;
$type_cl = 'table';
$statut='libre';
$requete = $bdd->prepare("SELECT * FROM  t_client AS cl, t_reserve_chambre AS rc,t_chambre ch WHERE cl.id_client=rc.id_client AND rc.statut='occupe' AND rc.idchambre=ch.id_ch AND cl.id_hotel=:hotel_id AND cl.type!=:type_cl ORDER BY cl.id_client ASC");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':type_cl', $type_cl);
$requete->execute();
$clients = $requete->fetchAll(PDO::FETCH_OBJ);

$requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id AND cl.type=:type_cl AND cl.statut=:statut ORDER BY cl.id_client ASC");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':type_cl', $type_cl);
$requete->BindParam(':statut', $statut);
$requete->execute();
$tables = $requete->fetchAll(PDO::FETCH_OBJ);
?>

<form id="form_plat" action="./Traitement/famille_insertion.php" method="post">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Famille d'un plat
            </h3>
            <div class="box-tools pull-right" data-toggle="tooltip" title="Affichage">
                <div class="btn-group" data-toggle="btn-toggle">
                  <button data-toggle="modal" data-target="#myModal1fam" type="button" class="btn btn-default btn-sm"><i class="fa fa-navicon text-red"></i></button>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label>Famille:</label>
                <div class="form-group">
                    <input type="text" class="form-control abonne_cli" name="designation" id="designation" >
                </div>
                <!-- /.form group -->
            </div>
            <!-- /.form group -->
            <div id="msg1" class="alert alert-success alert-dismissable" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <span id="msg_alert1">Succès!</span>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" id="save_famille1" class="btn btn-primary pull-right"><i class="fa fa-save fa-fw"></i>&nbsp;Valider</button>
        </div>
    </div>
    <!-- /.box -->
</form>
<?php 
    $plat=1;                        
    $requete = $bdd->prepare("SELECT * FROM  stk_famille AS f"
                          . " WHERE f.hotel_id=:hotel_id AND f.plat=:plat ORDER BY designation");

    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->BindParam(':plat', $plat);
    $requete->execute();
    $familles = $requete-> fetchAll(PDO::FETCH_OBJ);

                        ?>
<div class="modal fade" id="myModal1fam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="myModalLabel"><strong>Liste de familles plats</strong></h5>
            </div>
            <div class="modal-body">
               <table id="table" class="table table-bordered table-condensed table-striped">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Désignation</th>
                    <th>Vente</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($familles as $fam):
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $fam->designation ?></td>
                        <?php if($fam->affichage==1){?>
                        <td><input type="checkbox" name="affichage_famille" class="affichage_famille" id="<?php echo $fam->idfamille ?>" value="<?php echo $fam->idfamille?>" checked="checked"></td>
                        <?php }else{?>
                        <td><input type="checkbox" name="affichage_famille" class="affichage_famille" id="<?php echo $fam->idfamille ?>" value="<?php echo $fam->idfamille?>"></td>
                         <?php }?>
                        <td>
                            <a href="#" title="Modifier" class="edit_famille" id1="<?php echo $fam->idfamille ?>"><span class="label label-success"><i class="fa fa-edit"></i> Edit</span></a>
                            <a data-toggle="modal" data-target=".myModaldel" href="#" title="Supprimer" class="del_famille confirmModalLink3" id="<?php echo $fam->idfamille ?>"><span class="label label-danger"><i class="fa fa-trash"></i> Delete</span></a>
                        </td>
                    </tr>
                    <?php
                    $i++;
                endforeach;
                ?>
            </tbody>
        </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
<!--                <button type="submit" class="btn btn-primary"><i class="fa fa-print fa-fw"></i>&nbsp;Imprimer</button>-->
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade myModaldel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <i class="fa fa-warning fa-fw"></i> Suppression
            </div>
            <div class="modal-body">
                <h4>Etes-vous sûr de vouloir supprimer cet élément ?</h4>
            </div>
            <div class="modal-footer">
                 <a href="#" class="btn btn-primary" id="confirmModalNo">Non</a>
            <a href="#" class="btn " id="confirmModalYes">Oui</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<script>
        $(document).ready(function() {
            //Suppression famille
    var id;
    $(".confirmModalLink3").click(function (e) {
        e.preventDefault();
        id = $(this).attr("id");
        alert(id);
//        $("#myModal").modal("show");
    });
    $("#confirmModalNo").click(function (e) {
        $(".myModaldel").modal("hide");
//            alert('ok11');
    });
    $("#confirmModalYes").click(function (e) {
         alert(id);
        $.ajax({
            url: 'Traitement/fam_rmv.php?id=' + id,
            type: 'POST',
            success: function (data) {
                
            }
        });
        $("#myModal").modal("hide");
//window.location.href ="approvisionnement_view.php?operation=appro";
    });
            $('#save_famille').click(function (e) {
                e.preventDefault();
                var donnees = $('#form_plat').serialize();
//                alert(donnees);
                $.ajax({
                    url: './Traitement/famille_insertion.php',
                    type: 'POST',
                    data: donnees,
                    success: function (data) {
                        
                        if (data.message_succes == 'succes') {
//                            effacer();
                                $('#designation').val(' ');
                            $('#msg1').show().fadeOut(4000)
                                    .addClass('alert-success')
                                    .removeClass('alert-danger');
                            $('#msg_alert1').text("Succès!")
//alert("succes");
                        } else if (data.message_erreur == 'erreur') {
                            $('#msg1').show()
                                    .addClass('alert-danger')
                                    .removeClass('alert-success');
                            $('#msg_alert1').text("Cette famille existe déjà!")
                        } else if (data.message_vide== 'vide')  {
                            $('#msg1').show().fadeOut(4000)
                                    .addClass('alert-danger')
                                    .removeClass('alert-success');
                            $('#msg_alert1').text('Un Champs vide!')

                        }

                    }, dataType: 'json'
                });

            });
            
            
            $('.affichage_famille').click(function (e) {
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
            
            
            
            
            
            
            $(".btn_res1").click(function (e) {
                    e.preventDefault();
                    var donnees = $('#form_res').serialize();
//                    alert(donnees);
//                      var abonee=$('#abonne_cli').val();
//                      alert(abonee);
                    $.ajax({
                        url: './Traitement/insertion_res_table.php',
                        async: true,
                        type: 'POST',
                        data: donnees,
                        global: false,
                        cache: false,
                        success: function (data) {
                            $('.dateres').val(' ');
                            $('.client_nom').val(' ');
                            $('.table_id').val(' ');
                            $("#view_table").load('./Traitement/view_table.php');
                            $("#reservation").load('./Traitement/ajout_reservation.php');
//                            alert(data);
                        }
                    });

                });
            
        });
        </script>