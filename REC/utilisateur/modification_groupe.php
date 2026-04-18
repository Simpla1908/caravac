<?php

session_start();
include('../Amelioration/bdd/connexion .php');
$json = array();
$json['message'] = "";
$N = count($_POST["action"]);
if (empty($_POST['hotel_id']) || empty($_POST['module']) || empty($_POST['nom'])) {
    $json['message'] = 'champvide';
} elseif (count($_POST['action'])==1) {
    $json['message'] = 'droitvide';
} else {

    // Inssertion 
    $group_id = $_POST['idgroupe'];
    $module_id = $_POST['module'];
    $libelle = $_POST['nom'];

    $user_id = $_SESSION['id_user'];
    $hotel_id = $_POST['hotel_id'];
//maj  nom & suppression groupe
    $requete = $bdd->prepare("UPDATE groupe SET libelle =:libelle,module_id=:module_id,user_id=:user_id,hotel_id=:hotel_id WHERE id=:id");
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':module_id', $module_id);
    $requete->BindParam(':user_id', $user_id);
    $requete->BindParam(':hotel_id', $hotel_id);
    $requete->BindParam(':id', $group_id);
    $requete->execute();
    $requete = $bdd->prepare("DELETE FROM  actions_groupe WHERE group_id=:id");
    $requete->BindParam(':id', $group_id);
    $requete->execute();

    for ($i = 0; $i < $N; $i++) {
        $id_action = $_POST["action"][$i];
//_requete
        $requete = $bdd->prepare("INSERT INTO actions_groupe(group_id,action_id)
			         VALUES(:group_id,:action_id)");

        $requete->BindParam(':group_id', $group_id);
        $requete->BindParam(':action_id', $id_action);
        $requete->execute();
    }
    $json['message'] = 'succes';
}
echo json_encode($json);
