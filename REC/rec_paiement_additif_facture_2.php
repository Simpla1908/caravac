
<?php
require '../bdd/connexion.php';
include('Receptionniste.php');
?>
<?php include('headerRec.php'); ?>
<?php include('menu_Rec.php'); ?>
<?php include('../FUNCTION/checkdates.php'); ?>
<?php require '_header.php'; ?>
<?php
if (isset($_GET['num_fact']) && ($_GET['type']) && ($_GET['nom_client']) && ($_GET['id_fact']) && ($_GET['reste']) && ($_GET['montant_tot']) && ($_GET['id_res']) && ($_GET['id_client'])) {
    $num_fact = $_GET['num_fact'];
    $id_fact = $_GET['id_fact'];
    $nom_client = $_GET['nom_client'];
     $type = $_GET['type'];
    $reste = $_GET['reste'];
    $montant_tot = $_GET['montant_tot'];
    $id_client = $_GET['id_client'];
//    $id_ch = $_GET['id_ch'];
    $id_res = $_GET['id_res'];

//    $_SESSION['nom_client'] = $nom_client;
//    $_SESSION['num_fact'] = $num_fact;
//    $_SESSION['type'] = $type;



//if (isset($_GET['id'])) {
//    $panier->del($_GET['id']);
//}
//$ids = array_keys($_SESSION['panier']);
//if (empty($ids)) {
//    $chambre = array();
//} else {
//    $req = $bd->prepare('SELECT id_ch, num_ch, tarif_ch FROM t_chambre WHERE id_ch in (' . implode(',', $ids) . ')');
//    $req->execute();
//    $chambre = $req->fetchAll(PDO::FETCH_OBJ);
//}
?>

<div id="page-wrapper" style=" height:auto;">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Paiement</h3>
            <div id="msg" class="alert alert-success alert-dismissable" style="display:none;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <span id="msg_alert">L'enrégistrement s'est effectué avec succès!</span>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Paiement additif</h4>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <form role="form" method="post" action="Traitement_reservation/completer_paiement_1.php"  id="form_reservation_insert" class="form-horizontal form-label-left">
                        <input name="reste" id="reste" type="hidden" value="<?php echo $reste; ?>">
                        <input name="num_fact" id="num_fact" type="hidden" value="<?php echo $num_fact; ?>">
                        <input name="id_fact" id="id_fact" type="hidden" value="<?php echo $id_fact; ?>">
                        <input name="montant_tot" type="hidden" value="<?php echo $montant_tot; ?>">
                        <input name="id_client" id="id_client" type="hidden" value="<?php echo $id_client; ?>">
                        <input name="id_res" id="id_res" type="hidden" value="<?php echo $id_res; ?>">
                        <!--<input name="id_ch" id="id_ch" type="hidden" value="<?php // echo $id_ch; ?>">-->
                        <fieldset>
                            <table width="852" border="0"  style="margin-left:20px;">
                                <tr height="15">
                                    <td></td>
                                </tr>
                                <tr>
                                    <td align="left" > <label><strong>Client&nbsp;</strong></label></td>
                                    <td width="10" style="border-right:1px solid #000"></td>
                                    <td align="left">&nbsp;&nbsp;<?php echo $nom_client; ?></td>
                                    <td width="50"></td>
                                    <td align="left" > <label><strong><!--Commissionnaire&nbsp;--></strong></label></td>
                                    <td width="10" style="border-right:1px solid #fff"></td>
                                    <td align="left">&nbsp;&nbsp;<?php //echo $_SESSION['nom_commissionnaire'];  ?></td>
                                </tr>
                                <tr height="15">
                                    <td></td>
                                </tr>
                                <tr height="15">
                                    <td></td>
                                </tr>
                                <tr>
                                    <td align="left" > <label for="date"><strong>Montant total&nbsp;</strong></label></td>
                                    <td width="10" style="border-right:1px solid #000"></td>
                                    <td align="left">&nbsp;&nbsp;<span style="color:#d1312c; font-weight:bold;"><?php echo $montant_tot . ' $'; ?></span></td>
                                    <td width="50"></td>
                                    <td align="right"> <label for="date"><strong>Reste&nbsp;</strong></label></td>
                                    <td width="10" style="border-right:1px solid #000"></td>
                                    <td align="left">&nbsp;&nbsp;<span style="color:#d1312c; font-weight:bold;"><?php echo $reste . ' $'; ?></span></td>
                                    <td width="30"></td>
                                </tr>
                            </table>
                            <div class="ln_solid"></div>
                            <br>
                            <div class="col-md-8 center-margin">
                                <div class="form-group">
                                    <label>Montant en usd</label>
                                    <input type="number" class="form-control" name="montantUSD" id="montantUSD" placeholder="Montant en Dollar">
                                </div>
                                <div class="form-group">
                                    <label>Montant en fc</label>
                                    <input type="number" class="form-control" name="montantFC" id="montantFC" placeholder="Montant en Franc Congolais">
                                </div>
                                <div class="form-group">
                                    <label>Mode de paiement <span class="required">*</span></label>
                                    <select class="form-control" name="mode" id="mode" requered>
                                        <option></option>
                                        <?php
                                        $requete = $bdd->prepare("SELECT * FROM t_mode_reglement");
                                        $requete->execute();
                                        $mode_regl = $requete->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($mode_regl as $mg):
                                            echo '<option value=' . $mg->id_mode_regl . '>' . $mg->lib . '</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                                <div class="item form-group">
                                    <label id="lb_justif" style="display:none">Justification <span class="required">*</span></label>
                                    <textarea style="display:none" name="justif" id="justif" class="form-control col-md-7 col-xs-12"></textarea>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <button  name="sauvegarder" id="completer_paiement_1" type="submit" class="btn btn-danger"><i class=" fa fa-save"></i> Sauvegarder</button>
                                    <div id="imprimer_fact" style="display:none;" ><a class="btn btn-success" href="../html2pdf/examples/recu_completer_paiement.php" target="_blank"><img src="../img/print.png">&nbsp;Imprimer la facture</a></div>
                                </div>
                            </div>
                        </fieldset>
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
<script src="../Authentification/jquery-1.9.1.min.js"></script> 

<?php }
include('rec_footer.php'); ?>
