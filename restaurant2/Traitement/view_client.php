<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
$type = 'client';
$type_cl = 'restaurant';
$requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_hotel=:hotel_id AND cl.type=:type AND cl.type_cl=:type_cl AND cl.pseudo_supp=0 ORDER BY cl.nom_client ASC");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':type', $type);
$requete->BindParam(':type_cl', $type_cl);
$requete->execute();
$clients = $requete->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" type="text/css" href="../datepicker/jquery.datetimepicker.css">
    </head>
    <body>
        <div class="table-responsive">
            <table id="table" class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>Noms</th>
                        <th>Sexe</th>
                        <th>Télephone</th>
                        <th>E-mail</th>
                        <th>Remise(%)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;

                    foreach ($clients as $cl):
                        ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo $cl->nom_client ?></td>
                            <td><?php echo $cl->sexe_client ?> </td>
                            <td><?php echo $cl->telephone_client ?> </td>
                            <td><?php echo $cl->email_client ?> </td>
                            <td><?php echo $cl->remise ?> </td>
                            <td>
                                <span>
                                    <a class="label label-primary updcustomerresto_init" title="Modifier" data-toggle="modal" data-target="#myModalUPTClient"
                                       idclient="<?php echo $cl->id_client ?>"
                                       remise="<?php echo $cl->remise ?>"
                                       nomclient="<?php echo $cl->nom_client ?>"
                                       sexeclient="<?php echo $cl->sexe_client ?>"
                                       telephoneclient="<?php echo $cl->telephone_client ?>"
                                       emailclient="<?php echo $cl->email_client ?>"
                                       ><i class="fa fa-edit"></i></span></a>
                                </span>
                                <span>
                                    <a href="#" title="Supprimer" id="<?php echo $cl->id_client ?>" class="supprimer_client"><span class="label label-danger"><i class="fa fa-trash-o"></i></span></a>
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
            $(document).ready(function () {
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