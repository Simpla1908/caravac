<?php
ini_set('session.bug_compat_warn', 0);
ini_set('session.bug_compat_42', 0);
session_start();
include '../bdd/connexion.php';
include './Panier.php';
//include '../../REC/Amelioration/reglage/recuperer_valeurs_reglages.php';
include '../../FUNCTION/hebergement.php';
include '../../FUNCTION/restaurant.php';

    $date_bd1='2020-08-01';
    $date_bd2='2020-08-31';
    $requete = $bdd->prepare("SELECT f.id_fact,f.taux_prix,f.mont_ttc_remise
     FROM  t_facture AS f 
	 WHERE  f.mode IS NOT NULL AND f.date_edition
       BETWEEN :date_bd1 AND :date_bd2");
    $requete->BindParam(':date_bd1', $date_bd1);
    $requete->BindParam(':date_bd2', $date_bd2);
    $requete->execute();
    $factures = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($factures as $ra) {
        $id_fact = $ra->id_fact;
        $remise_fact = $ra->mont_ttc_remise;
        $tauxdollar = $ra->taux_prix;
    
        $requete = $bdd->prepare("SELECT  p.idprod,p.pa,l.prix,l.prixremise,l.id FROM  lignes_commandes AS l,stk_produit As p 
        WHERE l.produit_id=p.idprod
         AND l.commande_id=:cmd_id");
        $requete->BindParam(':cmd_id', $id_fact);
        $requete->execute();
        $lignes = $requete->fetchAll(PDO::FETCH_OBJ);
        foreach ($lignes as $r) {
            $id= $r->id;
            $pa = $r->pa;
            $prix = $r->prix;
            $prixremise=$prix-$prix*$remise_fact/100;
            $requete = $bdd->prepare("UPDATE lignes_commandes SET pa=:pa, prixremise=:prixremise WHERE id=:id");
            $requete->BindParam(':pa',$pa);
            $requete->BindParam(':prixremise',$prixremise);
            $requete->BindParam(':id',$id);

            $requete->execute();
        
        }
        
    }

?>
