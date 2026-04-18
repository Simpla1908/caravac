<?php
function quantite_ki_reste($idprod) {
// Initialisation de la session
//session_start();
 include('bdd/connexion.php');
$requete = $bdd->prepare("SELECT (prod.qte_initial+SUM(m.qte_entree))-SUM(m.qte_sortie) AS qte_tot_prod
FROM stk_produit AS prod, stk__mouvement AS m 
WHERE  prod.idprod=m.produit_id
AND prod.idprod=:idprod AND prod.hotel_id=:hotel_id");
$requete->BindParam(':idprod', $idprod);
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
$articles = $requete->fetchAll(PDO::FETCH_OBJ);
 foreach ($articles  as $a) {
    $qte_tot_prod= $a->qte_tot_prod;
 }
 return $qte_tot_prod;
}
