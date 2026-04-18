<?php
//session_start();
function getapprov_motif($idmvt,$bdd) {
$requete = $bdd->prepare("SELECT DISTINCT mvt.idmvt,mvt.type,mvt.produit_id,pro.designation,mvt.num_bon,mvt.qte_entree,mvt.qte_sortie,mvt.dte_appro_heure,mvt.depot FROM stk__mouvement AS mvt,stk_produit AS pro,t_utilisateur As user WHERE mvt.produit_id=pro.idprod AND mvt.hotel_id=:hotel_id AND mvt.idmvt=:idmvt");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':idmvt',$idmvt);
$requete->execute();
$approv_motifs = $requete->fetchAll(PDO::FETCH_OBJ);
return $approv_motifs;
}
//

