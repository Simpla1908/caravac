<?php include('Gerant_local.php'); ?>
<?php include('headerRec.php'); ?>
<?php include('menu_Rec_config.php');
if (isset($_POST['sauvegarder'])) {

    if($_POST['lib_cat']!=''){
        include './verif_dblon_cat.php';
        $id_cat = $_POST['id_cat'];
        $categorie = $_POST['lib_cat'];
        $categorie2 = $_POST['lib_cat2'];
        $id_hotel=$_SESSION['id_hotel'];
        $existe=pas_doublon_cat2($categorie2,$categorie);
        if($existe==0){
            $cat = new Categorie($categorie, $id_hotel);
            $cat->majcategorie($id_cat);
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
                                    $('#msg_text11').text('ce libellé ".$categorie." existe déjà');
                                    $('#msg11').show();

                                    });
                                    </script>";
        }

    }else{
        echo "<script src='datepicker/jquery.js'></script>
                                    <script>
                                    $(document).ready(function () {
                                    $('#msg1').show().fadeOut(6000);

                                    });
                                    </script>";
    }
}
if(isset($_GET['id_cat'])){
    $id_cat=$_GET['id_cat'];
    $result=mysql_query("SELECT c.lib_cat_cha FROM categorie_chambre c WHERE c.id_cat_cha='$id_cat'") or die(mysql_error());
    while($rows=mysql_fetch_assoc($result))
        $lib_cat_cha=$rows['lib_cat_cha'];
}
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Categorie des chambres</h3>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>
                        Modifier Categorie
                        <div class="btn-group  btn-group-sm pull-right">
                            <a href="liste_categorie.php?module=MH" class="btn btn-default" title="Afficher toutes les catégories"><i class="fa fa-list"></i> Voir</a>
                        </div>
                    </h4>
                    <!-- <div class="success" style="margin-top:-40px; margin-left:90px;">Une chambre ajoutée avec succes</div>-->
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <BR>
                        <div id="msg" class="alert alert-success alert-dismissable" style="display:none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <span>La modification s'est effectuée avec succès!</span>
                        </div>
                        <div id="msg1" class="alert alert-danger alert-dismissable" style="display:none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <span id="msg_text">Veuillez remplir tous les champs!</span>
                        </div>
                        <div id="msg11" class="alert alert-danger alert-dismissable" style="display:none;">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <span id="msg_text11">Veuillez remplir tous les champs!</span>
                        </div>
                        <form method="post"  action="modif_cat.php?module=MH&id_cat=<?php echo $id_cat; ?>"  data-parsley-validate class="form-horizontal form-label-left">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Libelle <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="lib_cat" name="lib_cat"  class="form-control col-md-7 col-xs-12" value="<?php echo $lib_cat_cha; ?>">
                                    <input type="hidden" id="lib_cat" name="lib_cat2"  class="form-control col-md-7 col-xs-12" value="<?php echo $lib_cat_cha; ?>">
                                    <input type="hidden" id="id_cat" name="id_cat"  class="form-control col-md-7 col-xs-12" value="<?php echo $id_cat; ?>">
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
