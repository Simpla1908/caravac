<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
include '../Traitement/verif_des_fam.php';
$json = array();
if (isset($_POST['designation'])) {
    // Insertion dans la table t_motif
    $designation = $_POST['designation'];
    $designation = trim($designation, ' ');
    $plat = 1;
    $affichage = 1;

    $json = array();
    if (empty($designation)) {
        $json['message_vide'] = "vide";
    } else {
        $verif_des = verif_des_fam($designation);
        if ($verif_des == 0) {
            $requete = $bdd->prepare("INSERT INTO stk_famille (designation,plat,affichage,hotel_id)
			                 VALUES(:designation,:plat,:affichage,:hotel_id)");
            $requete->BindParam(':designation', $designation);
            $requete->BindParam(':plat', $plat);
            $requete->BindParam(':affichage', $affichage);
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->execute();
            $json['message_succes'] = 'succes';
        } else {

            $json['message_erreur'] = 'erreur';
            $json['des_value'] = $designation;
        }
    }
}
$json['pos_id'] = $_SESSION['id_sousresto'];
echo json_encode($json);
