  <table data-page="false" class="table table-bordered table-hover table-striped t1 t2" data-filter="#filter" data-page-size="<?php echo RECORD_PER_PAGE; ?>" data-page-previous-text="<?php echo LANG_PREVIOUS; ?>" data-page-next-text="<?php echo LANG_NEXT; ?>">
      <thead>
          <tr>
              <th>#</th>
              <th data-hide="phone,tablet">DATE</th>
              <th data-hide="phone,tablet">EXERCICE</th>
              <th data-hide="phone,tablet">DEVISE</th>
              <th data-sort-ignore="trsue">ACTION</th>
          </tr>
      </thead>
      <tbody>
          <?php
            $i = 1;

            foreach ($result as $rows) {
            ?>
              <tr>
                  <td><?php echo $i ?></td>
                  <td><?php echo dateAffiche($rows->dte) ?></td>
                  <td><?php echo ucfirst($rows->libelle); ?></td>
                  <td><?php echo $rows->devise; ?></td>
                  <td class="table-actions">
                      <div class="btn-group">
                          <a href="<?php echo H_ADMIN; ?>&view=cptprevision&do=details&id=<?php echo $rows->id; ?>" class="btn btn-info btn-xs"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span></a>
                      </div>
                  </td>

              </tr>
          <?php
                $i++;
            }
            ?>

      </tbody>
  </table>