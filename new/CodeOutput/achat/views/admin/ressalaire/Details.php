
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
$employe_id = $id;
?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Détail</h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=viewall2&id=<?php echo $idempl; ?>" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=impression&id=<?php echo $rows->id; ?>&employe_id=<?php echo $rows->employe_id; ?>&do=bulletin" title="<?php echo LANG_TIP_PRINT; ?>" target="_blank" class="btn btn-default btn-xs tip"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                   
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-file-text-o"></i> Bulletin de paie
                                <small class="pull-right hidden">Date: 2/10/2014</small>
                            </h2>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <address>
                                <strong> <?php echo $_SESSION['employe']['nom'][$employe_id]; ?></strong><br>
                                <?php echo $_SESSION['employe']['adresse'][$employe_id]; ?><br>
                                Téléphone: <?php echo $_SESSION['employe']['tel'][$employe_id]; ?><br>
                                Email: <?php echo $_SESSION['employe']['email'][$employe_id]; ?>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <address>
                                Matricule: <b><?php echo $_SESSION['employe']['matricule'][$employe_id]; ?></b><br>
                                Fonction:  <b><?php echo ucfirst($_SESSION['employe']['fonction'][$employe_id]); ?></b>
                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Mois: <b><?php echo $_SESSION['employe']['periode'][$employe_id]; ?></b><br>
                            Date de paiement: <b><?php echo dateAffiche($_SESSION['employe']['dtepaie'][$employe_id]); ?></b><br>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-condensed table-bordered">
                                <tbody>
                                    <tr>
                                        <th>RUBRIQUE</th>
                                        <th>MONTANT</th>
                                    </tr>
                                    <?php
                                    $netpayer = 0;
                                    $cpt1 = count($_SESSION['rubrique']['type']);
                                    for ($i = 0; $i <= $cpt1 - 1; $i++) {
                                        $total = 0;
                                        $type = $_SESSION['rubrique']['type'][$i];
                                        ?>
                                        <tr>
                                            <td colspan="2"><b><?php echo strtoupper($type); ?></b></td>
                                        </tr> 
                                        <?php if ($type == 'remuneration') { ?>
                                            <tr>
                                                <td><?php echo 'Base' ?></td>
                                                <td>
                                                    <?php echo afficheMontant($_SESSION['Paie_affiche'],montant_equivalent_bdd(getsymbole_local(),$_SESSION['Paie_affiche'],$_SESSION['employe']['tauxpaie'][$employe_id],$totbase))  ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $_SESSION[$type]['total'] = $_SESSION[$type]['total'] + $totbase;
                                        }
                                        ?>
                                        <?php
                                        $cpt2 = $_SESSION[$type]['compteur'];
                                        for ($j = 0; $j <= $cpt2 - 1; $j++) {
                                            $id = $_SESSION[$type]['id'][$j];
                                            $nom = $_SESSION[$type]['nom'][$j];
                                            $montant = $_SESSION[$type]['montant'][$j];
                                            ?>
                                            <tr>
                                                <td><?php echo $nom ?></td>
                                                <td>
                                                    <?php echo afficheMontant($_SESSION['Paie_affiche'],montant_equivalent_bdd(getsymbole_local(),$_SESSION['Paie_affiche'],$_SESSION['employe']['tauxpaie'][$employe_id],$montant)) ?>
                                                </td>
                                            </tr>

                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <td colspan="1"><b><?php echo GetNomTypeRubrique($type); ?> </b></td>
                                            <td>
                                                <b> <?php echo afficheMontant($_SESSION['Paie_affiche'],montant_equivalent_bdd(getsymbole_local(),$_SESSION['Paie_affiche'],$_SESSION['employe']['tauxpaie'][$employe_id],$_SESSION[$type]['total'])); ?> </b>
                                            </td>
                                        </tr>
                                    <?php }
                                    $remuneration = $_SESSION['remuneration']['total'];
                                    $retenue =$_SESSION['retenue']['total'];
                                    $netpayer = $remuneration - $retenue; ?>
                                    <tr>
                                        <td colspan="1"><b>NET A PAYER </b></td>
                                        <td>
                                            <b> <?php echo afficheMontant($_SESSION['Paie_affiche'],montant_equivalent_bdd(getsymbole_local(),$_SESSION['Paie_affiche'],$_SESSION['employe']['tauxpaie'][$employe_id],$netpayer)); ?> </b>
                                        </td>
                                    </tr>
                                </tbody>
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
