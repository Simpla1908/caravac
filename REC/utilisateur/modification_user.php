<?php

include('../Amelioration/bdd/connexion .php');
include('../../lib/password_compat-master/lib/password.php');
//initialisation tableau des id
$tableau_id['user']= array();
$tableau_id['user']['id'] = array();
//chargement de tous les id
$exlogin = $_POST['exlogin'];
$requete = $bdd->prepare("SELECT u.email_user FROM t_utilisateur AS u WHERE u.email_user<>:exlogin");
$requete->BindParam(':exlogin', $exlogin);
$requete->execute();
$user_id = $requete->fetchAll(PDO::FETCH_OBJ);
foreach ($user_id as $user_id) {
    $user_id = $user_id->email_user;
    if (!in_array($user_id, $tableau_id['user']['id'])) {
        array_push($tableau_id['user']['id'], $user_id);
    }

}
//fin chargement
$json = array();
$json['message'] = "";

$type = explode('.', $_FILES['image']['name']);
$type = $type[count($type) - 1];
$url = 'images/'.uniqid(rand()).'.'.$type;
if(in_array($type, array('gif', 'jpg', 'jpeg', 'png'))){
    if(is_uploaded_file($_FILES['image']['tmp_name'])){
        if(move_uploaded_file($_FILES['image']['tmp_name'], $url)){
     if (empty($_POST['id_user'])||empty($_POST['hotel_id'])||empty($_POST['name'])||empty($_POST['sexe'])||empty($_POST['login'])||empty($_POST['type_user'])) {
    $json['message'] = 'champvide';
    }else{
    $user_id = $_POST['id_user'];
    $hotel_id = $_POST['hotel_id'];
    $name = $_POST['name'];
    $sexe = $_POST['sexe'];
    $login = $_POST['login'];
    $type_user = trim($_POST['type_user']);
    $module_dflt = trim($_POST['module_dflt']);
    $module_name = trim($_POST['module_name']);
    $pos_id= $_POST['pos_id'];
    if (!empty($_POST['etat'])){
        $etat = 1;
    } else {
        $etat = 0;
    }
    //verification compte unique
    if (!in_array($login, $tableau_id['user']['id'])) {
        // Inssertion
        $requete = $bdd->prepare("UPDATE t_utilisateur SET nom_user=:nom_user, sexe_user=:sexe_user, email_user=:email_user, actif=:actif, id_hotel=:id_hotel, module_dflt=:module_dflt, module_name=:module_name, pos_id=:pos_id, type=:type_user, path_image=:path_image WHERE id_user=:id_user");

        $requete->BindParam(':nom_user', $name);
        $requete->BindParam(':sexe_user', $sexe);
        $requete->BindParam(':email_user',$login);
        $requete->BindParam(':actif',$etat);
        $requete->BindParam(':id_hotel',$hotel_id);
        $requete->BindParam(':id_user',$user_id);
        $requete->BindParam(':module_dflt',$module_dflt);
        $requete->BindParam(':module_name',$module_name);
        $requete->BindParam(':pos_id',$pos_id);
        $requete->BindParam(':type_user',$type_user);
        $requete->BindParam(':path_image',$url);
        $requete->execute();
        $json['message'] = 'succes';
    } else {
        $json['message'] = 'idexist';
    }
}


        }

    }

}else{

 
if (empty($_POST['id_user'])||empty($_POST['hotel_id'])||empty($_POST['name'])||empty($_POST['sexe'])||empty($_POST['login'])||empty($_POST['type_user'])) {
    $json['message'] = 'champvide';
    }else{
    $user_id = $_POST['id_user'];
    $hotel_id = $_POST['hotel_id'];
    $name = $_POST['name'];
    $sexe = $_POST['sexe'];
    $login = $_POST['login'];
    $type_user = trim($_POST['type_user']);
    $module_dflt = trim($_POST['module_dflt']);
    $module_name = trim($_POST['module_name']);
    $pos_id= $_POST['pos_id'];
    if (!empty($_POST['etat'])){
        $etat = 1;
    } else {
        $etat = 0;
    }
    //verification compte unique
    if (!in_array($login, $tableau_id['user']['id'])) {
        // Inssertion
        $url="";
        $requete = $bdd->prepare("UPDATE t_utilisateur SET nom_user=:nom_user, sexe_user=:sexe_user, email_user=:email_user, actif=:actif, id_hotel=:id_hotel, module_dflt=:module_dflt, module_name=:module_name, pos_id=:pos_id, type=:type_user WHERE id_user=:id_user");

        $requete->BindParam(':nom_user', $name);
        $requete->BindParam(':sexe_user', $sexe);
        $requete->BindParam(':email_user',$login);
        $requete->BindParam(':actif',$etat);
        $requete->BindParam(':id_hotel',$hotel_id);
        $requete->BindParam(':id_user',$user_id);
        $requete->BindParam(':module_dflt',$module_dflt);
        $requete->BindParam(':module_name',$module_name);
        $requete->BindParam(':pos_id',$pos_id);
        $requete->BindParam(':type_user',$type_user);
        $requete->execute();
        $json['message'] = 'succes';
    } else {
        $json['message'] = 'idexist';
    }
}




}

$json['message'] = 'succes';
echo json_encode($json);
