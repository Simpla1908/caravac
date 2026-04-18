<?php
include('../Amelioration/bdd/connexion .php');
include('../../lib/password_compat-master/lib/password.php');
$json = array();
$json['message'] = 'succes';
$pwd =$_POST['old'];
$user =$_POST['id_user'];

$hash = '';
if (empty($pwd)){
$json['message'] = 'champvide';
}else{
$requete = $bdd->prepare("SELECT u.mdp_user FROM t_utilisateur AS u WHERE u.id_user=:user");
$requete->BindParam(':user', $user);
$requete->execute();
$usepwd = $requete->fetchAll(PDO::FETCH_OBJ);
    foreach ($usepwd as $usepwd) $hash = $usepwd->mdp_user;
if (password_verify($pwd,$hash)) {
$json['message'] = 'succes';
}else{
$json['message'] = 'noidem';
}

}
echo json_encode($json);
