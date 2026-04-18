<?php include('Gerant_global.php'); ?>
<?php include('headerRec.php'); ?>
<?php include('menu_Rec_config.php'); 
include('./Amelioration/bdd/connexion .php');
?>

<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Partenaires</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>
                        Affectation partenaire
                        <div class="btn-group  btn-group-sm pull-right">
                            <a href="gg_liste_partenaire.php" class="btn btn-default" title="Liste des partenaires"><i class="fa fa-list"></i> Liste des partenaires</a>
                        </div>
                    </h4>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <br />
                    <form method="post"  action="affectation_pactenaire_hotel.php"  data-parsley-validate class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Site <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12 select2" id="hotel_id" name="hotel_id">
                                    <option></option>
                                    <?php
                                    include("./Amelioration/caisse/caisse_hotel.php");
                                    foreach ($hotels as $h):
                                        echo '<option value=' . $h->id_hotel . '>' . $h->nom_hotel . '</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="adresse_hotel">Partenaire <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select class="form-control col-md-7 col-xs-12 select2" id="id_respo" name="id_respo">
                                    <option></option>
                                    <?php
                                    include("./Traitement/partenaire_hotel.php");
                                    foreach ($partenaire as $p):
                                        echo '<option value=' . $p->id_respo . '>' . $p->entreprise . '</option>';
                                    endforeach;
                                    ?>
                                </select>
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
                            $hotel_id = $_POST['hotel_id'];
                            $id_respo = $_POST['id_respo'];
                            $part = new Partenaire(0,'','','','');
                            $part->affect_Partenaire($id_respo,$hotel_id);
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
