<?php include('Gerant_global.php'); ?>
<?php include('head.php'); ?>
<?php include('menu_Rec_config.php'); ?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Sites</h3>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>
                        Ajout d'un site

                        <div class="btn-group  btn-group-sm pull-right">
                            <a href="gg_consultation_hotel.php" class="btn btn-default" title="Liste des sites"><i class="fa fa-list"></i> Liste des sites</a>
                        </div>
                    </h4>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <br />
                    <form method="post" action="gg_inserer_hotel.php" data-parsley-validate class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Nom <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="nom_hotel" name="nom_hotel" required class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="adresse_hotel">Adresse <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="adresse_hotel" name="adresse_hotel" required class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="province_hotel" class="control-label col-md-3 col-sm-3 col-xs-12">Province</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="province_hotel" class="form-control col-md-7 col-xs-12" type="text" name="province_hotel">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Ville <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="ville_hotel" name="ville_hotel" class="form-control col-md-7 col-xs-12" required type="text">
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Tél.<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="tel" name="tel" class="form-control col-md-7 col-xs-12" required type="text">
                            </div>
                        </div>
                           <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="mail" name="mail" class="form-control col-md-7 col-xs-12" required type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Id. Nat. <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="idnat" name="idnat" class="form-control col-md-7 col-xs-12" required type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Rccm<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="rccm" name="rccm" class="form-control col-md-7 col-xs-12" required type="text">
                            </div>
                        </div>

                        <div class="form-group text-center"> <i class="fa fa-cogs"></i> Vos Informations Administratives </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Monnaie Prix<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12 select2 voir1" required="required" id="monnaie_prix" name="monnaie_prix">
                                    <option></option>
                                    <option value="USD">USD</option>
                                    <option value="CDF">CDF</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Monnaie Facture <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12 select2 voir1" required="required" id="monnaie_fac" name="monnaie_fac">
                                    <option></option>
                                    <option value="USD">USD</option>
                                    <option value="CDF">CDF</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Taux d'échange <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input id="taux" class="form-control col-md-7 col-xs-12 voir1" name="taux" type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">TVA par défaut <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="input-group demo2 voir1">
                                    <input type="text" class="form-control col-md-7 col-xs-12" id="tva" name="tva" />
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Time Check in
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="timepicker1" placeholder="Time Check in réserver à un hôtel" class="form-control voir1" name="checkin">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Time Check out
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="timepicker2" placeholder="Time Check out réserver à un hôtel" class="form-control voir1" name="checkout">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                                <button type="submit" name="sauvegarder" class="btn btn-success">Sauvegarder</button>
                            </div>
                        </div>

                    </form>
                    <?php
if (isset($_POST['sauvegarder'])) {
    $nom_hotel = $_POST['nom_hotel'];
    $adresse_hotel = $_POST['adresse_hotel'];
    $province_hotel = $_POST['province_hotel'];
    $ville_hotel = $_POST['ville_hotel'];
    $tel = $_POST['tel'];
    $mail = $_POST['mail'];
    $idnat = $_POST['idnat'];
    $rccm = $_POST['rccm'];
    $monnaie_prix = $_POST['monnaie_prix'];
    $monnaie_fac= $_POST['monnaie_fac'];
    $taux = $_POST['taux'];
    $tva = $_POST['tva'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $default_site=0;
    $statut_site='inopérationnel';
    $user_id=$_SESSION['id_user'];
    $etat=0;
    $ch = new hotel($nom_hotel, $adresse_hotel, $province_hotel, $ville_hotel,$etat,$default_site,$_SESSION['company_id'],$statut_site);
    $ch->ajouterhotel($monnaie_prix,$monnaie_fac,$taux,$tva,$checkin,$checkout,$user_id,$idnat,$rccm,$mail,$tel);
    echo "<script>
    alert('L\'enregistrement est éffectué avec succès');
    document.location = 'gg_consultation_hotel.php'
         </script>";                   }
                    ?>

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

<!-- jQuery -->
<script src="../js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<script src="../bootstrap.timepicker/js/bootstrap-timepicker.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="../js/plugins/metisMenu/metisMenu.min.js"></script>

<!-- DataTables JavaScript -->
<script src="../js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="../js/plugins/dataTables/dataTables.bootstrap.js"></script>

<!-- Custom Theme JavaScript -->
<script src="../js/sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function() {
        $('#dataTables-example').dataTable();
    });
</script>

<script type="text/javascript">
        $('#timepicker2').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false,
            defaultTime: false
        });
        
        $('#timepicker1').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false,
            defaultTime: false
        });
    </script>

</body>

</html>
