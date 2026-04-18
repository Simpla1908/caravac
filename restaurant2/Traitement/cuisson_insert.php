<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
include '../Traitement/verif_des_cuisson.php';
$json = array();
if (isset($_POST['designation'])) {
    $designation = $_POST['designation'];
    $designation = trim($designation, ' ');
    $etat=$_POST['etat_detplat'];
    //cuisson
    $etat = 0;
    $json = array();
    if (empty($designation)) {
        $json['message_vide'] = "vide";
    } else {
        $verif_des = verif_des_cuisson($designation, $bdd);
        if ($verif_des == 0) {
            $requete = $bdd->prepare("INSERT INTO detailsplats (nom,etat,hotel_id)
			                 VALUES(:nom,:etat,:hotel_id)");
            $requete->BindParam(':nom', $designation);
            $requete->BindParam(':etat', $etat);
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
