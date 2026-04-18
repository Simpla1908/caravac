
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
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
                <h3 class="box-title">Liste des résiliations</h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=decompte" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">
                <table data-page="false" class="table table-bordered table-hover table-striped t1 t2" data-filter="#filter">
                    <thead>
                        <tr>
                            <th data-hide="phone,tablet">Employé</th>
                            <th>Matricule</th>
                            <th data-hide="phone,tablet">Date</th>
                            <th data-hide="phone,tablet">Montant</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                       $montant = 0;
                        foreach ($result as $rows) {
                            $montant = $rows->montant;
                            $taux = $rows->taux;
                            $_SESSION['employe']['nom'][$rows->id]= $rows->noms;
                            $_SESSION['employe']['email'][$rows->id]= $rows->email;
                            $_SESSION['employe']['tel'][$rows->id]= $rows->tel1;
                            $_SESSION['employe']['adresse'][$rows->id]= $rows->Adresse;
                            $_SESSION['employe']['engagement'][$rows->id]= $rows->dteng;
                            $_SESSION['employe']['matricule'][$rows->id]= $rows->matricule;
                            $_SESSION['employe']['fonction'][$rows->id]= $rows->fonction;
                            $_SESSION['employe']['periode'][$rows->id]= $rows->libelle;
                            $_SESSION['employe']['dtepaie'][$rows->id]= $rows->dte;
                            $_SESSION['employe']['dtepaie'][$rows->id]= $rows->dte;
                            $_SESSION['employe']['totbase'][$rows->id]= $rows->totbase;
                            $_SESSION['employe']['tauxpaie'][$rows->id]=$taux;
                            
                            if ($_SESSION['Paie_affiche'] == getsymbole_devise()){
                                $montant = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $montant);
                            }
                            ?>
                            <tr>
                                <td><?php echo $rows->noms; ?></td>
                                <td><?php echo $rows->matricule; ?></td>
                                <td><?php echo dateAffiche($rows->dte2); ?></td>
                                <td><?php echo afficheMontant($_SESSION['Paie_affiche'],$montant); ?></td>
                                <td class="table-actions">
                                    <div class="btn-group">
                                        <a href="<?php echo H_ADMIN; ?>&view=ressalaire&id=<?php echo $rows->id; ?>&do=details3"  class="btn btn-info btn-xs"><span class="fa fa-list fa-fw tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span></a>
                                        <a href="<?php echo H_ADMIN_MAIN; ?>&view=impression&id=<?php echo $rows->id; ?>&employe_id=<?php echo $rows->employe_id; ?>&do=resiliation" class="btn btn-primary btn-xs"><span class="fa fa-print tip" title="<?php echo 'Imprimer'; ?>"></span></a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->