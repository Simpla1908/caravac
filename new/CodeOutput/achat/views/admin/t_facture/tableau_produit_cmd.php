<?php 
if ($_SESSION['nbArticles']!=-1) {
$j=1;
$total=0;
for ($i = 0; $i <= $_SESSION['nbArticles'] - 1; $i++) {
    $sous_tot = $_SESSION['commande']['qte_dispo'][$i] * $_SESSION['commande']['prix_unit'][$i];
    $unite=$_SESSION['commande']['unite'][$i];
    ?>

            <tr>
            <td><?php echo $j;?></td>
            <td><?php echo $_SESSION['commande']['designation'][$i];?></td>
            <td>
                <input size="10" type="text" value="<?php echo $_SESSION['commande']['qte_dispo'][$i];?>" class="qte" id="<?php echo $_SESSION['commande']['produit_id'][$i];?>">
            </td>
            <td><?php echo $unite;?></td>
            <td><?php echo format_chiffre($_SESSION['commande']['prix_unit'][$i]);?></td>
            <td><?php echo format_chiffre($sous_tot);?></td>
            <td align="center">
                <input name="ch_prod" class="ch_prod" type="checkbox" id="<?php echo $_SESSION['commande']['produit_id'][$i];?>" value="<?php echo $_SESSION['commande']['produit_id'][$i];?>"/></td></tr>;
<?php
$j++; 
$total=$total + $sous_tot;
$_SESSION['montant']=$total;
}
?>
<tr>
    <th colspan="5" align="right">Total </th>
    <th><?php echo format_chiffre($total);?></th>
    <th></th>
</tr>
<?php 
}
?>