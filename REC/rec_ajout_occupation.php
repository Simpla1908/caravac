<?php 
require '../bdd/connexion.php';
include('Receptionniste.php'); ?>
<?php include('headerRec.php'); ?>
<?php
include('menu_Rec.php');

if (isset($_GET['num_reserv']) && isset($_GET['id_client']) && isset($_GET['nom_client']) && isset($_GET['id_res']) && isset($_GET['date_res']) && isset($_GET['date_occ']) && isset($_GET['date_lib']) && isset($_GET['dte_a']) && isset($_GET['dte_s'])) {

    $num_reserv = $_GET['num_reserv'];
    $id_client = $_GET['id_client'];
    $nom_client = $_GET['nom_client'];
    $id_res = $_GET['id_res'];
    $date_res = $_GET['date_res'];
    $date_occ = $_GET['date_occ'];
    $date_lib = $_GET['date_lib'];
    $dte_a = $_GET['dte_a'];
    $dte_s = $_GET['dte_s'];
    $_SESSION['id_res_client'] = $id_client;

    $_SESSION['id_client'] = $id_client;
    $_SESSION['nom_client'] = $nom_client;
    $_SESSION['id_res'] = $id_res;
} 
//else {
//    header("Location:rec_liste_de_reservation.php");
//}
?>
<div id="page-wrapper">
    <!--<br>
<h1><b><center>--><?php //echo strtoupper($_SESSION['nom_hotel']);  ?><!--</center></b></h1>-->
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Affectations</h3>
            <div class="col-lg-12">
                <div id="msg" class="alert alert-danger alert-dismissable" style="display:none;">
                    <span id="msg_alert">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4>Affectations Client(s) <i class="fa fa-arrow-right"></i> Chambre(s)
                            <div class="pull-right">
                                <a class="btn btn-primary btn-xs" href="rec_ajout_client_en_charge.php?id_client=<?php echo $_SESSION['id_client']; ?>&nom_client=<?php echo $_SESSION['nom_client']; ?>&id_res=<?php echo $_SESSION['id_res']; ?>&dte_a=<?php echo $dte_a; ?>&dte_s=<?php echo $dte_s; ?>&num_reserv=<?php echo $num_reserv; ?>&date_res=<?php echo $date_res; ?>&date_occ=<?php echo $date_occ; ?>&date_lib=<?php echo $date_lib; ?>" style="font-style:italic;"><i class="fa fa-user-plus"></i> Ajouter d'autres clients</a>                     
                            </div>
                        </h4>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <BR>
                        <form class="form-horizontal form-label-left">
                            <input id="id_res" type="hidden" value="<?php echo $id_res; ?>">
                            <input id="num_reserv" type="hidden" value="<?php echo $num_reserv; ?>">
                            <input id="date_occ" type="hidden" value="<?php echo $date_occ; ?>">
                            <input id="date_lib" type="hidden" value="<?php echo $date_lib; ?>">
                            <div id="data_occupa">
                            <div class="form-group">
                                <label class="control-label col-md-3" for="first-name">Client <span class="required">*</span>
                                </label>
                                <div class="col-md-7">
                                    <select class="form-control" name="id_client"  id="id_client">
                                        <option value="<?php echo $id_client; ?>"><?php echo $nom_client; ?></option>
                                        
                                        <?php
                                        $requete = $bdd->prepare("SELECT DISTINCT a.id_client, a.nom_client
                                        FROM t_client AS a, t_client_reserve AS b
                                        WHERE a.id_client = b.id_client
                                        AND a.id_hotel=:id_hotel 
                                        AND b.responsable !=3
                                        AND b.id_res=:id_res ");
                                        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                                        $requete->BindParam(':id_res', $id_res);
                                        $requete->execute();
                                        $clients = $requete->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($clients as $cl):
                                            if (isset($_GET['nom_client']) && isset($_GET['id_client'])) {
                                                if ($cl->id_client!=$_GET['id_client']) {
                                                    echo '<option value="' . $cl->id_client . '">' . $cl->nom_client . '</option>';
                                                }
                                            } else {
                                                echo '<option value="' . $cl->id_client . '">' . $cl->nom_client . '</option>';
                                            }
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3" for="last-name">Chambre <span class="required">*</span>
                                </label>
                                <div class="col-md-7">
                                     <select class="form-control" name="id_chambre" id="id_chambre">
                                        <option></option>
                                        ?>
                                        <?php
                                        $requete = $bdd->prepare("SELECT rch.idchambre,ch.num_ch,ch.capacite 
                                        FROM t_chambre AS ch,t_reserve_chambre AS rch,t_reservation AS res
                                        WHERE rch.statut='reserve'
                                        AND ch.id_ch=rch.idchambre 
                                        AND  res.id_res=rch.idreserv 
                                        AND ch.id_hotel=:id_hotel
                                        AND rch.idreserv=:id_res ");
                                        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
                                        $requete->BindParam(':id_res', $id_res);
                                        $requete->execute();
                                        $chambres = $requete->fetchAll(PDO::FETCH_OBJ);
                                        foreach ($chambres as $ch):
                                            echo '<option value="' . $ch->idchambre . '">' . 'CH ' . $ch->num_ch . '  (Capacite:' . $ch->capacite . ')</option>';
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                    <button  id="valider_occup" name="valider" type="submit" class="btn btn-primary"><i class=" fa fa-save"></i>&nbsp;&nbsp;Valider</button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <div id="div_affectation" class="center-margin"></div>
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

<?php include('gl_footer.php'); ?>
