
<div class="box-header with-border">
                <h3 class="box-title"></h3>
                <ul class="nav pull-right">

            <a href="<?php echo H_ADMIN; ?>&view=resconge&do=panelconge" class="btn btn-default btn-sm tip btndetailcgrtrn" title="<?php echo LANG_TIP_VIEWALL; ?>"><i class="fa fa-reply"></i> <?php echo LANG_GO_BACK; ?></a>
                </ul>

            </div>
             <div class="box-body">
  <table data-page="false" class="table table-bordered table-hover table-striped t1 t3 " data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th >Congé</th>
                            <th data-hide="phone,tablet">Date</th>
                            <th data-hide="phone,tablet">Nombre de jours</th>
                            <th data-hide="phone,tablet">Période</th>
                            <th data-hide="phone,tablet">Réference</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                       $i=1;
                       $_SESSION['conge'] = array();
                       $_SESSION['conge']['comment'] = array();
                        foreach ($result as $rows) {
                        $_SESSION['conge']['comment'][$rows->id]=$rows->comment;
                            ?>
                            <tr>
                                <td><?php echo ucfirst($rows->libelle);?></td>
                                <td><?php echo dateAffiche($rows->dte);?></td>
                                <td><?php echo $rows->nbre;?></td>
                                <td><?php echo 'Du '.dateAffiche($rows->dte1).' au '.dateAffiche($rows->dte2);?></td>

                                <td><?php echo $rows->ref; ?></td>
                                 <td class="table-actions">
                                    <div class="btn-group">
                 <a class="btn btn-default btn-xs tip btn_doc_conge" id="<?php echo $rows->id; ?>" conge_lib="<?php echo $rows->libelle; ?>" dte="<?php echo $rows->dte; ?>" dte1="<?php echo $rows->dte1; ?>" dte2="<?php echo $rows->dte2; ?>" ref="<?php echo $rows->ref; ?>" employe_id="<?php echo $rows->employe_id; ?>"  doc="<?php echo $rows->doc; ?>" noms="<?php echo $rows->noms; ?>" sexe="<?php echo $rows->sexe; ?>" adresse="<?php echo $rows->Adresse; ?>" rue="<?php echo $rows->rue; ?>" quartier="<?php echo $rows->quartier; ?>" commune="<?php echo $rows->commune; ?>"  ville="<?php echo $rows->ville; ?>" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>

                                    </div>
                                </td>
                            </tr>
                        <?php 
                        $i++;
                        } 
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="pagination"><?php // echo $paging; ?></div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                </div>