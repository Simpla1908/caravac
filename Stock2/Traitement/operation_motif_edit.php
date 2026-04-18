<?php
//session_start();
function getoperation_motif($idmvt,$bdd) {
   $requete = $bdd->prepare("SELECT * FROM stk__mouvement AS op, stk_produit AS p WHERE op.produit_id=p.idprod AND op.hotel_id=:hotel_id AND op.idmvt=:idmvt");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':idmvt',$idmvt);
$requete->execute();
$operation_motifs = $requete->fetchAll(PDO::FETCH_OBJ);
return $operation_motifs;
}


