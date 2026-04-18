<?php
// On démarre la session 
session_start (); 

// Inclusion du fichier contenant la connexion à la base
require '../bdd/connexion.php';

date_default_timezone_set('Europe/Paris');
$date_decon=  date('Y-m-d H:i:s');

$requete = $bdd->prepare("INSERT INTO connexion (date_con,date_decon,id_user)
			                 VALUES(:date_con,:date_decon,:id_user)");

$requete->BindParam(':date_con', $_SESSION['date_con']);
$requete->BindParam(':date_decon',$date_decon);
$requete->BindParam(':id_user',$_SESSION['id_user']);
$requete->execute();


//mise a jours du champs connect
$requete=$bdd->prepare("UPDATE t_utilisateur SET connect=0 WHERE id_user=:id_user");
$requete->BindParam(':id_user', $_SESSION['id_user']);
$requete->execute();

//$requete = $bdd->prepare("UPDATE connexion SET date_decon=:date_decon WHERE id_user=:id_user");
//
//$requete->BindParam(':date_decon',$date_decon);
//$requete->BindParam(':id_user',$_SESSION['id_user']);
//$requete->execute();
        
// On détruit les variables de notre session 
session_unset (); 
// On détruit notre session 
session_destroy (); 
// On redirige le visiteur vers la page d'accueil 
header('Location: ../login.php');
?>
