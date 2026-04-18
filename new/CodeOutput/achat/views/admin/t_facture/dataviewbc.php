
<?php
$i = 1;
foreach ($result as $rows) {

    if ($rows->statut_bon == 'envoye') {
        $statut = 'Etat de besoins';
        $colorLign = 'label label-primary';
    } elseif ($rows->statut_bon == 'paye') {
        $statut = 'Payé';
        $colorLign = 'label label-default';
    } elseif ($rows->statut_bon == 'approuve') {
        $statut = 'Approuvé';
        $colorLign = 'label label-warning';
    } elseif ($rows->statut_bon == 'rejete') {
        $statut = 'Rejeté';
        $colorLign = 'label label-danger';
    } elseif ($rows->statut_bon == 'attente') {
        $statut = 'En attente';
        $colorLign = 'label label-success';
    }
    ?>
    <tr>
        <td><?php echo $i ?></td>
        <td><?php echo $rows->num_cmd; ?></td>
        <td><?php echo $rows->num_fact; ?></td>
        <td><?php echo $rows->justification; ?></td>
        <td><?php echo dateAffiche($rows->date_edition); ?></td>
        <td><?php echo $rows->nom_entreprise; ?></td>
        <td><?php echo format_chiffre($rows->tot_cmd); ?></td>
        <td><?php echo $rows->monnaie; ?></td>
        <td class="<?php echo $colorLign; ?>"><?php echo $statut; ?></td>
        <td class="table-actions">
            <div class="btn-group">
                <?php if ($rows->statut_bon == 'approuve' || $rows->statut_bon == 'paye' || $rows->statut_bon == 'attente' || $rows->statut_bon == 'rejete') { ?>
                    <a href="<?php echo H_ADMIN; ?>&view=t_facture&id_fact=<?php echo $rows->id_fact; ?>&do=details_commande"  class="btn btn-info btn-xs"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span></a>
                <?php } else { ?>
                    <a href="<?php echo H_ADMIN; ?>&view=t_facture&id_fact=<?php echo $rows->id_fact; ?>&do=update_commande"  class="btn btn-info btn-xs"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span></a>
                <?php } ?>
                <?php if (in_array('ACHMBC', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                    <!--<a href="<?php echo H_ADMIN; ?>&view=t_facture&id_fact=<?php echo $rows->id_fact; ?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>-->
                <?php } ?>
                <?php if (in_array('ACHSBC', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?>
                    <a href="<?php echo H_ADMIN; ?>&view=t_facture&id_fact=<?php echo $rows->id_fact; ?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
                <?php } ?>
                <?php if ($rows->statut_bon == 'approuve') { ?>
                    <?php if (in_array('ACHEDPBC', $_SESSION['actions']['code_actions']) || $_SESSION['type_user'] == 1) { ?> 
                        <a href="<?php echo H_ADMIN; ?>&view=t_facture&id_fact=<?php echo $rows->id_fact; ?>&do=demande" class="btn btn-success btn-xs"> <span class="fa fa-send tip" title="Envoie demande de paiement"></span></a>
                        <?php } ?>
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
    $i++;
}
?>

