<?php

// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
include('../Amelioration/bdd/connexion .php');
$json = array();
if (!empty($_POST['hotel'])) {
//    $hotel_id = $_POST['hotel']; 
    $hotel_id = $_SESSION['company_id'];
} else {
//    $hotel_id = 0;
    $hotel_id = $_SESSION['company_id'];
}

$requete = $bdd->prepare("SELECT * FROM  t_utilisateur WHERE type !=1 AND company_id=:hotel_id ORDER BY nom_user ASC");
$requete->BindParam(':hotel_id', $hotel_id);
$requete->execute();
// résultats
while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
    // je remplis un tableau et mettant l'id en index (que ce soit pour les régions ou les départements)
    $json[$donnees['id_user']][] = utf8_encode($donnees['nom_user']);
}
// envoi du résultat au success
echo json_encode($json);
?>
