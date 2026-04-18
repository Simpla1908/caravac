<?php 
    for ($i = 0; $i <= $nbArticles - 1; $i++) {
      $qte=$_SESSION['panier']['qte'][$i];
      $monttva=$_SESSION['panier']['monttva'][$i];
      $prix=$_SESSION['panier']['prix'][$i]-$monttva;
      $montant=($prix*$qte)+($monttva*$qte);
     
    ?>
<tr>
    <td><?php echo $_SESSION['panier']['nom'][$i] ?></td>
    <td><?php echo $qte ?></td>
    <td><?php echo afficheMontant($_SESSION['Paie_affiche'],$prix-$monttva)  ?></td>
    <td><?php echo afficheMontant($_SESSION['Paie_affiche'],$monttva)  ?></td>
    <td><?php echo afficheMontant($_SESSION['Paie_affiche'],$montant)  ?></td>
    
</tr>
<?php };?>

