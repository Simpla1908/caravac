<?php include('Gerant_local.php'); ?>
<?php include('headerRec.php'); ?>
<?php include('menu_Rec_config.php');
include './Amelioration/bdd/connexion .php';
include './Amelioration/reglage/recuperer_valeurs_reglages.php';

?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Chambres</h3>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Ajout d'une chambre
                        <a class="btn btn-primary btn-xs pull-right"  href="gl_consultation_chambre.php?id_hotel=<?php echo $id_hotel;?>&module=MH">&nbsp;Liste des chambres</a>
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
                            <span id="msg_text">Veuillez remplir tous les champs!</span>
                        </div>
                    <div id="msg11" class="alert alert-danger alert-dismissable" style="display:none;">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <span id="msg_text11">Veuillez remplir tous les champs!</span>
                    </div>

                    <form method="post" action="gl_ajout_chambre.php?module=MH" data-parsley-validate class="form-horizontal form-label-left">
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nom_hotel">Numéro <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="num_ch" class="form-control col-md-7 col-xs-12" placeholder="000" type="number" min="1">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="adresse_hotel">Etat <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="etat_ch"  class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="province_hotel" class="control-label col-md-3 col-sm-3 col-xs-12">Tarif <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="input-group demo2 voir1">
                                    <input type="text" class="form-control col-md-7 col-xs-12" name="tarif_ch"  type="number"  min="1" />
                                    <span class="input-group-addon"> <?php echo $m_insert;?></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group hidden">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Capacite <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input name="capacite"  type="hidden"  min="0" placeholder="0" class="form-control col-md-7 col-xs-12" value="2">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Niveau <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="niveau" id="niveau" class="form-control">
                                    <option></option>
                                    <?php
                                    include '../bdd/connexion_mysql.php';
                                    $hotel_session = $_SESSION['id_hotel'];
                                    $result = mysql_query("SELECT n.id_niv_cha,n.lib_niv_cha FROM niveau_chambre AS n WHERE n.hotel_id=$hotel_session") or die(mysql_error());

                                    while ($row = mysql_fetch_array($result)) {
                                        echo '<option value="' . $row['id_niv_cha'] . '">' . $row['lib_niv_cha'] . '</option>';
                                    }
                                    mysql_free_result($result);
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Categorie <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="categorie" id="categorie" class="form-control">
                                    <option></option>
                                    <?php
                                    include '../bdd/connexion_mysql.php';
                                    $result = mysql_query("SELECT c.id_cat_cha,c.lib_cat_cha FROM categorie_chambre AS c WHERE c.hotel_id=$hotel_session") or die(mysql_error());

                                    while ($row = mysql_fetch_array($result)) {
                                        echo '<option value="' . $row['id_cat_cha'] . '">' . $row['lib_cat_cha'] . '</option>';
                                    }
                                    mysql_free_result($result);
                                    ?>
                                </select>
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
                        <?PHP
                        if (isset($_POST['sauvegarder'])) {
                            $num_ch = $_POST['num_ch'];
                            $etat_ch = $_POST['etat_ch'];
                            $tarif_ch = $_POST['tarif_ch'];
                            $reserve = "non";
                            $occupe = "non";
                            $libre = "oui";
                            $capacite = $_POST['capacite'];
                            $niveau = $_POST['niveau'];
                            $categorie = $_POST['categorie'];
                            $id_hotel=$_SESSION['id_hotel'];
                            $monnaie=$m_insert;
                           if (!empty($num_ch)&&!empty($etat_ch)&&!empty($tarif_ch)&&!empty($capacite)&&!empty($niveau)&&!empty($categorie)&&!empty($id_hotel)) {
                            include './verfier_doublon_chambre.php';
                            $existe=pas_doublon($num_ch);
                            if($existe==0){
                            $ch = new chambre($num_ch, $etat_ch, $tarif_ch,$monnaie,$reserve, $occupe, $libre, $capacite, $categorie, $niveau, $id_hotel);
                            $ch->ajouterchambre();
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
                                    $('#msg_text11').text('ce numéro de chambre ".$num_ch." existe déjà');
                                    $('#msg11').show();

                                    });
                                    </script>";
                            }
                            }else {
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
