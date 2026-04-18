<?php

    include('bdd/connexion.php');

	
    $requete = $bdd->prepare("SELECT prod.idprod,prod.designation,prod.qte_min,prod.pv,prod.repas,prod.famille_id,fam.designation AS des_fam "
            . "FROM  stk_produit AS prod,stk_sous_famille AS s_fam,stk_famille AS fam  "
            . "WHERE prod.famille_id=s_fam.id_s_fam AND s_fam.famille=fam.idfamille AND prod.hotel_id=:hotel_id AND fam.affichage=1 AND fam.plat=0 ORDER BY prod.idprod ASC");
    $requete->BindParam(':hotel_id',$_SESSION['id_hotel']);
    $requete->execute();
    $produits = $requete->fetchAll(PDO::FETCH_OBJ);
