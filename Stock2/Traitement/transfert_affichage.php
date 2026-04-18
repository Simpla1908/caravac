<?php
// Initialisation de la session
   if (!isset($_SESSION)) {
    session_start();
   }
    include('../bdd/connexion.php');

    $requete = $bdd->prepare("SELECT  * FROM stk_produit AS prod, stk__mouvement AS m WHERE prod.idprod=m.produit_id AND m.type='sortie' AND m.hotel_id=:hotel_id ORDER BY prod.designation ");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $mouvements = $requete->fetchAll(PDO::FETCH_OBJ);
    
    $requete = $bdd->prepare("SELECT a.id_depot,a.libelle,COUNT(b.produit_id) AS nbre_prod,b.dte_appro_heure,b.depot_id
    FROM t_depot AS a, stk__mouvement AS b,stk_produit AS p
    WHERE a.id_depot=b.depot_id AND p.idprod=b.produit_id 
    AND b.type='appro' AND p.repas=0 AND b.hotel_id=:hotel_id 
    GROUP BY b.depot_id
    ORDER BY a.libelle");
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $mouvements_depots = $requete->fetchAll(PDO::FETCH_OBJ);

