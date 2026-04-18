<?php
session_start();
include('../Amelioration/bdd/connexion .php');

$json = array();
$json['message'] = "";
$droits = '';

if (empty($_POST['hotel_id']) || empty($_POST['module']) || empty($_POST['nom'])) {
    $json['message'] = 'champvide';
} elseif (empty($_POST['action'])) {
    $json['message'] = 'droitvide';
} else {
//    $droits |=$voir_module;
    // Inssertion 
    $module_id = $_POST['module'];
    $libelle = $_POST['nom'];
    $action_module_id = $_POST['action_module_id'];
    $requete = $bdd->prepare("SELECT a.id_act FROM actions AS a WHERE a.module_id=:module_id AND code_act IN('VMC','VMH','VMR','VMS','VMCR','VRH','VMFACT')");
    $requete->BindParam(':module_id',$module_id);
    $requete->execute();
    $operations = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($operations as $op) {
        $voir_module = $op->id_act;
    }
    
   //A remplacer par l'id user de la session
    $user_id = $_SESSION['id_user'];
    $hotel_id = $_POST['hotel_id'];

    $requete = $bdd->prepare("INSERT INTO groupe(libelle,module_id,user_id,hotel_id)
			         VALUES(:libelle,:module_id,:user_id,:hotel_id)");
    $requete->BindParam(':libelle', $libelle);
    $requete->BindParam(':module_id', $module_id);
    $requete->BindParam(':user_id', $user_id);
    $requete->BindParam(':hotel_id', $hotel_id);
    $requete->execute();
    $group_id = $bdd->lastInsertId();
    
    // requete insertion action par defaut
    $requete = $bdd->prepare("INSERT INTO actions_groupe(group_id,action_id)
			         VALUES(:group_id,:action_id)");
    $requete->BindParam(':group_id', $group_id);
    $requete->BindParam(':action_id', $voir_module);
    $requete->execute();
    // FIN requete insertion action par defaut
    
    $N = count($_POST["action"]);
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
