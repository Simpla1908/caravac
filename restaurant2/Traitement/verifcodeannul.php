<?php
if (!isset($_SESSION)) {
    session_start();
}
include('../bdd/connexion.php');
include '../../FUNCTION/hebergement.php';
include '../../FUNCTION/restaurant.php';
$monnaie = getsymbole_local();
$id_cmd = $_GET['id_cmd'];
$code = $_POST['code'];
//Impacter monitoring
$idcommande = $_GET['idfactcl'];
$repas =NULL;
$suppr = 0;
$produit_id = NULL;
$qte2diff = NULL;
$description = 'annulation';
$taux_op = $_SESSION['taux_resto'];
$prix = NULL;
//Impacter monitoring
$json = array();
global $user_id;
$user_id = $code;
if ($id_cmd > 0) {
    if ($_SESSION['type_user'] == 1) {
        $_SESSION['Id_Admin'] = $_SESSION['id_user'];
        $_SESSION['User_Admin'] = $_SESSION['nom_user'];
        $agent =$_SESSION['nom_user'];
        insertMonitoringCommande($agent, $qte2diff, $produit_id, $description, $idcommande, $suppr, $prix, $monnaie, $repas, $bdd);
        $json['agent'] =$agent;
        $json['message'] = "succes";
    } else {
        $nblgn = 0;
        $gln = 0;
        $requete = $bdd->prepare("SELECT id_user,nom_user,email_user,type  FROM t_utilisateur WHERE email_user=:code ");
        $requete->BindParam(':code', $code);
        $requete->execute();
        $nblgn = $requete->rowCount();
        if ($nblgn > 0) {
            $st = $requete->fetch(PDO::FETCH_OBJ);
            $id = $st->id_user;
            $type = $st->type;
            $nom_user = $st->nom_user;
            $email_user = $st->email_user;
            if ($type== 1) {
                $_SESSION['Id_Admin'] = $_SESSION['id_user'];
                $_SESSION['User_Admin'] = $_SESSION['nom_user'];
                $agent =$nom_user;
                insertMonitoringCommande($agent, $qte2diff, $produit_id, $description, $idcommande, $suppr, $prix, $monnaie, $repas, $bdd);
                $json['agent'] =$agent;
                $json['message'] = "succes";
          
            }else{
                $json['message'] = "vide"; 
            }
    
        } else {
            $json['message'] = "vide";
        }
    }
} else {
    $json['message'] = "succes";
}
echo json_encode($json);
