<?php
// Initialisation de la session
    
if (!isset($_SESSION)) {
    session_start();
}
    $depot_id = $_SESSION['depot_id'];
//    $requete = $bdd->prepare("SELECT fam.idfamille,fam.designation,fam.plat,fam.affichage,fam.hotel_id
//            FROM stk_famille AS fam, stk_sous_famille AS s, stk_produit AS p, t_prix_produit AS m
//            WHERE fam.idfamille=s.famille AND s.id_s_fam=p.famille_id AND p.idprod=m.produit_id 
//            AND m.sousresto_id=:sousresto_id AND fam.affichage=1 ORDER BY fam.designation ASC");
//    $requete->BindParam(':sousresto_id',$_SESSION['id_sousresto']);
//    $requete->execute();
//    $familles = $requete->fetchAll(PDO::FETCH_OBJ);
//    foreach ($familles as $f) {
//        if (!in_array($f->idfamille,$_SESSION['fam']['id'])){
//            array_push($_SESSION['fam']['id'], $f->idfamille);
//           $_SESSION['fam']['id_fam'][$f->idfamille]= $f->idfamille;
//           $_SESSION['fam']['des_fam'][$f->idfamille]= $f->designation;
//        } 
//    }
//    $nbFamille = count($_SESSION['fam']['id']);
//    $_SESSION['nbFamille']=$nbFamille;
    
    $requete = $bdd->prepare("SELECT s.id_s_fam,s.des,s.famille,s.hotel_id
          FROM stk_sous_famille AS s,stk_famille AS fam
            WHERE fam.idfamille=s.famille AND fam.affichage=1 
            AND s.hotel_id=:hotel_id
            AND s.pseudo_supp=0
             ORDER BY s.classer,s.des ASC");
    $requete->BindParam(':hotel_id',$_SESSION['id_hotel']);
    $requete->execute();
    $s_familles = $requete->fetchAll(PDO::FETCH_OBJ);	  
    $_SESSION['s_familles']=$s_familles;
    foreach ($s_familles as $sf){
        if (!in_array($sf->id_s_fam,$_SESSION['sfam']['id'])) {
            array_push($_SESSION['sfam']['id'], $sf->id_s_fam);
           $_SESSION['sfam']['id_fam'][$sf->id_s_fam]= $sf->famille;
           $_SESSION['sfam']['des_sfam'][$sf->id_s_fam]= $sf->des;
        } 
    }
    $nb_sFamille = count($_SESSION['sfam']['id']);
    $_SESSION['nb_sFamille']=$nb_sFamille;
    
//    $requete = $bdd->prepare("SELECT prod.idprod,prod.designation,prod.qte_min,prod.pv AS prix,prod.repas,fam.idfamille AS famille_id,p.monnaie,
//        fam.plat,p.id_prix,p.prix_vente AS pv,prod.monnaie AS monprod,prod.pa,prod.path_image
//            FROM stk_famille AS fam, stk_sous_famille AS s, stk_produit AS prod, t_prix_produit AS p
//            WHERE fam.idfamille=s.famille AND s.id_s_fam=prod.famille_id  AND prod.idprod=p.produit_id 
//                 AND p.sousresto_id=:sousresto_id AND prod.pseudo_supp=0 AND fam.affichage=1 ORDER BY prod.designation ASC");
//    $requete->BindParam(':sousresto_id',$_SESSION['id_sousresto']);
//    $requete->execute();
//    $produits = $requete->fetchAll(PDO::FETCH_OBJ);
//    $_SESSION['produits']=$produits;

$requete = $bdd->prepare("
	SELECT * FROM stk_familletype AS f WHERE f.priority!=0 ORDER BY f.priority");
    $requete->execute();
    $servicesFamilles = $requete->fetchAll(PDO::FETCH_OBJ);	
