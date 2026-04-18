<?php
if (!isset($_SESSION)) {
    session_start();
 }
 
$i=1;
foreach ($result as $rows) {
    if($rows->statut_bon=='envoye'){
        $statut='Envoyé';
        $colorLign='text-black';
    }  elseif ($rows->statut_bon=='rejete') {
        $statut='Rejeté';
        $colorLign='text-red';
    }  else {
        $statut='Bon de commande';
        $colorLign='text-green';
    }
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $rows->num_fact; ?></td>
        <td><?php echo $rows->justification; ?></td>
        <td><?php echo dateAffiche($rows->date_edition); ?></td>
        <td><?php echo $rows->nom_entreprise; ?></td>
        <td><?php echo format_chiffre($rows->tot_cmd); ?></td>
        <td><?php echo $rows->monnaie; ?></td>
        <td class="<?php echo $colorLign; ?>"><?php  echo $statut; ?></td>
        <td class="table-actions">
            <div class="btn-group">
                <a href="<?php echo H_ADMIN; ?>&view=t_facture&id_fact=<?php echo $rows->id_fact; ?>&do=details_besoins"  class="btn btn-info btn-xs"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span></a>
                <?php if (in_array('ACHMEB', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                <!--<a href="<?php echo H_ADMIN; ?>&view=t_facture&id_fact=<?php echo $rows->id_fact; ?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>-->
                <?php } ?>
                <?php if (in_array('ACHSEB', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                <a href="<?php echo H_ADMIN; ?>&view=t_facture&id_fact=<?php echo $rows->id_fact; ?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
                <?php } ?>
            </div>
        </td>
    </tr>
<?php 
    //Mise en session pour impression
    array_push($_SESSION['rows_bc']['i'], $i);
    array_push($_SESSION['rows_bc']['Bon_cmd'], $rows->num_fact);
    array_push($_SESSION['rows_bc']['Description'], $rows->justification);
    array_push($_SESSION['rows_bc']['date'], dateAffiche($rows->date_edition));
    array_push($_SESSION['rows_bc']['fsse'], ucfirst($rows->nom_entreprise));
    array_push($_SESSION['rows_bc']['Total'], format_chiffre($rows->tot_cmd));
    array_push($_SESSION['rows_bc']['Devise'], $rows->monnaie);
    array_push($_SESSION['rows_bc']['Statut'], $statut);   
    //Fin mise en session

$i++;} ?>

