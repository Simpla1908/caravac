<?php
foreach ($result as $rows) {
    $monnaie_fact=$rows->monnaie;
    $id_fact=$rows->id_fact;
    if (in_array($id_fact,$montantFactures['facture_ids'])) {
        $montant_paye=$montantFactures['montantpaye'][$id_fact];
    }else{
      $montant_paye=0;  
    }
    $taux=getTauxFacture2($monnaie_fact,$_SESSION['Paie_taux'],$rows->taux);
    $montantfact = montant_equivalent_bdd($monnaie_fact,$_SESSION['Paie_affiche'],$taux,$rows->mont_ttc_remise);
    $solde=$montantfact-$montant_paye;
    ?>
    <tr>
        <td><?php echo $rows->num_fact; ?></td>
        <td><?php echo dateAffiche($rows->date_edition); ?></td>
        <td><?php echo dateAffiche($rows->date_echeance); ?></td>
        <td><?php echo $rows->nom_client; ?></td>
        <td><?php echo afficheMontant($_SESSION['Paie_affiche'],$montantfact)?></td>
        <td><?php echo afficheMontant($_SESSION['Paie_affiche'],$montant_paye); ?></td>
        <td><?php echo afficheMontant($_SESSION['Paie_affiche'],$solde); ?></td>
        <td class="table-actions">
            <div class="btn-group">
                <a href="<?php echo H_ADMIN; ?>&view=t_facture&id_fact=<?php echo $rows->id_fact; ?>&do=details"  class="btn btn-info btn-xs"><span class="fa fa-search-plus tip" title="<?php echo 'Voir détails'; ?>"></span></a>
                 <!--<a href="<?php echo H_ADMIN; ?>&view=t_facture&id_fact=<?php echo $rows->id_fact; ?>&do=delete" class="btn btn-danger btn-xs" data-confirm="<?php echo LANG_DELETE_AUTH; ?>"> <span class="fa fa-times tip" title="<?php echo LANG_TIP_DELETE; ?>"></span></a>-->
            </div>
        </td>
    </tr>
<?php } ?>

