
<?php
/*
 * =======================================================================
 * FILE NAME:        View.php
 * DATE CREATED:    18-04-2019
 * FOR TABLE:       cptjournal
 * PRODUCED BY:     HEZECOM UltimateSpeed PHP CODE GENERATOR
 * AUTHOR:          Hezecom (http://hezecom.com) info@hezecom.net
 * =======================================================================
 */
if (!defined('VALID_DIR'))
    die('You are not allowed to execute this file directly');
?>
<?php AjaxSearchSuggest('' . H_ADMIN_MAIN . '&view=cptjournal&do=autosearch'); ?>

<div class="row">
    <div class="col-xs-12">
        <div class="box">

            <div class="box-header with-border">
                <h3 class="box-title" id="titlecl">Demande de paiement</h3>
                <ul class="nav pull-right">
                </ul>

            </div><!-- /.box-header -->
            <div class="box-body" id="contentdatafilter">
               <table class="table table-striped table-bordered table-hover table-condensed" id="dataTables-example2">
                                    <thead>
                                        <tr>
                                            <th>N°</th>
                                            <th>Bon cmd</th>
                                            <th>Motif</th>
                                            <th>Montant</th>
                                            <th>Bénéficiaire</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                       //var_dump($operations);
                                       $i=1;foreach($operations as $operation):
                                       ?>
                                            <?php 
                                            MontantsFacture($operation->id_fact);    
                                            $solde_paye =$_SESSION['montant_a_paye'];
                                            if($_SESSION['datas_exist']==0){
                                              $solde_paye=round($operation->tot_cmd,2);
                                             ?>
                                           <tr>
                                               <td><?php echo $i ?></td>
                                               <td><?php echo $operation->num_fact ?></td>
                                               <td><?php echo $operation->justification ?></td>
                                               <td><?php echo format_chiffre($operation->tot_cmd).' '.$operation->monnaie ?></td>
                                               <td><?php echo $operation->nom_entreprise ?></td>
                                               <td><?php echo dateAffiche($operation->date_edition) ?></td>
                                               <td><a href="./index.php?pg=admin&view=tresorerie&do=bon_sorti_paiement&mode=<?php echo $operation->mode ?>&id_client=<?php echo $operation->id_client ?>&id_fact=<?php echo $operation->id_fact ?>&motif=<?php echo $operation->justification ?>&monnaie=<?php echo $operation->monnaie ?>&beneficiaire=<?php echo $operation->nom_entreprise ?>&montant=<?php echo $solde_paye ?>" class="btn btn-danger btn-xs"><i class="fa fa-money"></i> Payer</a></td>
                                           </tr>
                                            <?php }else{ ?>
                                           <tr>
                                               <td><?php echo $i ?></td>
                                               <td><?php echo $operation->num_fact ?></td>
                                               <td><?php echo $operation->justification ?></td>
                                               <td><?php echo format_chiffre($solde_paye).' '.$operation->monnaie ?></td>
                                               <td><?php echo $operation->nom_entreprise ?></td>
                                               <td><?php echo dateAffiche($operation->date_edition) ?></td>
                                               <td><a href="./index.php?pg=admin&view=tresorerie&do=bon_sorti_paiement&mode=<?php echo $operation->mode ?>&id_client=<?php echo $operation->id_client ?>&id_fact=<?php echo $operation->id_fact ?>&motif=<?php echo $operation->justification ?>&monnaie=<?php echo $operation->monnaie ?>&beneficiaire=<?php echo $operation->nom_entreprise ?>&montant=<?php echo $solde_paye ?>" class="btn btn-danger btn-xs"><i class="fa fa-money"></i> Payer</a></td>
                                           </tr>
                                            <?php }?>
                                        <?php $i++;endforeach;?>
                                    </tbody>
                                </table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->


