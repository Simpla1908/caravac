        <table data-page="false" class="table table-bordered table-condensed table-hover table-striped t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>N°</th>
<!--                            <th data-hide="phone,tablet">Date</th>-->
                            <th data-hide="phone,tablet">Fournisseurs</th>
                            <th data-hide="phone,tablet">N° Bon cmd</th>
                            <th data-hide="phone,tablet">Montant total</th>
                            <th data-hide="phone,tablet">Montant payé</th>
                            <th data-hide="phone,tablet">Solde</th>
                            <!--<th data-sort-ignore="true"><?php // echo LANG_ACTIONS; ?></th>-->
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $i=1;
                        foreach ($result as $rows) {
                            $monnaie_boncmd=$rows->monnaie;
                            $taux=$rows->taux;
                            $montantboncmd = montant_equivalent_bdd($monnaie_boncmd,$monnaie_boncmd,$taux,$rows->mont_ttc);
                            $montant_paye=totalMontantPaye($rows->id_fact);
                            $montant_payer = montant_equivalent_bdd($monnaie_boncmd,$monnaie_boncmd,$taux,$montant_paye);
                            $solde=$montantboncmd - $montant_payer;
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $rows->nom_entreprise; ?></td>
                                <td><a href="#"><?php echo $rows->num_cmd; ?></a></td>
                                <td><?php echo format_chiffre($montantboncmd).' '.$monnaie_boncmd; ?></td>
                                <td><?php echo format_chiffre($montant_payer).' '.$monnaie_boncmd; ?></td>
                                <td class="<?php // echo $colorLign; ?>"><?php  echo format_chiffre($solde).' '.$monnaie_boncmd;; ?></td>
                                <td class="table-actions">
                                    <div class="btn-group">
                                        <a href="<?php echo H_ADMIN;?>&view=paiement&id_fact=<?php echo $rows->id_fact; ?>&do=detailspaie"  class="btn btn-info btn-xs"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS;?>"></span></a>
                                        <?php if ($solde!=0) { ?>
                                        <?php if (in_array('ACHRDP', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                                        <a href="<?php echo H_ADMIN; ?>&view=paiement&id_fact=<?php echo $rows->id_fact; ?>&solde=<?php echo $solde; ?>&do=demande" class="btn btn-danger btn-xs"> <span class="fa fa-send tip" title="Envoie demande de paiement"> </span></a>
                                        <?php } ?>
                                        <?php } ?>
<!--                                        <a href="<?php echo H_ADMIN;?>&view=paiement&idpaie=<?php echo $rows->idpaie;?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE;?>"></span></a>
                                         <a href="<?php echo H_ADMIN;?>&view=paiement&idpaie=<?php echo $rows->idpaie;?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH;?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE;?>"></span></a>-->
                                    </div>
                                </td>
                            </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>