<?php
$i = 1;
foreach ($result as $rows) {
    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $rows->noms; ?></td>
        <td><?php echo $rows->presence;?></td>
        <td><?php echo $rows->absence;?></td>
        <td ><?php echo $rows->retard;?></td>
        <td><?php echo $rows->malade; ?></td>
        <td><?php echo $rows->conge; ?></td>
        <td class="table-actions">
            <div class="btn-group">
                <a href="<?php echo H_ADMIN; ?>&view=respointage&id=<?php echo $rows->employe_id; ?>&do=details&datedebut=<?php echo $_SESSION['datedebut']; ?>&datefin=<?php echo $_SESSION['datefin']; ?>"  class="btn btn-info btn-xs"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span> Détails</a>
<!--                <a href="<?php echo H_ADMIN; ?>&view=respointage&id=<?php echo $rows->id; ?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>
                <a href="<?php echo H_ADMIN; ?>&view=respointage&id=<?php echo $rows->id; ?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>-->
            </div>
        </td>
    </tr>
    <?php $i++;
} ?>