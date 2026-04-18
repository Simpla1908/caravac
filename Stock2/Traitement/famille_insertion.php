<?php
// Initialisation de la session
session_start();
include('../bdd/connexion.php');
include '../Traitement/verif_des_fam.php';
$json = array();
if (isset($_POST['designation'])) {
    // Insertion dans la table t_motif
    $designation = $_POST['designation'];
    $familletype_id = $_POST['familletype_id'];
    $designation = trim($designation, ' ');

    $json = array();
    if (empty($designation)) {

        $json['message_vide'] = "vide";
    } else {
        $verif_des = verif_des_fam($designation);
        if ($verif_des == 0) {
            $requete = $bdd->prepare("INSERT INTO stk_famille (designation,hotel_id,familletype_id)
			                 VALUES(:designation,:hotel_id,:familletype_id)");
            //session à enlever
            $requete->BindParam(':designation', $designation);
            $requete->BindParam(':hotel_id', $_SESSION['id_hotel']);
            $requete->BindParam(':familletype_id', $familletype_id);

            $requete->execute();

            //        echo"L'enrégistrement s'est effectué avec succès!";
            $json['message_succes'] = 'succes';
        } else {

            $json['message_erreur'] = 'erreur';
            $json['des_value'] = $designation;
        }
    }
}
echo json_encode($json);
