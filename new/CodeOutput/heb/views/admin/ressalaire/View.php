
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
                <h3 class="box-title">Bulletins de paie</h3>
                <ul class="nav pull-right">
                    <a href="<?php echo H_ADMIN; ?>&view=ressalaire&do=add" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_ADD; ?>"><i class="fa fa-plus"></i> <?php echo LANG_ADD; ?></a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">
                <table data-page="false" class="table table-bordered table-hover table-striped t1 t2" data-filter="#filter">
                    <thead>
                        <tr>
                            <th data-hide="phone,tablet">Employé</th>
                             <th>Matricule</th>
                            <th data-hide="phone,tablet">Mois</th>
                            <th data-hide="phone,tablet">Date</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $_SESSION['employe']['nom']=array();
                        $_SESSION['employe']['email']=array();
                        $_SESSION['employe']['tel']=array();
                        $_SESSION['employe']['adresse']=array();
                        $_SESSION['employe']['engagement']=array();
                        $_SESSION['employe']['matricule']=array();
                        $_SESSION['employe']['fonction']=array();
                        $_SESSION['employe']['periode']=array();
                        $_SESSION['employe']['dtepaie']=array();
                        $_SESSION['employe']['totbase']=array();
                        $_SESSION['employe']['tauxpaie']=array();
                        $i = 1;
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
                            
                            if ($_SESSION['Paie_affiche'] == getsymbole_devise()) {
                                $montant = montant_equivalent_bdd(getsymbole_local(), $_SESSION['Paie_affiche'], $taux, $montant);
                            }
                            ?>
                            <tr>
<!--                                <td><?php // echo $i; ?></td>-->
                                <td><?php echo $rows->noms; ?></td>
                                 <td><?php echo $rows->matricule; ?></td>
                                <td><?php echo $rows->libelle; ?></td>
                                <td><?php echo dateAffiche($rows->dte); ?></td>
                                <td class="table-actions">
                                    <div class="btn-group">
                                        <a href="<?php echo H_ADMIN; ?>&view=ressalaire&id=<?php echo $rows->id; ?>&employe_id=<?php echo $rows->employe_id ; ?>&do=details"  class="btn btn-info btn-xs"><span class="fa fa-list fa-fw tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span></a>
                                        <a href="<?php echo H_ADMIN; ?>&view=ressalaire&id=<?php echo $rows->id; ?>&do=update" class="btn btn-primary btn-xs hidden"><span class="fa fa-print tip" title="<?php echo 'Imprimer'; ?>"></span></a>
                                        <a href="<?php echo H_ADMIN; ?>&view=ressalaire&id=<?php echo $rows->id; ?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
                                    </div>
                                </td>
                            </tr>
                            <?php $i++;
                        } ?>
                    </tbody>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->