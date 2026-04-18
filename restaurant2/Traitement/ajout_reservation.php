<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
//$_SESSION['id_hotel']=1;
$type_cl = 'table';
$statut='libre';
$pseudo_supp=0;
$requete = $bdd->prepare("SELECT * FROM  t_client AS cl, t_reserve_chambre AS rc,t_chambre ch WHERE cl.id_client=rc.id_client AND rc.statut='occupe' AND rc.idchambre=ch.id_ch AND cl.id_hotel=:hotel_id AND cl.type!=:type_cl ORDER BY cl.id_client ASC");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':type_cl', $type_cl);
$requete->execute();
$clients = $requete->fetchAll(PDO::FETCH_OBJ);

$requete = $bdd->prepare("SELECT * FROM  t_client AS cl WHERE cl.id_sousresto=:id_sousresto AND cl.type=:type_cl AND cl.statut=:statut AND cl.pseudo_supp=:pseudo_supp ORDER BY cl.id_client ASC");
$requete->BindParam(':id_sousresto', $_SESSION['id_sousresto']);
$requete->BindParam(':type_cl', $type_cl);
$requete->BindParam(':statut', $statut);
$requete->BindParam(':pseudo_supp',$pseudo_supp);
$requete->execute();
$tables = $requete->fetchAll(PDO::FETCH_OBJ);

?>

<form id="form_res">
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">
                Réservation Tables
            </h3>
            <div class="box-tools pull-right" data-toggle="tooltip" title="Affichage">
                <div class="btn-group" data-toggle="btn-toggle">
                  <button data-toggle="modal" data-target="#myModal1" type="button" class="btn btn-default btn-sm"><i class="fa fa-navicon text-red"></i></button>
                </div>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label>Table:</label>
                <select class="form-control select2 table_id" style="width: 100%;" name="table_id">
                    <option></option>
                    <?php foreach ($tables as $tbl): ?>
                        <option value="<?php echo $tbl->id_client ?>"><?php echo $tbl->designation ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- /.form group -->
            <div class="form-group">
                <label>Client logé:</label>
                <select class="form-control select2 client_nom" style="width: 100%;" name="client_nom">
                    <option></option>
                    <?php foreach ($clients as $cl): ?>
                        <option value="<?php echo $cl->nom_client ?>"><?php echo 'Chambre N0'.$cl->num_ch.'  '.$cl->nom_client ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- /.form group -->
            <div class="form-group">
                <label>Abonné:</label>
                <div class="form-group">
                    <input type="text" class="form-control abonne_cli" name="abonne_cli" id="abonne_cli" placeholder="Noms">
                </div>
                <!-- /.form group -->
            </div>
            <!-- /.form group -->
            <div class="form-group">
                <label>Date:</label>
                <div class="input-group date">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right dateres" name="dateres" required="required" placeholder="Date de réservation">
                </div>
                <!-- /.input group -->
            </div>
            <!-- /.form group -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-primary btn_res1 pull-right"><i class="fa fa-save fa-fw"></i>&nbsp;Valider</button>
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
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="modal-title" id="myModalLabel"><strong>Liste de réservations des tables</strong></h5>
            </div>
            <div class="modal-body">
               <table id="table" class="table table-bordered table-condensed table-striped">
            <thead>
                <tr>
                    <th>N°</th>
                    <th>Table</th>
                    <th>Client</th>
                    <th>Date</th>
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
                        <td><?php echo $date_bon ?></span></td>
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
//                            alert(data);
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