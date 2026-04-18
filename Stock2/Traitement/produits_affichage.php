<?php

// Initialisation de la session
if (!isset($_SESSION)) {
            session_start();
     }

//include('../bdd/connexion.php');

$requete = $bdd->prepare("SELECT prod.idprod,prod.code,prod.designation AS produit,prod.pa,prod.pv,prod.qte_initial,prod.qte_min,prod.unite,prod.monnaie,s_fam.des,fam.designation FROM stk_produit AS prod,stk_sous_famille AS s_fam ,stk_famille AS fam WHERE  prod.famille_id=s_fam.id_s_fam AND prod.hotel_id=:hotel_id AND s_fam.famille=fam.idfamille AND prod.pseudo_supp=0 AND fam.plat=0 ORDER BY prod.designation ");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
$produits = $requete->fetchAll(PDO::FETCH_OBJ);

