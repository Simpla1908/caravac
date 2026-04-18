<?php

include('../Amelioration/bdd/connexion .php');
include('../../lib/password_compat-master/lib/password.php');
$json = array();
$json['message'] = "";
$user_id = $_POST['id_user'];
$password1 = $_POST['new'];
$password2 = $_POST['confirm'];
if (empty($password1)||empty($password2)){

    $json['message'] = 'champvide';
} else {
    if ($password1 == $password2) {
        // Inssertion
        $requete = $bdd->prepare("UPDATE t_utilisateur SET  mdp_user=:mdp_user WHERE id_user=:id_user");
        $pwdhash=password_hash($password1,PASSWORD_DEFAULT);
        $requete->BindParam(':mdp_user', $pwdhash);
        $requete->BindParam(':id_user',$user_id);
        $requete->execute();
        $json['message'] = 'succes';
    } else {
        $json['message'] = 'noidem';
    }

}



echo json_encode($json);
