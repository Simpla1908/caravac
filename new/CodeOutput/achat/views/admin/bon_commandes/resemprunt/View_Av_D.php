
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:   17-11-2017
 * FOR TABLE:      resemprunt
 * PRODUCED BY:    HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:     Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<?php AjaxSearchSuggest('' . H_ADMIN_MAIN . '&view=resemprunt&do=autosearch'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title">Avance</h3>
                <ul class="nav pull-right">

            <a href="<?php echo H_ADMIN; ?>&view=resemprunt&do=view_av" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
                    <a href="<?php echo H_ADMIN_MAIN; ?>&view=resemprunt&do=export&hexport=yes&etype=printer" target="_blank" class="btn btn-default btn-xs tip" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body">   
                <table data-page="false" class="table table-bordered table-hover table-striped t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>Date</th>
                             <th data-hide="phone,tablet">Numéro</th>
                            <th data-hide="phone,tablet">Mois de rembourse.</th>
                            <th data-hide="phone,tablet">Montant emprunté</th>
                            <th data-hide="phone,tablet">Montant remboursé</th>
                            <th data-hide="phone,tablet">Reste</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $employe_id = 0;
                        $noms = '';
                        $dte = '';
                        $dte_deduct = '';
                        $montant = 0;
                        $montrembourse = 0;
                        $tot_montant=0;
                         $tot_montrembourse=0;
                        $reste = 0;
                        foreach ($result as $rows) {
                            $employe_id = $rows->employe_id;
                            $emprunt_id=$rows->idresemprunt;
                            $noms = $rows->noms;
                            $dte = $rows->dte;
                            $numero =$rows->num_emprnt;
                            $dte_deduct = $rows->dte_deduct;
                            $montant = montant_equivalent_bdd($rows->monnaieresemprunt, $_SESSION['Paie_affiche'], $rows->tauxresemprunt, $rows->montant);
                            $libelle = $rows->libelle;
                            $site_id = $_SESSION['idsite'];
                            $result2=MontantRembourse1($emprunt_id,$employe_id,$libelle,$site_id);
                            foreach ($result2 as $rows2) {
                                $montrembourse += montant_equivalent_bdd($rows2->monnaierembourse, $_SESSION['Paie_affiche'], $rows2->tauxremourse, $rows2->montrembourse);
                            }
                            $reste = $montant - $montrembourse;
                            ?>
                            <tr>
                                <td><?php echo dateAffiche($dte); ?></td>
                                <td><?php echo $numero; ?></td>
                                <td><?php echo $dte_deduct; ?></td>
                                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $montant); ?></td>
                                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $montrembourse); ?></td>
                                <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $reste); ?></td>
                                <td class="table-actions">
                                    <div class="btn-group">
                                        <?php
                                          if($montrembourse>0){  
                                              ?>
   <a href="<?php echo H_ADMIN;?>&view=resemprunt&employe_id=<?php echo $employe_id;?>&id=<?php echo $rows->idresemprunt;?>&do=details_av"  class="btn btn-info btn-xs"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS;?>"></span></a>
                                         <?php
                                             }  
                                             ?>
                                        <a href="<?php echo H_ADMIN_MAIN; ?>&view=resemprunt&do=export&hexport=yes&etype=printer" target="_blank"   noms="<?php echo $noms;?>" numero="<?php echo $numero;?>" montant="<?php echo $montant;?>" class="btn btn-default btn-xs tip btn_prnt_recu_avance" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>


                                    </div>
                                </td>
                            </tr>
                            <?php
                             $tot_montant+=$montant;
                            $tot_montrembourse+=$montrembourse;
                            $montrembourse = 0;
                        }
                        ?>
                    </tbody>
                    <tfoot>
  <tr>
  <td></td>
    <td></td>
  <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $tot_montant);?></td>
  <td><?php echo afficheMontant($_SESSION['Paie_affiche'], $tot_montrembourse);?></td>
  <td></td>
  <td></td>
  </tr>
</tfoot>
                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->