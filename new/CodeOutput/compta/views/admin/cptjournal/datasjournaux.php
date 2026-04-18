  <table data-page="false" class="table table-bordered table-hover table-striped t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Date</th>
                            <th data-hide="phone,tablet">Type de journal</th>
                            <th data-hide="phone,tablet">Réfernce</th>
                            <th data-hide="phone,tablet">Description</th>
                            <th data-sort-ignore="true"><?php echo LANG_ACTIONS; ?></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                      $i=1;
                     foreach ($result as $rows) {
                      if($rows->reference!="RES00001"){
                      ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo dateAffiche($rows->dte) ?></td>
                        <td><?php echo ucfirst($rows->typejournal); ?></td>
                        <td><?php echo $rows->reference;?></td>
                        <td><?php echo ucfirst($rows->description);?></td>
                         <td class="table-actions">
                            <div class="btn-group">
                                <a href="<?php echo H_ADMIN; ?>&view=cptjournal&do=details&id=<?php echo $rows->id; ?>"  class="btn btn-info btn-xs"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span></a>
                                  <?php if($rows->lettrer==1){;?>  
                                  <a class="btn btn-success btn-xs">Lettrée</a>
                                  <?php
                                   }
                                  ?>

                            </div>
                        </td>
                       
                    </tr>
                    <?php
                    $i++;
                     }
                     } 
                     ?>
                   
                    </tbody>
                </table>