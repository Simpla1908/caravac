<?php

// Initialisation de la session
if (!isset($_SESSION)) {
            session_start();
     }
include('../bdd/connexion.php');
//$type='fournisseur';

$requete = $bdd->prepare("SELECT f.designation,COUNT(p.idprod) AS produit FROM stk_famille AS f,stk_sous_famille AS sf,stk_produit AS p WHERE f.idfamille=sf.famille AND sf.id_s_fam=p.famille_id AND f.hotel_id=:hotel_id GROUP BY f.designation ORDER BY f.idfamille");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
$famille_produit = $requete-> fetchAll(PDO::FETCH_OBJ);
