<?php

// Initialisation de la session
session_start();
include('../../../bdd/connexion.php');
if (isset($_POST['choix'])) {
    
    $choix=$_POST['choix'];
    $val1=0;
    $requete = $bdd->prepare("UPDATE ` monnaie` SET choix =:choix ");
    $requete->BindParam(':choix',$val1);
    $requete->execute();
    
    $val2=1;
    $requete = $bdd->prepare("UPDATE ` monnaie` SET choix =:choix WHERE id_monnaie=:id_monnaie");
    $requete->BindParam(':choix',$val2);
    $requete->BindParam(':id_monnaie',$choix);
    $requete->execute();
} 

