<?php
if (!isset($_SESSION)) {
    session_start();
 }
 
$i=1;
foreach ($result as $rows) {
    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $rows->numBon_liv; ?></td>
        <td><a href="<?php echo H_ADMIN; ?>&view=ach_livraison&id_liv=<?php echo $rows->id_liv; ?>&bcommande_id=<?php echo $rows->bcommande_id; ?>&do=fiche"  class="btn btn-info btn-xs"><?php echo $rows->num_fact; ?></a></td>
        <td><?php echo dateAffiche($rows->date); ?></td>
        <td><?php echo ucfirst($rows->nom_entreprise); ?></td>
        <td><?php echo ucfirst($rows->nom_user.' '.$rows->prenom_user); ?></td>
        <td class="table-actions">
            <div class="btn-group">
                <a href="<?php echo H_ADMIN; ?>&view=ach_livraison&id_liv=<?php echo $rows->id_liv; ?>&do=details"  class="btn btn-info btn-xs"><span class="fa fa-search-plus tip" title="<?php echo LANG_TIP_DETAILS; ?>"></span></a>
                <a href="<?php echo H_ADMIN; ?>&view=ach_livraison&id_liv=<?php echo $rows->id_liv; ?>&do=update" class="btn btn-primary btn-xs"><span class="fa fa-edit tip" title="<?php echo LANG_TIP_UPDATE; ?>"></span></a>
                <a href="<?php echo H_ADMIN; ?>&view=ach_livraison&id_liv=<?php echo $rows->id_liv; ?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>
            </div>
        </td>
    </tr>
<?php 
    //Mise en session pour impression
    array_push($_SESSION['rows_livraison']['i'], $i);
    array_push($_SESSION['rows_livraison']['num_liv'], $rows->numBon_liv);
    array_push($_SESSION['rows_livraison']['num_cmd'], $rows->num_fact);
    array_push($_SESSION['rows_livraison']['date'], dateAffiche($rows->date));
    array_push($_SESSION['rows_livraison']['fsse'], ucfirst($rows->nom_entreprise));
    array_push($_SESSION['rows_livraison']['user'], ucfirst($rows->nom_user.' '.$rows->prenom_user));
    //Fin mise en session

$i++;} ?>

