<?php
session_start();
include('../bdd/connexion.php');
$idfamille=$_GET['famille_id'];
if($idfamille==0){
    $requete = $bdd->prepare("SELECT p.idprod,p.designation,p.unite FROM  stk_produit AS p,stk_sous_famille AS s_fam ,stk_famille AS fam"
                          . " WHERE p.pseudo_supp=0 AND p.repas!=1 AND p.famille_id=s_fam.id_s_fam AND p.hotel_id=:hotel_id AND s_fam.famille=fam.idfamille AND fam.plat=0 ORDER BY designation");

    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $produits = $requete-> fetchAll(PDO::FETCH_OBJ);  
}else{
   $requete = $bdd->prepare("SELECT p.idprod,p.designation,p.unite FROM  stk_produit AS p,stk_sous_famille AS s_fam ,stk_famille AS fam"
                          . " WHERE p.pseudo_supp=0 AND p.repas!=1 AND p.famille_id=s_fam.id_s_fam AND s_fam.famille=fam.idfamille AND fam.plat=0 AND fam.idfamille=:id  ORDER BY designation");

    $requete->BindParam(':id',$idfamille);
    $requete->execute();
    $produits = $requete-> fetchAll(PDO::FETCH_OBJ);  
}

?>
<option>  </option>
<?php
foreach ($produits as $p) {
    ?>
    <option value='<?php echo $p->idprod; ?>'prod_nom="<?php echo $p->designation; ?>" unite="<?php echo $p->unite; ?>"><?php echo ucfirst($p->designation); ?></option>
<?php } ?>