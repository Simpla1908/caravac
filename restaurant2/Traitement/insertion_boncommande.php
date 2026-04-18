<?php
if ($_SESSION['panier']['repas'][$i] == 1) {
            $requete = $bdd->prepare("INSERT INTO bon_commandes (commande_id,produit_id,nameprod,user_id,hotel_id,dte,dte_h,quantite)
							       VALUES(:commande_id,:produit_id,:nameprod,:user_id,:hotel_id,:dte,:dte_h,:quantite)");

            $requete->BindParam(':commande_id',$commande_id);
            $requete->BindParam(':produit_id', $_SESSION['panier']['id_article'][$i]);
            $requete->BindParam(':nameprod', $_SESSION['panier']['nom'][$i]);
            $requete->BindParam(':user_id', $_SESSION['id_user']);
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->BindParam(':dte', $date_com);
            $requete->BindParam(':dte_h', $date_h_com);
            $requete->BindParam(':quantite',$_SESSION['panier']['qte'][$i]);
            $requete->execute();

}

