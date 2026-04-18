<?php

if (!isset($_SESSION)) {
    session_start();
}
include('../bdd/connexion.php');
$req="SELECT prod.code,m.produit_id,prod.designation,prod.pa,prod.pv,qte_initial + SUM(qte_entree) AS entree,SUM(qte_sortie) AS sortie 
	FROM  stk_produit AS prod,stk_sous_famille AS sfam,stk__mouvement AS m  
                        WHERE prod.idprod=m.produit_id   
                        AND prod.famille_id=sfam.id_s_fam
			AND m.dte_appro BETWEEN '2016-12-14' AND '2016-12-30'
			AND prod.famille_id=30
			GROUP BY m.produit_id ";
$requete = $bdd->prepare("SELECT sfam.famille,prod.famille_id,sfam.des,m.produit_id,prod.designation,dte_appro,qte_initial AS initial, SUM(qte_entree) AS entree,SUM(qte_sortie) AS sortie
                        FROM  stk_produit AS prod,stk_sous_famille AS sfam,stk_famille AS fam,stk__mouvement AS m  
                        WHERE prod.idprod=m.produit_id   
                        AND sfam.famille=fam.idfamille
                        AND prod.famille_id=sfam.id_s_fam
                        AND m.hotel_id=:hotel_id 
                        AND dte_appro=:date_rapport 
                        GROUP BY m.produit_id 
                        HAVING sfam.famille=:famille_id ORDER BY prod.designation");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':date_rapport', $date_bon);
$requete->BindParam(':famille_id', $famille_id);
$requete->execute();
$articles = $requete->fetchAll(PDO::FETCH_OBJ);



