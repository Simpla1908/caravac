<?php
// Initialisation de la session
if (!isset($_SESSION)) {
    session_start();
}
include('../../bdd/connexion.php');
include('../../lib/password_compat-master/lib/password.php');
$json = array();
$json['message'] = "";
$json['s'] =FALSE;
$user_id = $_POST['agent_id'];
$password1 = $_POST['nouveau1'];
$password2 = $_POST['nouveau2'];
if (empty($password1)||empty($password2)){
    $json['message'] = 'Veuillez remplir ces deux champs';
} else {
    if ($password1 == $password2) {
        // Inssertion
        $requete = $bdd->prepare("UPDATE t_utilisateur SET  email_user=:email_user,mdp_user=:mdp_user WHERE id_user=:id_user");
        $pwdhash=password_hash($password1,PASSWORD_DEFAULT);
        $requete->BindParam(':email_user', $password1);
        $requete->BindParam(':mdp_user', $pwdhash);
        $requete->BindParam(':id_user',$user_id);
        $requete->execute();
        $json['message'] = 'Changement effectué avec succès !';
        $json['s']=TRUE;
        echo json_encode($json);
    } else {
        $json['s'] =FALSE;
        $json['message'] = 'Les deux mots de passe saisis doivent être identiques !';
        echo json_encode($json);
    }

}


