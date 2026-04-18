<div class="col-lg-12">
      <table id="example1" class="table table-bordered table-striped table-condensed example1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Designation</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($libelles as $l) {
                        $id = $l->id;
                        $designation = $l->designation;
                     ?> 
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $designation ?></td>
                                <td> 
                                    <a href="<?php // echo H_ADMIN;?>&view=groupe&id=<?php // echo $rows->id;?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php // echo LANG_TIP_UPDATE;?>"></span></a>
                                     <a href="<?php // echo H_ADMIN;?>&view=groupe&id=<?php // echo $rows->id;?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php // echo LANG_DELETE_AUTH;?>"> <span class="fa fa-times tip" title="<?php // echo LANG_TIP_DELETE;?>"></span></a>
                                </td>
                            </tr>
                            <?php
                            $i++;
                    }
                    ?> 
                </tbody>
            </table>
</div>

