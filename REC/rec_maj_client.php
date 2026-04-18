<?php include('Receptionniste.php'); ?>
<?php include('head.php'); ?>
<?php
include('menu_Rec.php');
include '../bdd/connexion_mysql.php';
include('../FUNCTION/hebergement.php');
?>

<?php
$id_client = $_GET['id_client'];
$result = mysql_query("SELECT * FROM  t_client c WHERE c.id_client='$id_client' ") or die(mysql_error());
while ($rows = mysql_fetch_assoc($result)) {
    $id_client = $rows['id_client'];
    $nom_client = $rows['nom_client'];
    $date_naiss = $rows['date_naiss_client'];
    $sexe_client = $rows['sexe_client'];
    $etat_civil = $rows['etat_civil_client'];
    $nationalite_client = $rows['nationalite_client'];
    $provenance_client = $rows['provenance_client'];
    $num_piece_identite_client = $rows['num_piece_identite_client'];
    $num_passeport_client = $rows['num_passeport_client'];
    $adresse_provenance_client = $rows['adresse_provenance_client'];
    $email_client = $rows['email_client'];
    $telephone_client = $rows['telephone_client'];
    $num_pers_contacter_client = $rows['num_pers_contacter_client'];
    $id_respo = $rows['id_respo'];
}
?>

<div id="page-wrapper" style=" height:auto">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Clients</h3>
            <div id="msg" class="alert alert-danger alert-dismissable" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <span id="msg_alert">Veuillez saisir les valeurs correctes dans tous les champs!</span>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-edit"></i> Modification
                    <a class="btn btn-primary btn-xs pull-right"  href="rec_liste_clients.php"><i class="fa fa-list"></i> Liste des clients</a>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                        <form role="form" method="post" action="Traitement/update_client.php" class="form-horizontal form-label-left" id="form">
                            <input class="form-control" name="id_client" type="hidden" value="<?php echo $id_client; ?>" required>
                            <div class="row">
                                <div class="col-lg-6" id="contenaire">
                                    <br><br>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Noms
                                            client <span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input name="nom_client" type="text" value="<?php echo $nom_client; ?>" id="nom_client"
                                                   required="required" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sexe
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control col-md-7 col-xs-12 disabled" name="sexe_client" id="sexe_client" >
                                                <?php
                                                $tab[0] = 'Masculin';
                                                $tab[1] = 'Feminin';
                                                for ($i = 0; $i < 2; $i++) {
                                                    if ($sexe_client == $tab[$i]){
                                                        echo '<option value="' . $sexe_client . '" selected>' . $sexe_client . '</option>';
                                                    }else{
                                                        echo '<option value="' . $tab[$i] . '">' . $tab[$i] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Date de
                                            Naiss</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input class="form-control col-md-7 col-xs-12 disabled" type="date"
                                                   id="datetimepicker6" name="date_naiss_client" value="<?php echo dateAffiche($date_naiss); ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Etat Civil
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control col-md-7 col-xs-12 disabled"
                                                    name="etat_civil_client" id="etat_civil_client">
                                                <?php
                                                $tab[0] = 'Marié';
                                                $tab[1] = 'Célibataire';
                                                $tab[2] = 'Divorcé';
                                                for ($i = 0; $i < 3; $i++) {
                                                    if ($etat_civil == $tab[$i]){
                                                        echo '<option value="' . $etat_civil . '" selected>' . $etat_civil . '</option>';
                                                    }else{
                                                        echo '<option value="' . $tab[$i] . '">' . $tab[$i] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nationalité
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="nationalite_client" name="nationalite_client" value="<?php echo $nationalite_client; ?>" 
                                                   class="form-control col-md-7 col-xs-12 disabled" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Responsable
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control col-md-7 col-xs-12 disabled" name="id_respo" id="id_respo" >
                                                <?php
                                                $idcomp=$_SESSION['company_id'];
                                                $result = mysql_query("SELECT r.id_respo,r.entreprise FROM  t_responsable r WHERE r.company_id=$idcomp") or die(mysql_error());
                                                while ($row = mysql_fetch_array($result)) {
                                                    if ($row['id_respo'] == $id_respo){
                                                        echo '<option value="' . $row['id_respo'] . '" selected>' . $row['entreprise'] . '</option>';
                                                    }else{
                                                        echo '<option value="' . $row['id_respo'] . '">' . $row['entreprise'] . '</option>';
                                                    }
                                                }
                                                mysql_free_result($result);
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Provenance
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="provenance_client" name="provenance_client" value="<?php echo $provenance_client; ?>" 
                                                   class="date-picker form-control col-md-7 col-xs-12 disabled" type="text">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    <br><br>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Pièce
                                            identité
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select class="form-control col-md-7 col-xs-12 disabled"
                                                    name="num_piece_identite_client" id="num_piece_identite_client">
                                                <?php
                                                $tab[0] = "Carte d'électeur";
                                                $tab[1] = "Permis de conduire";
                                                $tab[2] = "Passport";
                                                for ($i = 0; $i < 3; $i++) {
                                                    if ($num_piece_identite_client == $tab[$i]){
                                                        echo '<option value="' . $num_piece_identite_client . '" selected>' . $num_piece_identite_client . '</option>';
                                                    }else{
                                                        echo '<option value="' . $tab[$i] . '">' . $tab[$i] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Numéro
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="number" id="num_passeport_client" name="num_passeport_client" value="<?php echo $num_passeport_client; ?>"
                                                   min="0" class="disabled form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="middle-name"
                                               class="control-label col-md-3 col-sm-3 col-xs-12">Adresse </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="adresse_provenance_client" name="adresse_provenance_client" value="<?php echo $adresse_provenance_client; ?>"
                                                   class="disabled form-control col-md-7 col-xs-12" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Téléphone
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="tel" id="telephone_client" name="telephone_client" value="<?php echo $telephone_client; ?>"
                                                   class="disabled form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Email
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="email" id="email_client" name="email_client" value="<?php echo $email_client; ?>"
                                                   class="disabled form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Autre Contact
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="tel" id="num_pers_contacter_client"
                                                   name="num_pers_contacter_client" value="<?php echo $num_pers_contacter_client; ?>" 
                                                   class="disabled form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                            <button name="update" id="update" type="submit" class="btn btn-success"><i
                                                    class="fa fa-edit"></i> Modifier
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <!-- /.row (nested) -->
                        </form>
                    </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<script src="../datepicker/jquery.js"></script>
<script src="../datepicker/jquery.datetimepicker.js"></script>
<script>
    $('#datetimepicker6').datetimepicker({format: 'd/m/Y'});
    $('#datetimepickerOcc').datetimepicker();
    $('#datetimepickerLib').datetimepicker();
    $('#datetimepickerLib1').datetimepicker();
    
    
    $('#update').click(function (e) {
        e.preventDefault();
        //   alert('bbbb');
        var donnees = $('#form').serialize();
//            alert(donnees);
        $.ajax({
            url: 'Traitement/update_client.php',
            type: 'POST',
            data: donnees,
            success: function (data) {
                if (data.message_succes == 'succes') {
                    $('#msg').show().fadeOut(360000)
                            .addClass('alert-success')
                            .removeClass('alert-danger');
                    $('#msg_alert').text("La mise a jour s'est effectué avec succès!");
                    document.location='rec_liste_clients.php';
                } else {
                    $('#msg').show().fadeOut(4000)
                            .addClass('alert-danger')
                            .removeClass('alert-success');
                    $('#msg_alert').text('Veuilez remplir les champs vides!')

                }

            }, dataType: 'json'
        });

    });
    
</script>

<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/bootstrap-modal.js"></script>
<script src="../js/bootstrap-datepicker.js"></script>

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
        $('#dataTables-example').dataTable();
    });

</script>
