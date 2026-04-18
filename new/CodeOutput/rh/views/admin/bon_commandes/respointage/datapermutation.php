<?php
$result = $this->respointage_model->ViewPermut($_SESSION['idsite']);
foreach($result as $rows)
{
?>
<tr>
    <td><?php echo $rows->num; ?></td>
    <td><?php echo dateAffiche($rows->dte); ?></td>
    <td><?php echo dateAffiche($rows->dtefin); ?></td>
    <td><?php echo $rows->libhoraire; ?></td>
    <td><?php echo $rows->nomsagent1; ?></td>
    <td><?php echo $rows->nomsagent2; ?></td>
    <td><?php echo $rows->type_lib; ?></td>
    <td class="table-actions">
        <div class="btn-group">
            <a 	id_perm="<?php echo $rows->id; ?>" dte="<?php echo $rows->dte; ?>" idagent1="<?php echo $rows->idagent1; ?>"  idagent2="<?php echo $rows->idagent2; ?>" idhoraire="<?php echo $rows->idhoraire; ?>"
               class="btn btn-primary btn-xs btnannulperm"><span>Annuler</span></a>

            <a href="<?php echo H_ADMIN_MAIN; ?>&view=respointage&do=export&hexport=yes&etype=printer" target="_blank"   num="<?php echo $rows->num;?>" dte="<?php echo dateAffiche($rows->dte);?>" dte_fin="<?php echo dateAffiche($rows->dtefin);?>" shift="<?php echo $rows->libhoraire;?>" tit="<?php echo $rows->nomsagent1;?>" rem="<?php echo $rows->nomsagent2;?>" type="<?php echo $rows->type_code;?>" class="btn btn-default btn-xs tip btn_prnt_bn_perm" title="<?php echo LANG_TIP_PRINT; ?>"><i class="fa fa-print"></i> <?php echo LANG_PRINT; ?></a>

        </div>
    </td>
</tr>
<?php
}

?>
