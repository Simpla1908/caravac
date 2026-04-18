
<?php
$nbFamille=$_SESSION['nbFamille'];
$nb_sFamille = $_SESSION['nb_sFamille'];
$s_familles=$_SESSION['s_familles'];
$produits=$_SESSION['produits'];
for ($i = 0; $i <= $nbFamille - 1; $i++){
    $id_fam=$_SESSION['fam']['id'][$i];
    $libelle_fam=$_SESSION['fam']['des_fam'][$id_fam];
?>
    <a href="#" class="btn btn-squared-default btn-default s_fam"
       title="<?php echo $libelle_fam; ?>"
       id="<?php echo "s".$id_fam; ?>" style="width:120px;margin-bottom: 4px">
        <span class="badge bg-aqua"><?php echo AfficheNom2($libelle_fam); ?></span><br/>
        <i class="fa fa-barcode fa-3x"></i><br/><br/>
    </a>
  
<?php } ?>

