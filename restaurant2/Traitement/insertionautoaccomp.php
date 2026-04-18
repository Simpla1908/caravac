
<?php
//recuperation les accompagnement
$requete = $bdd->prepare("SELECT prod.idprod,prod.designation,prod.unite FROM stk_produit AS prod,stk_sous_famille AS s_fam WHERE  prod.famille_id=s_fam.id_s_fam  AND s_fam.id_s_fam IN()");
$requete->execute();
$accomp= $requete->fetch(PDO::FETCH_OBJ);
foreach ($accomp as $ac){
 $idprod=$ac->idprod;
    $designation=$ac->designation;
    $quantite=1;
    $unite=$ac->unite;
    array_push($_SESSION['accomp']['accomp_id'],$idprod);
    array_push($_SESSION['accomp']['accomp_name'],$designation);
    array_push($_SESSION['accomp']['qte_accomp'],$quantite);
    array_push($_SESSION['accomp']['unite_accomp'],$unite);
}
//recuperation les accompagnement




$requete = $bdd->prepare("SELECT prod.idprod FROM stk_produit AS prod,stk_sous_famille AS s_fam WHERE  prod.famille_id=s_fam.id_s_fam  AND s_fam.id_s_fam IN()");
$requete->execute();
$prod= $requete->fetch(PDO::FETCH_OBJ);
foreach ($prod as $p){
    $idprod=$p->idprod;
    $accomp_id=$_SESSION['accomp']['accomp_id'][$i];
    $accomp_name=$_SESSION['accomp']['accomp_name'][$i];
    $qte_accomp=1;
    $unite_accomp=$_SESSION['accomp']['unite_accomp'][$i];
    $plat_id=$idprod;
    $id_hotel=356;
    $requete = $bdd->prepare("INSERT INTO  t_accompagnement (produit_id,designation,unite,quantite,plat_id,hotel_id)
                             VALUES(:produit_id,:designation,:unite,:quantite,:plat_id,:hotel_id)");
    $requete->BindParam(':produit_id',$accomp_id);
    $requete->BindParam(':designation',$accomp_name);
    $requete->BindParam(':unite',$unite_accomp);
    $requete->BindParam(':quantite',$qte_accomp);
    $requete->BindParam(':plat_id',$plat_id);
    $requete->BindParam(':hotel_id',$id_hotel);
    $requete->execute();




   }
