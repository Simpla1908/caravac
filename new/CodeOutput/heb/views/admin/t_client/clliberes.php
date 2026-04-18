<table data-page="false" class="table table-bordered table-hover table-striped table-condensed t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th data-hide="phone,tablet">Responsable</th>
                            <th data-hide="phone,tablet">Chambre</th>
                            <th data-hide="phone,tablet">Arrivée</th>
                            <th data-hide="phone,tablet">Sortie</th>
                            <th data-hide="phone,tablet">Nuitée</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        foreach ($result as $r) {
                            ?>
                            <tr>
                                <td><?php echo $r->nom_client ?></td>
                                <td><?php echo $r->entreprise ?></td>
                                <td><?php echo $r->num_ch ?></td>
                                <td><?php echo dateAffiche($r->date_occ) ?></td>
                                <td><?php echo dateAffiche($r->date_lib) ?></td>
                                <td><?php echo NbJours($r->date_occ, $r->date_lib) ?></td>
                                <td class="table-actions">
                                    <div class="btn-group">
                                         <a href="<?php echo H_ADMIN; ?>&view=t_reservation&id_resch=<?php echo $r->id_resch; ?>&do=add&lib=1" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <!-- <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="pagination"><?php // echo $paging; ?></div>
                            </td>
                        </tr>
                    </tfoot>-->
                </table>