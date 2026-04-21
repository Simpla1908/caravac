<?php
if (!isset($_SESSION)) {
    session_start();
}
require '../../bdd/connexion.php';
include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
require '../../FUNCTION/hebergement.php';
require '../../FUNCTION/restaurant.php';

$musd = 'USD';
$mcdf = 'CDF';
$percu_cdf = 0;
$percu_usd = 0;
$rendu_cdf = 0;
$rendu_usd = 0;
$fond_cdf = 0;
$fond_usd = 0;
$dep_cdf = $dep_usd = 0;
$hr_1 = '00:00:00';
$hr_2 = '05:00:00';
$hr_operation = date('H:i:s');
$dte = date('Y-m-d');
if ($hr_operation >= $hr_1 && $hr_operation <= $hr_2) {
    $dte = ReduiceDaysToDate($dte, 1);
    $date_h_com = $dte;
}
//VERSEMENT
$_SESSION['verser_usd'] =0;
$_SESSION['verser_cdf'] =0;
$requete = $bdd->prepare("SELECT a.date_vers,a.user_vers,SUM(a.montant_vers) AS mont_cdf,SUM(a.montantusd) AS mont_usd,a.date_vers,b.nom_user
FROM t_versement AS a,t_utilisateur AS b
WHERE  a.user_vers=b.id_user AND a.date_vers=:dte AND a.user_vers=:id_user 
GROUP BY a.user_vers");
$requete->BindParam(':dte', $dte);
$requete->BindParam(':id_user', $_SESSION['id_user']);
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);
$verser_usd = 0;
$verser_cdf = 0;
foreach ($result as $r) {
    $_SESSION['verser_usd'] = $verser_usd = $r->mont_usd;
    $_SESSION['verser_cdf'] = $verser_cdf = $r->mont_cdf;
}

//PAIEMENT
$requete = $bdd->prepare("SELECT SUM(b.montantcdf) AS percu_cdf,SUM(b.montantusd) AS percu_usd,SUM(b.rendu_cdf) AS rendu_cdf,SUM(b.rendu_usd) AS rendu_usd
        FROM t_reglement AS a,paiement AS b
        WHERE a.id_regl=b.regl_id AND b.id_mode_regl IN(2)
        AND a.dte=:dte AND a.id_user=:id_user
        GROUP BY a.id_user");
$requete->BindParam(':dte', $dte);
$requete->BindParam(':id_user', $_SESSION['id_user']);
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($result as $r) {
    $_SESSION['percu_cdf'] = $percu_cdf = $r->percu_cdf;
    $_SESSION['percu_usd'] = $percu_usd = $r->percu_usd;
    $_SESSION['rendu_cdf'] = $rendu_cdf = $r->rendu_cdf;
    $_SESSION['rendu_usd'] = $rendu_usd = $r->rendu_usd;
}
//REPORT
$rfond_cdf = 0;
$rfond_usd = 0;

/* $requete = $bdd->prepare("SELECT cdf ,usd  FROM  reportcaisse WHERE user_id=:id_user
ORDER BY id DESC LIMIT 1");
$requete->BindParam(':id_user', $_SESSION['id_user']);
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);

foreach ($result as $r) {
    $rfond_cdf = $r->cdf;
    $rfond_usd = $r->usd;
} */
//FONDS DE CAISSE
$_SESSION['fond_cdf'] = $fond_cdf = $rfond_cdf;
$_SESSION['fond_usd'] = $fond_usd = $rfond_usd;
//if ($verser_usd == 0 && $verser_cdf == 0) {
    $requete = $bdd->prepare("SELECT SUM(cdf) AS fond_cdf,SUM(usd) AS fond_usd
        FROM fondscaisse 
        WHERE dte=:dte AND user_id=:id_user");
    $requete->BindParam(':dte', $dte);
    $requete->BindParam(':id_user', $_SESSION['id_user']);
    $requete->execute();
    $result = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($result as $r) {
        $_SESSION['fond_cdf'] = $fond_cdf += $r->fond_cdf;
        $_SESSION['fond_usd'] = $fond_usd += $r->fond_usd;
    }

    
//}
$_SESSION['averser_cdf'] = $averser_cdf = ($fond_cdf + $percu_cdf) - $rendu_cdf;
$_SESSION['averser_usd'] = $averser_usd = ($fond_usd + $percu_usd) - $rendu_usd;


//DEPENSE
$requete = $bdd->prepare("SELECT SUM(cdf) AS cdf,SUM(usd) AS usd FROM depenses AS a
                                WHERE  a.user_id=:id_user
                                  AND a.psedo=0 
                                  AND a.dte_dep=:dte
                                ORDER BY a.dte_dep,a.user_id");

$requete->BindParam(':dte', $dte);
$requete->BindParam(':id_user', $_SESSION['id_user']);
$requete->execute();
$depenses = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($depenses as $r) {
    $_SESSION['dep_cdf'] = $dep_cdf = $r->cdf;
    $_SESSION['dep_usd'] = $dep_usd = $r->usd;
}

$_SESSION['solde_cdf'] = $solde_cdf = $averser_cdf - ($verser_cdf + $dep_cdf);
$_SESSION['solde_usd'] = $solde_usd = $averser_usd - ($verser_usd + $dep_usd);

?>
<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Versement Caisse</h5>
        </div>
        <div class="modal-body" id="popup_paie">
            <form action='./Traitement/versement.php' method="post" id="formversement">
                <div class="box-body">
                    <div class="box-group" id="accordion">
                        <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="box-body">
                                <div class="row">

                                    <div class="col-lg-12" style="margin-top:-30px;">
                                        <div class="col-lg-12 form-group hidden">
                                            <p class="text-center">
                                                <strong>DETAILS VENTE DU <?php echo dateAffiche($dte); ?></strong>
                                            </p>
                                        </div>
                                        <div class="box-body table-responsive hidden">
                                            <table class="table table-striped table-bordered table-hover"
                                                id="dataTables-example">
                                                <thead>
                                                    <tr>
                                                        <th></th>
                                                        <th>USD</th>
                                                        <th>CDF</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>FOND DE CAISSE</th>
                                                        <td><?php echo afficheMontant2($musd, $fond_usd) ?></td>
                                                        <td><?php echo afficheMontant2($mcdf, $fond_cdf) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>MONTANT PERCU</th>
                                                        <td><?php echo afficheMontant2($musd, $percu_usd) ?></td>
                                                        <td><?php echo afficheMontant2($mcdf, $percu_cdf) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>RENDU</th>
                                                        <td><?php echo afficheMontant2($musd, $rendu_usd) ?></td>
                                                        <td><?php echo afficheMontant2($mcdf, $rendu_cdf) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>DEPENSE</th>
                                                        <td><?php echo afficheMontant2($musd, $dep_usd) ?></td>
                                                        <td><?php echo afficheMontant2($mcdf, $dep_cdf) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>MONTANT DISPONIBLE</th>
                                                        <td><?php echo afficheMontant2($musd, $averser_usd) ?></td>
                                                        <td><?php echo afficheMontant2($mcdf, $averser_cdf) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>MONTANT VERSE</th>
                                                        <td><?php echo afficheMontant2($musd, $verser_usd) ?></td>
                                                        <td><?php echo afficheMontant2($mcdf, $verser_cdf) ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>SOLDE </th>
                                                        <td><?php echo afficheMontant2($musd, $solde_usd) ?></td>
                                                        <td><?php echo afficheMontant2($mcdf, $solde_cdf) ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                        <div class="col-lg-12 form-group hidden">
                                            <p class="text-center">
                                                <strong>REPARTITION ET BILLETAGE DES MONTANTS</strong>
                                            </p>
                                        </div>

                                        <div class="col-lg-5">
                                            <div class="form-group hidden">
                                                <input type="hidden" id="averser_usd" name="averser_usd"
                                                    value="<?php echo $solde_usd; ?>">
                                                <input type="hidden" id="averser_cdf" name="averser_cdf"
                                                    value="<?php echo $solde_cdf; ?>">
                                                <label>Montant en USD</label>
                                                <div class="input-group">
                                                    <input type="text" id="montant_usd" name="montant_usd"
                                                        class="form-control text-right text-blue " value="0">
                                                    <span class="input-group-addon">USD</span>
                                                </div>
                                            </div>
                                            <table class="table table-condensed">
                                                <tr>
                                                    <th class="text-center" style="width: 50%">USD</th>
                                                    <th class="text-center" style="width: 25%">NOMBRE</th>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">100</td>
                                                    <td class="text-center"  style="width: 50%"><input type="text"
                                                   class="usd" billet='100'   name="100usd" id="100usd" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">50</td>
                                                    <td class="text-center" style="width: 50%">
                                                    <input class="usd" billet='50' type="text"
                                                            name="50usd" id="50usd" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">20</td>
                                                    <td class="text-center" style="width: 50%">
                                                    <input class="usd" billet='20' type="text"
                                                            name="20usd" id="20usd" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">10</td>
                                                    <td class="text-center" style="width: 50%">
                                                    <input class="usd" billet='10' name="10usd"
                                                            id="10usd" type="text" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">5</td>
                                                    <td class="text-center" style="width: 50%">
                                                    <input class="usd" billet='5' name="5usd"
                                                            id="5usd" type="text" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">1</td>
                                                    <td class="text-center" style="width: 50%">
                                                    <input class="usd" billet='1'  type="text"
                                                            name="1usd" id="1usd" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" style="width: 60%">TOTAL</th>
                                                    <th class="text-center" id="totusd" style="width: 50%">0</th>
                                                </tr>
                                            </table>
                                        </div>
                                        <!-- /.col-lg-6 -->
                                        <div class="col-lg-5"  style="margin-left:30px">
                                            <input type="hidden" id="dtevers" name="dtevers" value="<?php echo $dte ?>">
                                            <div class="form-group hidden">
                                                <label>Montant en CDF</label>
                                                <div class="input-group">
                                                    <input type="text" id="montant_cdf" name="montant_cdf"
                                                        class="form-control text-right text-blue " value="0">
                                                    <span class="input-group-addon">CDF</span>
                                                </div>
                                            </div>
                                            <table class="table table-condensed">
                                                <tr>
                                                    <th class="text-center" style="width: 50%">CDF</th>
                                                    <th class="text-center" style="width: 50%">NOMBRE</th>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">20.000</td>
                                                    <td class="text-center" style="width: 50%">
                                                    <input class="cdf" billet='20000' type="text"
                                                            name="20000cdf" id="20000cdf" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">10.000</td>
                                                    <td class="text-center" style="width: 50%">
                                                    <input class="cdf" billet='10000'  type="text"
                                                            name="10000cdf" id="10000cdf" min="0" value="0"></td>
                                                </tr>

                                                <tr>
                                                    <td class="text-center" style="width: 50%">5.000</td>
                                                    <td class="text-center" style="width: 50%">
                                                    <input class="cdf" billet='5000'  type="text"
                                                            name="5000cdf" id="5000cdf" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">1000</td>
                                                    <td class="text-center" style="width: 50%">
                                                    <input class="cdf" billet='1000' type="text"
                                                            name="1000cdf" id="1000cdf" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="cdf" billet='500' class="text-center" style="width: 50%">500</td>
                                                    <td class="text-center" style="width: 50%">
                                                    <input class="cdf" billet='500' name="500cdf"
                                                            id="500cdf" type="text" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">200</td>
                                                    <td class="text-center" style="width: 50%">
                                                    <input class="cdf" billet='200' name="200cdf"
                                                            id="200cdf" type="text" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">100</td>
                                                    <td class="text-center" style="width: 50%">
                                                    <input class="cdf" billet='100' name="100cdf"
                                                            id="100cdf" type="text" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center" style="width: 50%">50</td>
                                                    <td class="text-center" style="width: 50%">
                                                    <input class="cdf" billet='50' name="50cdf"
                                                            id="50cdf" type="text" min="0" value="0"></td>
                                                </tr>
                                                <tr>
                                                    <th class="text-center" style="width: 50%">TOTAL</th>
                                                    <th class="text-center" id="totcdf" style="width: 50%">0</th>
                                                </tr>
                                            </table>
                                        </div>
                                        <!-- /.col-lg-6 -->
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.box-body -->
                <div class=" modal-footer">
                    <div id="msg" class="alert alert-success alert-dismissable" style="display: none">
                        <!--<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>-->
                        <span id="msg_alert">Veuillez saisir les valeurs correctes dans tous les champs!</span>
                    </div>
                    <span class="btn btn-danger hidden" id="loader_vers">
                        <i class="fa fa-refresh fa-spin fa-1x"></i> Patientez...
                    </span>
                    <button type="button" class="btn btn-primary btn_modal" data-dismiss="modal">ANNULER</button>
                    <button type="submit" id="verser_montant" class="btn btn-primary"><i
                            class="fa fa-check fa-fw"></i>&nbsp;Valider
                    </button>
            </form>
        </div>
    </div>

</div>