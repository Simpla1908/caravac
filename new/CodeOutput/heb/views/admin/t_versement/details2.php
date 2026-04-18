<?php
/*
    * =======================================================================
    * FILE NAME:        View.php
    * DATE CREATED:     17-11-2017
    * FOR TABLE:        t_versement
    * PRODUCED BY:      HEZECOM UltimateSpeed PHP CODE GENERATOR
    * AUTHOR:           Hezecom (http://hezecom.com) info@hezecom.net
    * =======================================================================
    */
if (!defined('VALID_DIR')) die('You are not allowed to execute this file directly');
?>
<?php AjaxSearchSuggest('' . H_ADMIN_MAIN . '&view=t_versement&do=autosearch'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">Détails vente</h3>
                <ul class="nav pull-right">
                    <a href="./main.php?pg=admin&view=impression&do=detailversementheb" target="_blank" class="btn btn-xs btn-primary" title="Imprimer la liste">
                        <i class="fa fa-print"></i> Imprimer
                    </a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">
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
                            <th>REMBOURSEMENT</th>
                            <td><?php echo afficheMontant2($musd, $remb_usd) ?></td>
                            <td><?php echo afficheMontant2($mcdf, $remb_cdf) ?></td>
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
                            <th>ECART </th>
                            <td><?php echo afficheMontant2($musd, $solde_usd) ?></td>
                            <td><?php echo afficheMontant2($mcdf, $solde_cdf) ?></td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <div class="box-header with-border">
                <h3 class="box-title">Détails versement</h3>

            </div><!-- /.box-header -->
            <div class="box-body">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Numero</th>
                            <th>Montant USD</th>
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
                            array_push($_SESSION['detailversement']['mont_usd'], afficheMontant2($musd, $r->mont_usd));
                            array_push($_SESSION['detailversement']['mont_cdf'], afficheMontant2($mcdf, $r->mont_cdf));
                        ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $r->num ?></td>
                                <td><?php echo afficheMontant2($musd, $r->mont_usd) ?></td>
                                <td><?php echo afficheMontant2($mcdf, $r->mont_cdf) ?></td>
                            </tr>
                        <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>


            </div>
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->