<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
include('../Amelioration/bdd/connexion .php');
include('../../lib/password_compat-master/lib/password.php');
include '../../FUNCTION/hebergement.php';
//initialisation tableau des id
$tableau_id['user']= array();
$tableau_id['user']['id'] = array();
//chargement de tous les id
$requete = $bdd->prepare("SELECT u.email_user FROM t_utilisateur AS u");
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
$json['user'] = "";
$vide=0;
if (!empty($_POST)) {
    foreach ($_POST as $cle => $val) {
        if (empty($val)) {
            $vide=1;
        }
    }
if($vide==1){
            $json['message'] = 'champvide';
}else if($vide==0){
    $hotel_id = trim($_POST['hotel_id']);
    $name = trim($_POST['name']);
    $sexe =trim( $_POST['sexe']);
    $login = trim($_POST['login']);
    $password1 = trim($_POST['password1']);
    $password2 = trim($_POST['password2']);
    $module_dflt = trim($_POST['module_dflt']);
    $module_name = trim($_POST['module_name']);
    $pos_id =trim($_POST['pos_id']);
    $type_user=trim($_POST['type_user']);
    $etat = 1;
    $type = explode('.', $_FILES['image']['name']);
    $type = $type[count($type) - 1];
    $url = 'images/'.uniqid(rand()).'.'.$type;
    //Besoin de la cause
    $id_droit = 1;
    //verification compte unique

    if (!in_array($login, $tableau_id['user']['id'])) {
    if ($password1 == $password2) {
        
        // recuperation nombre user site
        //$nbre_user_bdd = getNbreUser_bdd($_SESSION['id_hotel'], $bdd);
        $nbre_user_bdd=1;
        if($nbre_user_bdd==0){
            $json['message'] = 'overflow';
        }else{
        
        $nbre_user_update = $nbre_user_bdd - 1;
    
        $requete = $bdd->prepare("UPDATE t_hotel SET nbre_user=:nbre_user WHERE id_hotel=:id_hotel");
        $requete->BindParam(':nbre_user', $nbre_user_update);
        $requete->BindParam(':id_hotel', $_SESSION['id_hotel']);
            if(in_array($type, array('gif', 'jpg', 'jpeg', 'png'))){
       if(is_uploaded_file($_FILES['image']['tmp_name'])){
        if(move_uploaded_file($_FILES['image']['tmp_name'], $url)){

           // Insertion
    $requete = $bdd->prepare("INSERT INTO t_utilisateur (nom_user,sexe_user,email_user,mdp_user,actif,id_droit,id_hotel,company_id,module_dflt,module_name,pos_id,type,path_image)
                     VALUES(:nom_user,:sexe_user,:email_user,:mdp_user,:actif,:id_droit,:id_hotel,:company_id,:module_dflt,:module_name,:pos_id,:type,:path_image)");
    $pwdhash=password_hash($password1,PASSWORD_DEFAULT);
    $requete->BindParam(':nom_user', $name);
    $requete->BindParam(':sexe_user', $sexe);
    $requete->BindParam(':email_user',$login);
    $requete->BindParam(':mdp_user',$pwdhash);
    $requete->BindParam(':actif',$etat);
    $requete->BindParam(':id_droit',$id_droit);
    $requete->BindParam(':id_hotel',$hotel_id);
    $requete->BindParam(':company_id',$_SESSION['company_id']);
    $requete->BindParam(':module_dflt',$module_dflt);
    $requete->BindParam(':module_name',$module_name);
    $requete->BindParam(':pos_id',$pos_id);
    $requete->BindParam(':type',$type_user);
    $requete->BindParam(':path_image',$url);
    $requete->execute(); 
            }
            }
            }else{

                       // Insertion
    $requete = $bdd->prepare("INSERT INTO t_utilisateur (nom_user,sexe_user,email_user,mdp_user,actif,id_droit,id_hotel,company_id,module_dflt,module_name,pos_id,type)
                     VALUES(:nom_user,:sexe_user,:email_user,:mdp_user,:actif,:id_droit,:id_hotel,:company_id,:module_dflt,:module_name,:pos_id,:type)");
    $pwdhash=password_hash($password1,PASSWORD_DEFAULT);
    $requete->BindParam(':nom_user', $name);
    $requete->BindParam(':sexe_user', $sexe);
    $requete->BindParam(':email_user',$login);
    $requete->BindParam(':mdp_user',$pwdhash);
    $requete->BindParam(':actif',$etat);
    $requete->BindParam(':id_droit',$id_droit);
    $requete->BindParam(':id_hotel',$hotel_id);
    $requete->BindParam(':company_id',$_SESSION['company_id']);
    $requete->BindParam(':module_dflt',$module_dflt);
    $requete->BindParam(':module_name',$module_name);
    $requete->BindParam(':pos_id',$pos_id);
    $requete->BindParam(':type',$type_user);
    $requete->execute(); 


            }
    
        $json['message'] = 'succes';

        $json['user'] = $nbre_user_update;

        }

    } else {
        $json['message'] = 'mdpIncorrect';
    }
    } else {
        $json['message'] = 'idexist';
    }
    }
}
echo json_encode($json);
