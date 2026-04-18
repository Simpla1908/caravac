<?php
// Initialisation de la session
   
if (!isset($_SESSION)) {
    session_start();
}
    include('../bdd/connexion.php');

    $requete = $bdd->prepare("SELECT  * FROM stk_produit AS prod, stk__mouvement AS m WHERE prod.idprod=m.produit_id AND m.type='appro' AND m.qte_entree!=0 AND m.appro_depot=0 AND m.hotel_id=:hotel_id ORDER BY m.produit_id DESC");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $mouvements = $requete->fetchAll(PDO::FETCH_OBJ);

