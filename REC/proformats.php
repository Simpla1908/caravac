<?php include('Receptionniste.php'); ?>
<?php include('./head.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php include('../FUNCTION/checkdates.php'); ?>
<?php include('../FUNCTION/hebergement.php'); ?>
<?php require '_header.php'; ?>
<?php 
include_once './Amelioration/reglage/recuperer_valeurs_reglages.php'; 
$hrs_sys = date('H:i:s');

$savemont=0;

?>

<div id="page-wrapper" style=" height:auto;">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">
                Proforma
            </h2>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-eye"></i> Informations client
                </div>
                <!-- /.panel-heading -->

                <div class="panel-body">
                    <form role="form" method="GET" action="impression/proforma.php" id="frm_proforma" class="">
                        <div class="row">
                            <div class="col-lg-12">
                                <br>

                                <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                    client <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="nom_client"  id="nom_client"
                                           required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <br>

                                <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">
                                    Responsable
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="nom_responsable"  id="nom_responsable"
                                           required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                 <br>
                                <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Date du jour
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="dte" id="datetimepickerRes" required="required"
                                        value="<?php echo date('d/m/Y'); ?>"     class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                 <br>
                                <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Date prévue d'arrivée
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="dte_in" id="datetimepickerAr" required="required"
                                     class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                 <br>
                                <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Date prévue de sortie
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="dte_out" id="datetimepickerSor" required="required"
                                           class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            </div>
                        </div>
                        <input type="hidden" name="nuite" id="nuite" >
                        <input type="hidden" name="monnaie" id="monnaie"  value="<?php echo $m_affiche; ?>">
                        <div class="row" id="panier">
                            <br>

                            <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <i class="fa fa-check-square-o"></i> Liste de chambres
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div class="row">
                                                <div  class="col-lg-8">
                                                </div>
                                                <div  class="col-lg-1">
                                                    TVA(%)
                                                </div>
                                                <div  class="col-lg-3">
                                                    <select name="tvainclu" id="tvainclu" class="form-control col-md-7 col-xs-12" required>
                                                        <option value="0">Exonéré</option>
                                                        <option value="<?php echo $tva; ?>"><?php echo $tva; ?></option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <?php
                                            $requete_chambre = $bdd->prepare("
                                                SELECT ch.id_ch,ch.tarif_ch,ch.num_ch,ch.monnaie                                              
                                                FROM t_chambre AS ch
                                                WHERE ch.id_hotel=:id_hotel GROUP BY ch.tarif_ch");

                                            $requete_chambre->BindParam(':id_hotel', $_SESSION['id_hotel']);
                                            $requete_chambre->execute();
                                            $chambres = $requete_chambre->fetchAll(PDO::FETCH_OBJ);
                                            ?>
                                            <div class="table-responsive">
                                                <table class="table_chambre table table-striped table-bordered table-hover table-condensed" id="dataTables-example">
                                                    <thead>
                                                    <tr>
                                                        <td></td>
                                                        <th>Tarif </th>
                                                        <th>Nombre de chambre </th>
                                                        <th>Montant</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $i = 1;
                                                    foreach ($chambres as $ch){
                                                        $idch=$ch->id_ch;
                                                        $qte=1;
                                                        $tarif_ch =montant_equivalent_bdd($ch->monnaie,$m_affiche,$tauxdollar,$ch->tarif_ch);
                                                        $montant=$tarif_ch*$qte;
                                                        ?>
                                                        <tr>
                                                            <td> <input name="chambre[]" type="checkbox" value="<?php echo $ch->id_ch ?>" id="<?php echo $ch->id_ch ?>" class="choix_chambre"/></td>
                                                            <td>
                                                                 <input type="hidden" name="tarif[]"  value="<?php echo $ch->tarif_ch; ?>">
                                                                 <input type="hidden" name="monnaie[]"  value="<?php echo $ch->monnaie; ?>">
                                                                <?php echo afficheTarif($m_affiche,$tarif_ch,$tva); ?>
                                                            </td>
                                                            <td>
                                                                <input type="text" name="nbre_ch[]"  value="1">
                                                            </td>
                                                            
                                                            <td>
                                                                <?php 
                                                                    $savemont=afficheMontant($m_affiche,$montant);
                                                                    echo $savemont;
                                                                ?>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        $i++;
                                                       }
                                                    ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <!-- /.table-responsive -->

                                            <div class="row" >
                                                <div class="col-lg-12">
                                                    <div class="box-footer">
                                                        <br>
                                                         <button name="proforma" type="submit" class="btn btn-primary pull-right">Imprimer</button>
                                                    </div>
                                                    <!-- /.box-footer -->
                                                </div>
                                            </div>
                                            <!-- /.row -->

                                        </div>
                                        <!-- /.panel-body -->
                                    </div>
                                    <!-- /.panel -->
                                </div>
                                <!-- /.col-lg-6 -->
                            </div>
                    </form>
                    <!-- /.form -->
               </div>
                <!-- /.panel-body -->            
            </div> 
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
    $('#datetimepickerRes').datetimepicker(
        {
          format: "d/m/Y"
        }
    );
    $('#datetimepickerAr').datetimepicker(
        {
          format: "d/m/Y"
        }
    );
    $('#datetimepickerSor').datetimepicker(
        {
          format: "d/m/Y"
        }
    );
</script>

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

<?php
