<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
$type_cl = 'table';
$requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_sousresto=:id_sousresto AND cl.type=:type_cl AND cl.pseudo_supp=0 ORDER BY cl.ordre ASC,cl.designation");
$requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
$requete->BindParam(':type_cl', $type_cl);
$requete->execute();
$tables = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="../datepicker/jquery.datetimepicker.css">
        
    </head>
    <body>
        <div id="annule"></div>
        <div class="table-responsive">
        <table id="table" class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Code</th>
                    <th>Désignation</th>
                    <th>Ordre</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                
                foreach ($tables as $tbl):
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $tbl->code ?></td>
                        <td><?php echo $tbl->designation ?> </td>
                        <td><?php echo $tbl->ordre ?> </td>
                        
                            <td>
                                <?php if ($tbl->statut == 'libre') { ?>
                                    <span class="label label-success"><?php echo $tbl->statut ?></span>
                                <?php } elseif ($tbl->statut == 'reserve') { ?>
                                    <span class="label label-danger "><?php echo $tbl->statut ?></span>
                                <?php } else { ?>
                                    <span class="label label-primary"><?php echo $tbl->statut ?></span>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($tbl->statut == 'reserve') { ?>
                                    <span id="annule">
                                        <?php if (in_array('ART',$_SESSION['actions']['code_actions'])){?>
                                        <a href="#" title="Annuler" id="<?php echo $tbl->id_client ?>"><span class="label label-warning"><i class="fa fa-reply"></i></span></a>
                                        <?php } ?>
                                    </span>
                                <?php } ?>
                                <span id="modifier">
                                    <a href="#" class="confirmModalLink1" data-toggle="modal" data-target=".myModal" title="Modifier" id="<?php echo $tbl->id_client ?>"><span class="label label-primary"><i class="fa fa-edit"></i></span></a>
                                </span>
                                <span id="supprimer">
                                    <a href="#" title="Supprimer" id="<?php echo $tbl->id_client ?>"><span class="label label-danger"><i class="fa fa-trash-o"></i></span></a>
                                </span>
                            </td>
                        </tr>
                    <?php
                    $i++;
                endforeach;
                ?>
            </tbody>
        </table>
         </div>
       
        
        
        <!-- Date time picker -->
        <script src="../datepicker/jquery.js"></script>
        <script src="../datepicker/jquery.datetimepicker.js"></script>
        <script>
        $(document).ready(function() {
            $('.dateres').datetimepicker(); 
            
            $('#annule a').click(function () {
                var donnees = '';
                var table_res_id = $(this).attr('id');       
                $.ajax({
                    url: 'Traitement/annulation_reservation_table.php?table_res_id=' + table_res_id,
                    type: 'POST',
                    data: donnees,
                    success: function (data) {
//                        alert(data);
                    $("#view_table").load('./Traitement/view_table.php');
                    $("#reservation").load('./Traitement/ajout_reservation.php');
                    }
                });
                return false;
            });
            //Suppression d'une table
            $('#supprimer a').click(function () {
                var donnees = '';
                var table_res_id = $(this).attr('id');       
                $.ajax({
                    url: 'Traitement/suppression_table.php?table_res_id=' + table_res_id,
                    type: 'POST',
                    data: donnees,
                    success: function (data) {
//                        alert(data);
                    $("#view_table").load('./Traitement/view_table.php');
                    $("#reservation").load('./Traitement/ajout_reservation.php');
                    }
                });
                return false;
            });
            var id;
            $(".confirmModalLink1").click(function (e) {
                e.preventDefault();
        //        alert('ff');
                var donnees = '';
                id = $(this).attr("id");
//                alert(id);
        //        $("#myModal").modal("show");
            $.ajax({
                    url: 'Traitement/selection_table.php?table_id=' + id,
                    type: 'POST',
                    data: donnees,
                    success: function (data) {
//                        alert(data.code);
                    $("#idtable").val(data.id_client);
                    $("#codetable").val(data.code);
                    $("#Destable").val(data.designation);
                    $("#ordre").val(data.ordre);
                    $("#entete").text("Modification");
                    $("#save_table").html('<i class="fa fa-edit fa-fw"></i>&nbsp;Modifier');
                    }, dataType: 'json'
                });
                return false;
            });
            
        });
        </script>
    </body>
</html>