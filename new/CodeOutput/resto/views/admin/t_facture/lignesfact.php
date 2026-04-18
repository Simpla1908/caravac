<?php 
    for ($i = 0; $i <= $nbArticles - 1; $i++) {
      $qte=$_SESSION['panier']['qte'][$i];
      $monttva=$_SESSION['panier']['monttva'][$i];
      $prix=$_SESSION['panier']['prix'][$i];
      $montant=prixFacturation($prix,$monttva)*$qte;
     
    ?>
<tr>
    <td><?php echo $_SESSION['panier']['nom'][$i] ?></td>
    <td><input size="10" type="number" min="1" value="<?php echo $qte ?>" class="qte" id="<?php echo $_SESSION['panier']['id_article'][$i] ?>"></td>
    <td><?php echo afficheMontant($_SESSION['Paie_affiche'],$prix)  ?></td>
     <td><?php echo afficheMontant($_SESSION['Paie_affiche'],$monttva)  ?></td>
    <td><?php echo afficheMontant($_SESSION['Paie_affiche'],$montant)  ?></td>
    <td>
        <div class="tools text-center">
            <a class="btn btn-danger btn-xs ch_prod" title="Selectionner & Supprimer" id="<?php echo $_SESSION['panier']['id_article'][$i] ?>" ><i class="fa fa-trash-o"></i> Supprimer</a>
        </div>
    </td>
</tr>
<?php };?>

