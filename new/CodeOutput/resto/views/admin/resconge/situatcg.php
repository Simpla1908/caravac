         <?php
            $result = $this->resconge_model->SelectAll1($_SESSION['idsite']);
        ?>

  <table data-page="false" class="table table-bordered table-hover table-striped" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>Employé</th>
                            <th data-hide="phone,tablet">Congés</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                        foreach ($result as $rows) {
                            ?>
                                <td><?php echo ucfirst($rows->noms);?></td>
                                <td><?php echo $rows->nbrcg; ?></td>
                                 <td class="table-actions">
                                    <div class="btn-group">
                                         <a href="<?php echo H_ADMIN; ?>&view=resconge&id=<?php echo $rows->employe_id; ?>&do=detailcgemply"  id="<?php echo $rows->employe_id; ?>"  class="btn btn-info btn-xs btndetailcg"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span></a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6">
                                <div class="pagination"></div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
