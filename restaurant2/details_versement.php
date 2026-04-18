<?php
$musd = 'USD';
$mcdf = 'CDF';
$_SESSION['nom_user'] = $noms_user = $_GET['noms_user'];
$_SESSION['dte_vers'] = $dte = $_GET['dte'];
$user = $_GET['user'];
$_SESSION['fond_cdf'] = $fond_cdf = $_GET['fond_cdf'];
$_SESSION['fond_usd'] = $fond_usd = $_GET['fond_usd'];
$_SESSION['percu_cdf'] = $percu_cdf = $_GET['percu_cdf'];
$_SESSION['percu_usd'] = $percu_usd = $_GET['percu_usd'];
$_SESSION['rendu_cdf'] = $rendu_cdf = $_GET['rendu_cdf'];
$_SESSION['rendu_usd'] = $rendu_usd = $_GET['rendu_usd'];
$_SESSION['averser_usd'] = $averser_usd = $_GET['averser_usd'];
$_SESSION['averser_cdf'] = $averser_cdf = $_GET['averser_cdf'];
$_SESSION['verser_cdf'] = $verser_cdf = $_GET['verser_cdf'];
$_SESSION['verser_usd'] = $verser_usd = $_GET['verser_usd'];
$_SESSION['solde_cdf'] = $solde_cdf = $averser_cdf - $verser_cdf;
$_SESSION['solde_usd'] = $solde_usd = $averser_usd - $verser_usd;
$requete = $bdd->prepare("SELECT a.montant_vers AS mont_cdf,a.montantusd AS mont_usd,a.num
        FROM t_versement AS a
        WHERE  a.date_vers=:dte AND a.user_vers=:user");
$requete->BindParam(':dte', $dte);
$requete->BindParam(':user', $user);
$requete->execute();
$result = $requete->fetchAll(PDO::FETCH_OBJ);
?>


<div class="box" id="details_versement">
    <div class="box-header">
        <div class="col-md-9">
            <h3 class="box-title">
                Détails vente
            </h3>
        </div>
        <div class="col-md-3">
            <div class="btn-group  btn-group-sm">
                <a id="impression" href="./impression/examples/details_versement.php" class="btn btn-primary" title="Imprimer la liste" target="ablank">
                    <i class="fa fa-print"></i> Imprimer
                </a>
            </div>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
                    <td><?php echo afficheMontant($musd, $fond_usd) ?></td>
                    <td><?php echo afficheMontant($mcdf, $fond_cdf) ?></td>
                </tr>
                <tr>
                    <th>MONTANT PERCU</th>
                    <td><?php echo afficheMontant($musd, $percu_usd) ?></td>
                    <td><?php echo afficheMontant($mcdf, $percu_cdf) ?></td>
                </tr>
                <tr>
                    <th>RENDU</th>
                    <td><?php echo afficheMontant($musd, $rendu_usd) ?></td>
                    <td><?php echo afficheMontant($mcdf, $rendu_cdf) ?></td>
                </tr>
                <tr>
                    <th>MONTANT A VERSER</th>
                    <td><?php echo afficheMontant($musd, $averser_usd) ?></td>
                    <td><?php echo afficheMontant($mcdf, $averser_cdf) ?></td>
                </tr>
                <tr>
                    <th>MONTANT VERSE</th>
                    <td><?php echo afficheMontant($musd, $verser_usd) ?></td>
                    <td><?php echo afficheMontant($mcdf, $verser_cdf) ?></td>
                </tr>
                <tr>
                    <th>SOLDE </th>
                    <td><?php echo afficheMontant($musd, $solde_usd) ?></td>
                    <td><?php echo afficheMontant($mcdf, $solde_cdf) ?></td>
                </tr>
            </tbody>
        </table>
    </div>


    <div class="box-header">
        <div class="col-md-9">
            <h3 class="box-title">
                Détails versement
            </h3>
        </div>
        <div class="col-md-3">

        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Numero</th>
                    <th>Montant CDF</th>
                    <th>Montant CDF</th>

                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                //Mise en session pour impression
                $_SESSION['detailversement'] = array();
                $_SESSION['detailversement']['i'] = array();
                $_SESSION['detailversement']['num'] = array();
                $_SESSION['detailversement']['mont_usd'] = array();
                $_SESSION['detailversement']['mont_cdf'] = array();
                //Fin mise en session
                foreach ($result as $r) {
                    array_push($_SESSION['detailversement']['i'], $i);
                    array_push($_SESSION['detailversement']['num'], $r->num);
                    array_push($_SESSION['detailversement']['mont_usd'], afficheMontant($musd, $r->mont_usd));
                    array_push($_SESSION['detailversement']['mont_cdf'], afficheMontant($mcdf, $r->mont_cdf));
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $r->num ?></td>
                        <td><?php echo afficheMontant($musd, $r->mont_usd) ?></td>
                        <td><?php echo afficheMontant($mcdf, $r->mont_cdf) ?></td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>

    </div>
</div>
<!-- /.box -->

