<?php
function getproduit_motif($idprod,$bdd) {
$requete = $bdd->prepare("SELECT prod.path_image,prod.code,prod.idprod,prod.designation AS produit,prod.pa,prod.pv,prod.statut,prod.qte_initial,prod.qte_min,prod.repas,prod.unite,s_fam.id_s_fam,s_fam.des,fam.idfamille,fam.designation,fam.affichage,fam.plat FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam WHERE  prod.famille_id=s_fam.id_s_fam  AND prod.idprod=:idprod AND  prod.hotel_id=:hotel_id AND s_fam.famille=fam.idfamille ORDER BY prod.idprod DESC");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':idprod',$idprod);
$requete->execute();
$produit_motifs = $requete->fetchAll(PDO::FETCH_OBJ);
return $produit_motifs;
}


