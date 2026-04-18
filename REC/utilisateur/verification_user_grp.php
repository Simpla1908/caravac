<?php

// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
include('../Amelioration/bdd/connexion .php');
$json = array();

$json['groupe'] ='vide';

    $id_user= $_POST['id_user'];
    $id_grp= $_POST['id_grp'];

$requete = $bdd->prepare("SELECT * FROM users_groupes AS ug, groupe AS g WHERE ug.group_id=g.id AND ug.user_id=:user_id AND ug.group_id=:group_id");
$requete->BindParam(':user_id', $id_user);
$requete->BindParam(':group_id', $id_grp);
$requete->execute();
$verif=$requete->fetch();

if($verif['group_id']!=''){
    $json['groupe'] = $verif['libelle'];
}
//echo $id_grp;
// résultats
//while ($donnees = $requete->fetch(PDO::FETCH_ASSOC)) {
//    // je remplis un tableau et mettant l'id en index (que ce soit pour les régions ou les départements)
//    $json[$donnees['id']][] = utf8_encode($donnees['nom']);
//}
//// envoi du résultat au success
echo json_encode($json);
?>
