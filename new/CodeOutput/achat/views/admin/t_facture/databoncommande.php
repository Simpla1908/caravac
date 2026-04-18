 <?php
    $j=1;
    $total=0;
    for ($i = 0; $i <= $nbArticles - 1; $i++) {
    ?>
    <tr>
        <td><?php echo $j; ?></td>
        <td><?php echo $_SESSION['commande']['designation'][$i]; ?></td>
        <td>
         <input type="text" value="<?php echo $_SESSION['commande']['qte_dispo'][$i] ?>" class="qte_cmd" id="<?php echo $_SESSION['commande']['produit_id'][$i] ?>" des="<?php echo $_SESSION['commande']['designation'][$i]; ?>" prix="<?php echo $_SESSION['commande']['prix_unit'][$i]; ?>">
        </td>
        <td>
        <input type="text" value="<?php echo $_SESSION['commande']['prix_unit'][$i]; ?>" class="prix_unit" id="<?php echo $_SESSION['commande']['produit_id'][$i] ?>" des="<?php echo $_SESSION['commande']['designation'][$i]; ?>" qte="<?php echo $_SESSION['commande']['qte_dispo'][$i]; ?>">
        </td>
        <td id="sous_tot"><?php echo format_chiffre($_SESSION['commande']['sous_tot'][$i]); ?></td>
        <td align="center">
           <input name="prodids" class="prodids" type="checkbox"  value="<?php echo $_SESSION['commande']['produit_id'][$i] ?>"> 
        </td>
    </tr>
   <?php $j++; $total=$total + $_SESSION['commande']['sous_tot'][$i];} ?>

