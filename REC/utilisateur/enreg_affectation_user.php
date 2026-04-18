<?php 
 
if (!isset($_SESSION)) {
    session_start();
}

include('../Amelioration/bdd/connexion .php');
$json = array();
$json['message'] = "";
if (empty($_POST['hotel_id'])||empty($_POST['module'])) {
 $json['message'] = 'champvide';  
}elseif (empty ($_POST['groupe'])) {
    $json['message'] = 'groupevide';  
}
else {
     // Inssertion 
    $user = $_POST['module'];
//A remplacer par l'id user de la session
    $user_id = $_SESSION['id_user'];
    $hotel_id = $_POST['hotel_id'];
    $dte=date('Y-m-d',  time()+3600);
     foreach ($_POST['groupe'] as $key => $value) {
    $requete = $bdd->prepare("INSERT INTO users_groupes(user_id,group_id,affecteur_id,dte,hotel_id)
			         VALUES(:user_id,:group_id,:affecteur_id,:dte,:hotel_id)");

    $requete->BindParam(':user_id',$user);
    $requete->BindParam(':group_id',$key);
    $requete->BindParam(':affecteur_id', $user_id);
    $requete->BindParam(':dte', $dte);
    $requete->BindParam(':hotel_id', $hotel_id);
    $requete->execute();
    }
    $json['message'] = 'succes';
    
}
echo json_encode($json);