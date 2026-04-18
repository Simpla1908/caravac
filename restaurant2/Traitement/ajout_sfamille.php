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

<form id="form_plat1" action="Traitement/sous_famille_insertion.php" method="post">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Sous-Famille Plat
            </h3>
            <div class="box-tools pull-right" data-toggle="tooltip" title="Affichage">
                <div class="btn-group" data-toggle="btn-toggle">
                  <button data-toggle="modal" data-target="#myModal1sfam" type="button" class="btn btn-default btn-sm"><i class="fa fa-navicon text-red"></i></button>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label>Famille:</label>
                <select class="form-control select2 famille_id" style="width: 100%;" name="famille_id" required="required">
                    <option></option>
                     <?php
                        include('./famille_combo.php');

                        foreach ($familles  as $f):
                            echo '<option value=' . $f->idfamille. '>' . ucfirst($f->designation) . '</option>';
                        endforeach;
                        ?>
                </select>
            </div>
            <!-- /.form group -->
            <div class="form-group">
                <label>Sous-famille:</label>
                <div class="form-group">
                    <input type="text" class="form-control designation" name="designation" id="designation">
                </div>
                <!-- /.form group -->
            </div>
            <!-- /.form group -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" id="save_sous_famille1" class="btn btn-primary btn_res1 pull-right"><i class="fa fa-save fa-fw"></i>&nbsp;Valider</button>
        </div>
    </div>
    <!-- /.box -->
</form>
<?php 
                            
    $requete = $bdd->prepare("SELECT * FROM reservation_table AS a, t_client AS b WHERE  a.table_id=b.id_client AND a.hotel_id=:hotel_id");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $clients = $requete->fetchAll(PDO::FETCH_OBJ);

                        ?>
<div class="modal fade" id="myModal1sfam" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="myModalLabel"><strong>Liste des sous-famille</strong></h5>
            </div>
            <div class="modal-body">
               <table id="table" class="table table-bordered table-condensed table-striped">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Sous-famille</th>
                    <th>Famille</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($clients as $cl):
                    $transpostion_date2 = explode('-', $cl->date_hr_res_tbl);
                    $annee = $transpostion_date2[0];
                    $mois = $transpostion_date2[1];
                    $jour_hr = $transpostion_date2[2];
                    $transpostion_date1 = explode(' ', $jour_hr);
                    $jr = $transpostion_date1[0];
                    $hr = $transpostion_date1[1];
                    $date_bon = $jr . '/' . $mois . '/' . $annee.' '.$hr;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $cl->designation ?></td>
                        <td><?php echo $cl->client_nom ?> </td>
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


<script>
        $(document).ready(function() {
            
            
    $('#save_sous_famille1').click(function (e) {
        e.preventDefault();
//        alert('abon');
        var donnees = $('#form_plat1').serialize();
        
        $.ajax({
            url: 'Traitement/sous_famille_insertion.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                alert(data);
//                if (data.message_succes == 'succes') {
//                    effacer();
//                    $('#msg').show().fadeOut(4000)
//                            .addClass('alert-success')
//                            .removeClass('alert-danger');
//                    $('#msg_alert').text("L'enrégistrement s'est effectué avec succès!")
//                } else if (data.message_erreur == 'erreur') {
//                    $('#msg').show()
//                            .addClass('alert-danger')
//                            .removeClass('alert-success');
//                    $('#msg_alert').text("Cette designation " + data.des_value + " de la sous famille existe déjà")
//                } else if (data.message_vide== 'vide')  {
//                    $('#msg').show().fadeOut(4000)
//                            .addClass('alert-danger')
//                            .removeClass('alert-success');
//                    $('#msg_alert').text('Veuilez remplir les champs vides!')
//
//                }

            }, dataType: 'json'
        });

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