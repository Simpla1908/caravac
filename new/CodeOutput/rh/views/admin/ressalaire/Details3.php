
<?php
/*
 * =======================================================================
 * FILE NAME:        Details.php
 * DATE CREATED:  	17-11-2017
 * FOR TABLE:  		ressalaire
 * PRODUCED BY:		HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:			Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Détail Decompte final</h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=resiliation" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=impression&id=<?php echo $salaire_id; ?>&do=resiliation" title="<?php echo LANG_TIP_PRINT; ?>" target="_blank" class="btn btn-default btn-xs tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>

                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-file-text-o"></i> Aperçu
                                <small class="pull-right hidden">Date: 2/10/2014</small>
                            </h2>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <address>
                                Noms: <strong> <?php echo $empploye; ?></strong><br>
                                Matricule: <b><?php echo $matricule; ?></b><br>
                                Fonction:  <b><?php echo ucfirst($fonction); ?></b>
                                <?php // echo $Adresse; ?><br>
                                <!--Téléphone: <?php // echo $tel1; ?><br>-->
                                <!--Email: <?php // echo $email; ?>-->
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <address>
                                Date d'engagement: <b><?php echo dateAffiche($dteng); ?></b><br> 
                                Date de fin contrat:  <b><?php echo dateAffiche($dtefin); ?></b><br> 
                                Ancienneté: <b><?php echo ucfirst($anciennete); ?></b>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Motif: <b><?php echo getMotifDecompte($motif); ?></b><br>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-condensed table-bordered">
                                <?php
                                $nbrtype = count($_SESSION['resiliation']['type']);
                                for ($p = 0; $p <= $nbrtype - 1; $p++) {
                                    $type = $_SESSION['resiliation']['type'][$p];
                                    $nbre = count($_SESSION[$type]['id']);
                                    if ($type == 'jour') {
                                        $jours = 'jour(s)';
                                    } else {
                                        $jours = $_SESSION['Paie_affiche'];
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="2"><b><?php echo strtoupper($_SESSION['resiliation']['libelle'][$p]); ?></b></td>
                                    </tr>
                                    <?php for ($q = 0; $q <= $nbre - 1; $q++) { ?>
                                        <tr>
                                            <td align="left"><?php echo $_SESSION[$type]['nom'][$q] ?></td>
                                            <td align="left">
                                                <?php
                                                if ($type == 'jour') {
                                                    echo $_SESSION[$type]['montant'][$q] . ' ' . $jours;
                                                } else {
                                                    echo afficheMontant($_SESSION['Paie_affiche'], $_SESSION[$type]['montant'][$q]);
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <th align="left"><?php echo $_SESSION['resiliation']['lib_type'][$p] ?></th>
                                        <th align="right">
                                            <?php
                                            if ($type == 'jour') {
                                                echo $_SESSION[$type]['total'] . ' ' . $jours;
                                            } else {
                                                echo afficheMontant($_SESSION['Paie_affiche'], $_SESSION[$type]['total']);
                                            }
                                            ?>
                                        </th>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <th align="left">NET A PAYER</th>
                                    <th align="right">
                                        <?php echo afficheMontant($_SESSION['Paie_affiche'], $netapayer); ?>
                                    </th>
                                </tr>
                            </table>


                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                </section>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
