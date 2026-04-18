<?php

// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
$requete = $bdd->prepare("SELECT res.id_res,res.id_client,res.etat,res.num_reserv,res.etat,res.date_res,cl.designation AS client_designation ,cl.nom_client,fac.remise,fac.montant_total,fac.mont_tva,fac.mont_ttc,fac.mont_ttc_remise,fac.num_fact,fac.id_fact,CONCAT(u.prenom_user,' ',u.nom_user) AS user,lig.prix,lig.qte,prod.designation,cl.id_client FROM  t_reservation AS res,t_client AS cl,lignes_commandes AS lig,t_facture AS fac,t_reglement AS reg, t_utilisateur AS u,stk_produit AS prod WHERE res.id_client=cl.id_client AND res.id_res=lig.commande_id AND res.id_res=fac.id_res AND fac.id_fact=reg.id_fact AND reg.id_user=u.id_user AND prod.idprod=lig.produit_id AND res.id_hotel=:hotel_id  GROUP BY res.num_reserv");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->execute();
$commandes = $requete->fetchAll(PDO::FETCH_OBJ);

$requete = $bdd->prepare("SELECT res.id_res,res.id_client,res.etat,res.num_reserv,res.etat,res.date_res,cl.designation AS client_designation ,cl.nom_client,fac.remise,fac.montant_total,fac.mont_tva,fac.mont_ttc,fac.mont_ttc_remise,fac.num_fact,fac.id_fact,CONCAT(u.prenom_user,' ',u.nom_user) AS user,lig.prix,lig.qte,prod.designation,res.tva,res.remise FROM  t_reservation AS res,t_client AS cl,lignes_commandes AS lig,t_facture AS fac,t_reglement AS reg, t_utilisateur AS u,stk_produit AS prod WHERE res.id_client=cl.id_client AND res.id_res=lig.commande_id AND res.id_res=fac.id_res AND fac.id_fact=reg.id_fact AND reg.id_user=u.id_user AND prod.idprod=lig.produit_id AND res.id_hotel=:hotel_id AND res.num_reserv=:num_reserv GROUP BY prod.idprod");
$requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
$requete->BindParam(':num_reserv', $num_reserv);
$requete->execute();
$commandes1 = $requete->fetchAll(PDO::FETCH_OBJ);


