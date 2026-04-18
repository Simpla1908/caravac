<?php include('Gerant_global.php'); ?>
<?php include('head.php'); ?>
<?php
include('menu_Rec_config.php');
include('./Amelioration/bdd/connexion .php');
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Partenaire</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>
                        Ajout 
                        <div class="btn-group  btn-group-sm pull-right">
                            <a href="gg_liste_partenaire.php" class="btn btn-default" title="Liste des partenaires"><i class="fa fa-list"></i> Liste des partenaires</a>
                        </div>
                    </h4>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">

                    <br />
                    <div id="msg" class="alert alert-success alert-dismissable" style="display:none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span>L'enrégistrement s'est effectué avec succès!</span>
                    </div>
                    <div id="msg1" class="alert alert-danger alert-dismissable" style="display:none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span>Veuillez remplir tous les champs!</span>
                    </div>
                    <form method="post"  action="gg_ajout_partenaire_hotel.php"  data-parsley-validate class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Nom Entreprise <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="nomE" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="adresse_hotel">Adresse <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="adresseE" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="province_hotel" class="control-label col-md-3 col-sm-3 col-xs-12">Responsable</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="respo" class="form-control" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Contact <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="contact" class="form-control">
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <!--<button type="submit" class="btn btn-primary">Cancel</button>-->
                                <button type="submit" name="send" class="btn btn-success">Sauvegarder</button>
                            </div>
                        </div>

                    </form>

                        <?php
                        if (isset($_POST['send'])) {
                            if($_POST['respo']!=''&&$_POST['contact']!=''&&$_POST['adresseE']!=''&&$_POST['nomE']!=''){
                            $nom_respo = $_POST['respo'];
                            $telephone_respo = $_POST['contact'];
                            $adresse_respo = $_POST['adresseE'];
                            $entreprise = $_POST['nomE'];
                            $part = new Partenaire($nom_respo, $telephone_respo, $adresse_respo, $entreprise, $_SESSION['company_id']);
                            $part->ajout_Partenaire();
                                echo "<script src='datepicker/jquery.js'></script>
                                    <script>
                                    $(document).ready(function () {
                                    $('#msg').show().fadeOut(6000);

                                    });
                                    </script>";

                            }else{
                                echo "<script src='datepicker/jquery.js'></script>
                                    <script>
                                    $(document).ready(function () {
                                    $('#msg1').show().fadeOut(6000);

                                    });
                                    </script>";
                            }
                        }
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

<?php include('gl_footer.php'); ?>
