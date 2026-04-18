<div class="content-wrapper">
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Versement
                <small></small>
            </h1>
<!--            <ol class="breadcrumb">
                <li><a href="index.php?ss=<?php echo $_SESSION['id_sousresto']?>"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="<?php echo$LIEN?>p=versement&d=liste">Versements</a></li>
                <li class="active">Détails</li>
            </ol>-->
        </section>


        <!-- Main content -->
        <!-- Main content -->
        <section class="content">
            <div class="box" id="details_versement">
            <div class="box-header">
                <div class="col-md-9">
                    <h3 class="box-title">
                        Détails vente
                    </h3>
                </div>
                <div class="col-md-3">
                    <div class="btn-group  btn-group-sm">
                        <a id="prt_det_vers2" href="impression/examples/details_versement.php" target="_blank"  class="btn btn-xs btn-primary" title="Imprimer la liste">
                            <i class="fa fa-print"></i> Imprimer
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive">
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <tbody>
                        <tr>
                            <th>FOND DE CAISSE</th>
                            <td colspan="2"><?php echo afficheMontant($mcdf, $fond_cdf) ?></td>
                        </tr>
                        <tr>
                            <th>CASH</th>
                            <td colspan="2"><?php echo afficheMontant($musd, $percu_usd) ?></td>
                        </tr>
                        <tr>
                            <th>PAIEMENT CREDIT</th>
                            <td colspan="2"><?php echo afficheMontant($musd, $percu_usd) ?></td>
                        </tr>
                        <tr>
                            <th>DEPENSE</th>
                            <td colspan="2"><?php echo afficheMontant($musd, $percu_usd) ?></td>
                        </tr>
                        <tr>
                            <th>SOLDE VIRTUEL</th>
                            <td colspan="2"><?php echo afficheMontant($musd, $percu_usd) ?></td>
                        </tr>
                        <tr>
                            <th>SOLDE PHYSIQUE </th>
                            <td colspan="2"><?php echo afficheMontant($musd, $percu_usd) ?></td>
                        </tr>
                        <tr>
                            <th>BALANCE </th>
                            <td colspan="2"><?php echo afficheMontant($musd, $percu_usd) ?></td>
                        </tr>
                        <tr>
                            <th>FONDS DE CAISSE DU LENDEMAIN </th>
                            <td colspan="2"><?php echo afficheMontant($musd, $percu_usd) ?></td>
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
        </section>
        
    </div>

    <!-- /.content -->
    <div class="clearfix"></div>

</div>

