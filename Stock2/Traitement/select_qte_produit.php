<?php

// Initialisation de la session
include('../bdd/connexion.php');
session_start();
$produit_id= $_POST['produit_id'];

$requete = $bdd->prepare("SELECT (SUM(m.qte_entree))-SUM(m.qte_sortie) AS qte_dispo
    FROM stk_produit AS prod, stk__mouvement AS m 
    WHERE  prod.idprod=m.produit_id AND m.appro_depot=0 AND prod.pseudo_supp=0
    AND prod.idprod=:idprod AND prod.hotel_id=:hotel_id GROUP BY m.produit_id");
    $requete->BindParam(':idprod', $produit_id);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();

$quantite_dispo = $requete-> fetchAll(PDO::FETCH_OBJ);
foreach ($quantite_dispo  as $q):
echo $q->qte_dispo;
endforeach;