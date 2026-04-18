<?php

// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
include('../Amelioration/bdd/connexion .php');
$json = array();
if (!empty($_POST['hotel'])) {
    $hotel_id = $_POST['hotel'];
} else {
    $hotel_id = 0;
}

$requete = $bdd->prepare("SELECT m.id,m.nom FROM module AS m,t_modulecompany AS mc  WHERE mc.module_id=m.id AND mc.etat_module=1  AND mc.site_id=:site_id");
$requete->BindParam(':site_id',$hotel_id);

$requete->execute();
// résultats
while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
    // je remplis un tableau et mettant l'id en index (que ce soit pour les régions ou les départements)
    $json[$donnees['id']][] = utf8_encode($donnees['nom']);
}
// envoi du résultat au success
echo json_encode($json);
?>
