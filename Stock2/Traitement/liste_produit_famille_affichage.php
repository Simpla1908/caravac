<?php

// Initialisation de la session
if (!isset($_SESSION)) {
            session_start();
     }
include('../bdd/connexion.php');
//$type='fournisseur';
if(isset($_GET['famille'])){
    $famille=$_GET['famille'];
    
    $requete = $bdd->prepare("SELECT idfamille FROM stk_famille WHERE designation=:designation AND hotel_id=:hotel_id ");
    $requete->BindParam(':designation', $famille);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $familles = $requete-> fetchAll(PDO::FETCH_OBJ);
    
    foreach ($familles as $f) {
        $famille_id = $f->idfamille;
    }
    
    $requete = $bdd->prepare("SELECT * FROM stk_produit AS prod,stk_sous_famille AS sfam,stk_famille AS fam  
                        WHERE sfam.famille=fam.idfamille
                        AND prod.famille_id=sfam.id_s_fam AND fam.idfamille=:famille_id AND prod.hotel_id=:hotel_id ORDER BY prod.designation");
    $requete->BindParam(':famille_id', $famille_id);
    $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
    $requete->execute();
    $produit_famille = $requete->fetchAll(PDO::FETCH_OBJ);
}


